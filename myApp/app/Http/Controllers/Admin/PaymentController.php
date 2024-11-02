<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PayOS\PayOS;
class PaymentController extends Controller
{
    private $payOSClientId;
    private $payOSApiKey;
    private $payOSChecksumKey;
//    public function __construct()
//    {
//        $this->payOSClientId =env('PAYOS_CLIENT_ID');
//        $this->payOSApiKey =env('PAYOS_API_KEY');
//        $this->payOSChecksumKey= env('PAYOS_CHECKSUM_KEY');
//    }
    public function createPaymentLink(Request $request)
    {
        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => 2000,
            "description" => "Thanh toán đơn hàng",
            "returnUrl" => $YOUR_DOMAIN . "/admin/payment/mbbank/success",
            "cancelUrl" => $YOUR_DOMAIN . "/admin/payment/mbbank/cancel",
        ];
        error_log($data['orderCode']);

        try {
            $response = $this->payOS->createPaymentLink($data);
            return redirect($response['checkoutUrl']);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
    public function handlePayOSWebhook(Request $request)
    {
        $body = json_decode($request->getContent(), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return response()->json([
                "error" => 1,
                "message" => "Invalid JSON payload",
            ], 400);
        }

        // Handle webhook test
        if (in_array($body["data"]["description"], ["Ma giao dich thu nghiem", "VQRIO123"])) {
            return response()->json([
                "error" => 0,
                "message" => "Ok",
                "data" => $body["data"],
            ]);
        }

        try {
            $this->payOS->verifyPaymentWebhookData($body);
        } catch (\Exception $e) {
            return response()->json([
                "error" => 1,
                "message" => "Invalid webhook data",
                "details" => $e->getMessage(),
            ], 400);
        }

        // Process webhook data
        // ...

        return response()->json([
            "error" => 0,
            "message" => "Ok",
            "data" => $body["data"],
        ]);
    }
    public function createOrder(Request $request)
    {
        $body = $request->input();
        $body["amount"] = intval($body["amount"]);
        $body["orderCode"] = intval(substr(strval(microtime(true) * 100000), -6));

        try {
            $response = $this->payOS->createPaymentLink($body);
            return response()->json([
                "error" => 0,
                "message" => "Success",
                "data" => $response["checkoutUrl"],
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
    public function getPaymentLinkInfoOfOrder(string $id)
    {
        try {
            $response = $this->payOS->getPaymentLinkInformation($id);
            return response()->json([
                "error" => 0,
                "message" => "Success",
                "data" => $response["data"],
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }

    public function cancelPaymentLinkOfOrder(Request $request, string $id)
    {
        $body = json_decode($request->getContent(), true);
        $cancelBody = is_array($body) && $body["cancellationReason"] ? $body : null;

        try {
            $response = $this->payOS->cancelPaymentLink($id, $cancelBody);
            return response()->json([
                "error" => 0,
                "message" => "Success",
                "data" => $response["data"],
            ]);
        } catch (\Throwable $th) {
            return $this->handleException($th);
        }
    }
    public function addAmountForUser ()
    {

    }
    public function successPayment()
    {
        return view('admin.content.payment.success');

    }   public function cancelPayment()
    {
        return view('admin.content.payment.cancel');

    }

    public function index(Request $request)
    {
        $YOUR_DOMAIN = $request->getSchemeAndHttpHost();
        echo $YOUR_DOMAIN;

        return view('admin.content.payment.checkout');
    }
    public function createPayment()
    {
        // Retrieve PayOS credentials from .env

        // Initialize PayOS
        $payOS = new PayOS($this->payOSClientId, $this->payOSApiKey, $this->payOSChecksumKey);

        $YOUR_DOMAIN = route('admin.user.paymentIndex'); // Use Laravel's url() helper to get the base URL

        // Prepare data
        $data = [
            "orderCode" => intval(substr(strval(microtime(true) * 10000), -6)),
            "amount" => 2000,
            "description" => "Thanh toán đơn hàng",
            "items" => [
                [
                    'name' => 'Mì tôm Hảo Hảo ly',
                    'price' => 2000,
                    'quantity' => 1,
                ],
            ],
            "returnUrl" => $YOUR_DOMAIN,
            "cancelUrl" => $YOUR_DOMAIN,
        ];

        // Create the payment link
        $response = $payOS->createPaymentLink($data);

        // Redirect to the payment page
        return redirect()->to($response['checkoutUrl']);
    }
}
