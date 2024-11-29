<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Motel;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Illuminate\Support\Facades\Auth;

class InvoiceController extends Controller
{


//    public function createInvoice(Request $request)
//    {
//        // Lấy dữ liệu từ form
//        $validated = $request->validate([
//            'motel_id'     => 'required|exists:motel,id',
//            'new_electric' => 'required|integer',
//            'old_electric' => 'required|integer',
//            'new_water'    => 'required|integer',
//            'old_water'    => 'required|integer',
//            'money_water'    => 'required|integer',
//            'money_electric'    => 'required|integer',
//            'money'    => 'required|integer',
//            'money_another'    => 'required|integer',
//        ]);
//
//        // Tính tiền điện, nước
//        $electric_fee = ($validated['new_electric']
//                         - $validated['old_electric'])
//                        * $validated['money_electric']; // Ví dụ: 3500 VNĐ/kWh
//        $water_fee    = ($validated['new_water'] - $validated['old_water'])
//                        * $validated['money_water']; // Ví dụ: 5000 VNĐ/m3
//        $total_amount = $electric_fee + $water_fee +  $validated['money'];
//
//        // Tạo hóa đơn
//        $invoice = Invoice::create([
//            'user_id' => \auth()->id(),
//            'motel_id'     => $validated['motel_id'],
//            'new_electric' => $validated['new_electric'],
//            'old_electric' => $validated['old_electric'],
//            'new_water'    => $validated['new_water'],
//            'old_water'    => $validated['old_water'],
//            'money_water'    => $validated['money_water'],
//            'all_money'    => $total_amount,
//            'money_electric'    => $validated['money_electric'],
//            'money'    => $validated['money'],
//            'money_another'    => $validated['money_another'],
//            'electric_fee' => $electric_fee,
//            'water_fee'    => $water_fee,
//            'total_amount' => $total_amount,
//        ]);
//
//        // Chuyển hướng đến trang thanh toán
//        return redirect()->route('admin.invoices.pay', ['id' => $invoice->id]);
//    }
    public function createInvoice(Request $request)
    {
        try {
            // Lấy dữ liệu từ form và validate
            $validated = $request->validate([
                'motel_id'       => 'required|exists:motel,id',
                'new_electric'   => 'required|integer',
                'old_electric'   => 'required|integer',
                'new_water'      => 'required|integer',
                'old_water'      => 'required|integer',
                'money_water'    => 'required|integer',
                'money_electric' => 'required|integer',
                'money'          => 'required|integer',
                'money_another'  => 'integer',
                'money_wifi'  => 'integer',
            ]);

            // Kiểm tra xem phòng trọ này đã có hóa đơn chưa
            $existingInvoice = Invoice::where('motel_id',
                $validated['motel_id'])->first();
            if ($existingInvoice) {
                return redirect()->back()->with('error',
                    'Phòng trọ này đã có hóa đơn, không thể tạo thêm!');
            }

            // Tính tiền điện, nước
            $electric_fee = ($validated['new_electric']
                             - $validated['old_electric'])
                            * $validated['money_electric'];
            $water_fee    = ($validated['new_water'] - $validated['old_water'])
                            * $validated['money_water'];
            $total_amount = $electric_fee + $water_fee + $validated['money'] + $validated['money_another'];

            // Tạo hóa đơn
            $invoice = Invoice::create([
                'user_id'        => \auth()->id(),
                'motel_id'       => $validated['motel_id'],
                'new_electric'   => $validated['new_electric'],
                'old_electric'   => $validated['old_electric'],
                'new_water'      => $validated['new_water'],
                'old_water'      => $validated['old_water'],
                'money_water'    => $validated['money_water'],
                'money_electric' => $validated['money_electric'],
                'money'          => $validated['money'],
                'all_money'      => $total_amount,
                'money_another'  => $validated['money_another'],
                'electric_fee'   => $electric_fee,
                'water_fee'      => $water_fee,
                'total_amount'   => $total_amount,
            ]);

            // Chuyển hướng đến trang thanh toán
            return redirect()
                ->route('admin.invoices.pay', ['id' => $invoice->id])
                ->with('success', 'Hóa đơn đã được tạo thành công!');
        }
        catch (\Illuminate\Database\QueryException $e) {
            return redirect()->back()->with('error',
                'Hóa đơn cho phòng trọ này đã tồn tại!');
        }
    }
    public function motelReport()
    {
        $getUserId = Auth::id();
        $invoices = Invoice::where([
            ['user_id', '=', $getUserId],
            ['status', '=', 'paid'],
        ])->get();
//        $totalAmount = $invoices->sum('total_amount');
        $totalAmount = $invoices->sum(function ($invoice) {
            return $invoice->all_money - $invoice->electric_fee - $invoice->water_fee;
        });
        $totalElectric = $invoices->sum(function ($invoice) {
            return ($invoice->new_electric - $invoice->old_electric) * $invoice->electric_fee;
        });
        $totalWater = $invoices->sum(function ($invoice) {
            return ($invoice->new_water - $invoice->old_water) * $invoice->water_fee;
        });

        // Truyền dữ liệu vào view
        return view('admin_core.content.motel.report', compact('totalAmount', 'totalElectric', 'totalWater', 'invoices'));

    }
    public function payInvoice($id)
    {

        $invoice = Invoice::findOrFail($id);
        $getMotelName = Motel::findOrFail($invoice->motel_id);

//            dd($getMotelName->name);
        return view('admin_core.content.invoices.pay', compact('invoice','getMotelName'));
    }
    public function getIndexInvoice()
    {
        $getUserId = Auth::id();
        $invoices = Invoice::where('user_id', $getUserId)->with('motel')->get();

        return view('admin_core.content.motel.list', compact('invoices'));
    }
    public function prepay(Request $request)
    {

        $request->validate([
            'total_amount' => 'required|',
            'prepay' => 'required|',
        ]);
        $invoiceId = $request->input('invoiceId')  ;
        $invoice = Invoice::findOrFail($invoiceId);
        $prepay1 = $invoice->prepay ;
        $prepay =  $request->input('prepay');
        $totalPay = $prepay1 +$prepay;
        $invoice->prepay = $totalPay;
        $invoice->total_amount = $request->input('total_amount');
        $invoice->save();
        return redirect()->back()->with('success', 'Hóa đơn đã được trả trước thành công!');
    }
    public function acceptPay(Request $request, $id)
    {
        // Lấy thông tin hóa đơn từ DB
        $invoice = Invoice::findOrFail($id);

        // Cập nhật trạng thái hóa đơn
        $invoice->status = 'paid'; // 'paid' là trạng thái đã thanh toán
        $invoice->paid_at = now(); // Ghi nhận thời gian thanh toán
//        dd($invoice);
        $invoice->save();

        // Điều hướng hoặc trả về thông báo thành công
        return redirect()->route('admin.invoices.getIndexInvoice')->with('success', 'Hóa đơn đã được thanh toán thành công!');
    }
}
