<?php

namespace App\Http\Controllers;

use App\Models\Motel;
use App\Models\RoomRequest;
use Illuminate\Http\Request;

class RoomRequestController extends Controller
{
    public function index()
    {
        $motels = Motel::where('status' , 1)->paginate('4');
        return view('fe.phongtrocontrong',compact('motels'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'motel_id' => 'required|exists:motel,id',
        ]);

        // Kiểm tra nếu người dùng đã gửi yêu cầu
        $existingRequest = RoomRequest::where('user_id', auth()->id())
                                      ->where('motel_id', $request->motel_id)
                                      ->where('status', 'pending')
                                      ->first();

        if ($existingRequest) {
            return back()->with('error', 'Bạn đã gửi yêu cầu tham gia phòng này trước đó.');
        }

        // Tạo yêu cầu mới
        RoomRequest::create([
            'user_id' => auth()->id(),
            'motel_id' => $request->motel_id,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Yêu cầu tham gia phòng đã được gửi.');
    }
//    public function accept($id)
//    {
//        $request = RoomRequest::findOrFail($id);
//
//        // Kiểm tra nếu chủ trọ là người quản lý phòng
//        if ($request->motel->user_id !== auth()->id()) {
//            return back()->with('error', 'Bạn không có quyền xử lý yêu cầu này.');
//        }
//
//        // Chấp nhận yêu cầu
//        $request->update(['status' => 'accepted']);
//        // Thêm người dùng vào phòng (thêm vào bảng liên kết motel_user)
//        $request->motel->usersRequest()->attach($request->user_id);
//        return back()->with('success', 'Yêu cầu đã được chấp nhận.');
//    }
    public function accept($id)
    {
        $request = RoomRequest::findOrFail($id);

        // Kiểm tra nếu chủ trọ là người quản lý phòng
        if ($request->motel->user_id !== auth()->id()) {
            return back()->with('error', 'Bạn không có quyền xử lý yêu cầu này.');
        }

        // Chấp nhận yêu cầu và cập nhật trạng thái
        $request->status = 'accepted'; // Sửa trạng thái
//        $request->save();
        // Cập nhật motel_id vào bảng users
        $user = $request->user; // Lấy thông tin người dùng từ yêu cầu
        $user->motel_id = $request->motel->id; // Gán motel_id cho người dùng
        $user->save();
        $request->save();

        // Thêm người dùng vào phòng (thêm vào bảng liên kết motel_user nếu cần thiết)
//        $request->motel->usersRequest()->attach($user->id);

        return back()->with('success', 'Yêu cầu đã được chấp nhận và người dùng đã được thêm vào phòng.');
    }


    public function reject($id)
    {
        $request = RoomRequest::findOrFail($id);

        // Kiểm tra quyền
        if ($request->motel->user_id !== auth()->id()) {
            return back()->with('error', 'Bạn không có quyền xử lý yêu cầu này.');
        }

        // Từ chối yêu cầu
        $request->update(['status' => 'rejected']);

        return back()->with('success', 'Yêu cầu đã bị từ chối.');
    }

}
