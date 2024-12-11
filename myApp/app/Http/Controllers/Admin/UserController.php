<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     */




    public function transferPayment()
   {
       return view('admin.content.payment.transfer_payment');
   }
    public function paymentIndex()
    {
        return view('admin.content.payment.payment_index');
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1',
        ]);

        // Lấy thông tin người dùng
        $user = auth()->user();

        // Lấy số tiền từ form
        $amount = $request->amount;

        // Cập nhật số dư tài khoản
        $user->balance += $amount;
        $user->save();

        return redirect()->back()->with('success', 'Nạp tiền thành công!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit( $id)
    {
        // Lấy thông tin người dùng theo ID
        $user = User::findOrFail($id);

        return view('admin_core.content.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Lấy thông tin người dùng theo ID
        $user = User::findOrFail($id);

        // Xác thực dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
            'phone_number' => 'nullable|string|max:15',
            'balance' => 'nullable',
            'avatar' => 'nullable',
        ]);

        // Cập nhật thông tin người dùng
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->balance = $request->balance;
        $get_image         = $request->avatar;
        $path              = 'uploads/users/';
        $get_name_image    = $get_image->getClientOriginalName();
        $name_image        = current(explode('.', $get_name_image));
        $new_image         = $name_image . rand(0, 99) . '.'
                             . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $user->avatar = $new_image;
//        // Nếu có file ảnh, lưu trữ ảnh mới
//        if ($request->hasFile('avatar')) {
//            $avatarPath = $request->file('avatar')->store('avatars', 'public');
//            $user->avatar = $avatarPath;
//        }

        $user->save();

        return redirect()->route('admin.dashboardCore', $user->id)
                         ->with('success', 'Cập nhật thông tin người dùng thành công!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
