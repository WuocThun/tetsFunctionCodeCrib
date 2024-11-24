<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
class InvoiceController extends Controller
{

    public function createInvoice(Request $request)
    {
        // Lấy dữ liệu từ form
        $validated = $request->validate([
            'motel_id'     => 'required|exists:motel,id',
            'new_electric' => 'required|integer',
            'old_electric' => 'required|integer',
            'new_water'    => 'required|integer',
            'old_water'    => 'required|integer',
            'money_water'    => 'required|integer',
            'money_electric'    => 'required|integer',
            'money'    => 'required|integer',
            'money_another'    => 'required|integer',
        ]);

        // Tính tiền điện, nước
        $electric_fee = ($validated['new_electric']
                         - $validated['old_electric'])
                        * $validated['money_electric']; // Ví dụ: 3500 VNĐ/kWh
        $water_fee    = ($validated['new_water'] - $validated['old_water'])
                        * $validated['money_water']; // Ví dụ: 5000 VNĐ/m3
        $total_amount = $electric_fee + $water_fee +  $validated['money'];

        // Tạo hóa đơn
        $invoice = Invoice::create([
            'motel_id'     => $validated['motel_id'],
            'new_electric' => $validated['new_electric'],
            'old_electric' => $validated['old_electric'],
            'new_water'    => $validated['new_water'],
            'old_water'    => $validated['old_water'],
            'money_water'    => $validated['money_water'],
            'money_electric'    => $validated['money_electric'],
            'money'    => $validated['money'],
            'money_another'    => $validated['money_another'],
            'electric_fee' => $electric_fee,
            'water_fee'    => $water_fee,
            'total_amount' => $total_amount,
        ]);

        // Chuyển hướng đến trang thanh toán
        return redirect()->route('admin.invoices.pay', ['id' => $invoice->id]);
    }
    public function payInvoice($id)
    {
        $invoice = Invoice::findOrFail($id);

        return view('admin_core.content.invoices.pay', compact('invoice'));
    }
}
