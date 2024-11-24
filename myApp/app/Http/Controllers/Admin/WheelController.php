<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WheelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
//    public function __construct()
//    {
//        $this->middleware('spin.cooldown');
//    }
//    public function index()
//    {
//        $user = Auth::user();
//
//        if ($user->last_spin_at && now()->diffInHours($user->last_spin_at) < 24) {
//            return redirect()->back()->with('error', 'Bạn chỉ được quay lại sau 24 giờ!');
//        }
//        return view('admin_core.content.wheel.index');
//    }
    public function index()
    {
        $user = Auth::user();

        $hoursLeft = null;

        if ($user->last_spin_at && now()->diffInHours($user->last_spin_at) < 24) {
            $hoursLeft = 24 - now()->diffInHours($user->last_spin_at);
        }

        return view('admin_core.content.wheel.index', compact('hoursLeft'));

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
        //
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function spin(Request $request)
    {
        // Đảm bảo người dùng đã đăng nhập
        if (!Auth::check()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Bạn cần đăng nhập để thực hiện quay!'
            ], 401);
        }

        $user = Auth::user();

        // Kiểm tra thời gian quay gần nhất
        $lastSpinAt = $user->last_spin_at;

        if ($lastSpinAt && now()->diffInHours($lastSpinAt) < 24) {
            $hoursLeft = 24 - now()->diffInHours($lastSpinAt);
            return response()->json([
                'status' => 'error',
                'message' => "Bạn chỉ có thể quay lại sau $hoursLeft giờ nữa!"
            ], 403);
        }

        // Đã qua 24 giờ, cho phép quay
        return response()->json([
            'status' => 'success',
            'message' => 'Bạn có thể quay!'
        ]);
    }

    public function reward(Request $request)
    {
        // Lấy giá trị reward từ URL
        $reward = $request->query('reward');

        // Đảm bảo user đã đăng nhập
        if (Auth::check()) {
            $user = Auth::user();

            // Xử lý logic cộng số dư dựa trên phần thưởng
            switch ($reward) {
                case '+1k Vào tài khoản':
                    $user->balance += 1000;
                    break;
                case '+2k Vào tài khoản':
                    $user->balance += 2000;
                    break;
                case '+3k Vào tài khoản':
                    $user->balance += 3000;
                    break;
                case '+4k Vào tài khoản':
                    $user->balance += 4000;
                    break;
                case '+5k Vào tài khoản':
                    $user->balance += 5000;
                    break;
                case '+6k Vào tài khoản':
                    $user->balance += 6000;
                    break;
                case '+10k Vào tài khoản':
                    $user->balance += 10000;
                    break;
                case '+20k Vào tài khoản':
                    $user->balance += 20000;
                    break;
                default:
                    return redirect()->back()->with('error', 'Phần thưởng không hợp lệ!');
            }
            $user->last_spin_at = now('Asia/Ho_Chi_Minh');
            // Lưu thay đổi
            $user->save();

            // Chuyển hướng với thông báo thành công
            return redirect()->route('admin.wheel.index')->with('success', 'Bạn đã nhận ' . $reward);
        }

        // Nếu chưa đăng nhập, chuyển hướng về trang đăng nhập
        return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để nhận phần thưởng!');
    }
}
