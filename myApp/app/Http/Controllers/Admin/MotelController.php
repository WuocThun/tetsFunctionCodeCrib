<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Motel;
use App\Models\UserMotel;
use Illuminate\Support\Str; // Import thư viện Str

class MotelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userId = Auth::id();
        $getAllMotel = Motel::where('user_id' , $userId)->orderBy('id','desc')->get();
        $motels = Motel::withCount('users')
                       ->where('user_id', $userId)
                       ->orderBy('id', 'desc')
                       ->get();
        return view('admin_core.content.motel.index',compact('getAllMotel','motels'));
    }
    public function storeUserMotel(Request $request, string $id){
        $data = $request->validate([
            'motel_id' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'phone_number' => 'required|digits:10',
            'password' => 'required',
        ],[
                'phone_number.required' => 'Số điện thoại phải đủ 10 số',
            ]
        );
        $getMotelId = $id;
        $motel = Motel::findOrFail($data['motel_id']);
//        dd ($motel->total_member);
        $currentMemberCount = UserMotel::where('motel_id', $data['motel_id'])->count();
        // Giới hạn số lượng thành viên tối đa là 4
        if ($currentMemberCount >= $motel->total_member) {
            return redirect()->back()->with('error', 'Phòng này đã đầy, không thể thêm thêm thành viên.');
        }

        // Lưu thành viên vào cơ sở dữ liệu
        $member = new UserMotel();
        $member->motel_id =$data['motel_id']  ;
        $member->name = $data['name'];
        $member->phone_number = $data['phone_number'];
        $member->password = $data['password']; // Mã hóa mật khẩu
        $member->save();

        // Chuyển hướng về trang trước hoặc trả về thông báo thành công
        return redirect()->back()->with('success', 'Thành viên đã được thêm thành công');
    }
public function addUserMotel(Request $request ,string $id)
{
        $motelId = $id;
        $getMotel = Motel::findOrFail($id);

        $getUserRentMotel = UserMotel::where('motel_id' , $motelId)->get();

        return view('admin_core.content.motel.addUserMotel',compact('getMotel','getUserRentMotel'));

}

    public function create()
    {
        return view('admin_core.content.motel.create');
    }


    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|max:255',
            'money' => 'required|numeric',
            'default_electric' => 'required|numeric',
            'default_water' => 'required|numeric',
            'money_water' => 'required|numeric',
            'money_electric' => 'required|numeric',
            'money_date' => 'required|date',
            'kind_motel' => 'required|in:0,1',
            'money_another' => 'nullable|numeric',
            'money_wifi' => 'nullable|numeric',
            'status' => 'required',
            'total_member' => 'required',

        ],[
                'name.required'    => 'Vui lòng nhập tên phòng',
                'money.required'    => 'Vui lòng nhập số tiền hàng tháng',
                'default_electric.required'    => 'Vui lòng nhập số điện hiện tại',
                'default_water.required'    => 'Vui lòng nhập số nước hiện tại',
                'money_water.required'    => 'Vui lòng nhập số tiền nước trên 1 số',
                'money_electric.required'    => 'Vui lòng nhập số điên  trên 1 số',
                'money_date.required'    => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'kind_motel.required'    => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'money_another.required'    => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'money_wifi.required'    => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
                'status.required'    => 'Vui lòng nhập số ngày mà cần thu hàng tháng',
            ]
        );
        try {
        $motel = new Motel();
        $motel->user_id = auth()->id();
        $motel->name = $data['name'];
        $motel->slug = Str::slug ($data['name']);
        $motel->money = $data['money'];
        $motel->default_electric = $data['default_electric'];
        $motel->default_water = $data['default_water'];
        $motel->money_electric = $data['money_electric'];
        $motel->money_water = $data['money_water'];
        $motel->money_wifi = $data['money_wifi'];
        $motel->total_member = $data['total_member'];
        $motel->money_another = $data['money_another'];
        $motel->password = rand(1111111,99999999);
//        $motel->money_date = $data['money_date'] ?? Carbon::now();
        $motel->money_date = isset($data['money_date'])
            ? Carbon::parse($data['money_date'])->addMonth()
            : Carbon::now()->addMonth();
        $motel->kind_motel = $data['kind_motel'];
        $motel->status = $data['status'];
//        dd( );
            $motel->save();
        // Gửi thông báo
        return redirect()->route('admin.motel.index')
                         ->with('success', 'Phòng trọ đã được thêm thành công.');
    } catch (\Exception $e) {
            // Gửi thông báo thất bại

            return redirect()->back()
                             ->withInput($request->all()) // Trả dữ liệu cũ về form
                             ->with('error',
                    'Đã xảy ra lỗi trong quá trình thêm phòng trọ. Vui lòng thử lại!');
        }
}


    public function show(string $id)
    {

        //        $motel->name          = $request->get('name');
        //        $motel->money          = $request->get('money');
        //        $motel->default_electric          = $request->get('default_electric');
        //        $motel->default_water          = $request->get('default_water');
        //        $motel->money_electric          = $request->get('money_electric');
        //        $motel->money_water          = $request->get('money_water');
        //        $motel->money_wifi          = $request->get('money_wifi');
        //        $motel->money_date          = $request->get('money_date');
        //        $motel->kind_motel          = $request->get('kind_motel');
        //        $motel->status          = $request->get('status');
    }


    public function edit(string $id)
    {
        // Lấy thông tin phòng trọ dựa trên ID
        $motel = Motel::find($id);

        if (!$motel) {
            return redirect()->route('admin_core.content.motel.index')->with('error', 'Không tìm thấy phòng trọ!');
        }

        // Trả về view chỉnh sửa với dữ liệu phòng trọ
        return view('admin_core.content.motel.edit', compact('motel'));
    }


    public function update(Request $request, string $id)
    {
        // Validate dữ liệu
        $request->validate([
            'name' => 'required|string|max:255',
            'money' => 'required|numeric|min:0',
            'default_electric' => 'required|integer|min:0',
            'default_water' => 'required|integer|min:0',
            'money_electric' => 'required|numeric|min:0',
            'money_water' => 'required|numeric|min:0',
            'money_wifi' => 'nullable|numeric|min:0',
            'money_another' => 'nullable|numeric|min:0',
            'money_date' => 'required|date',
            'kind_motel' => 'required|integer|in:0,1,2',
            'status' => 'required|boolean',
        ]);

        $motel = Motel::findOrFail($id);

        $motel->name = $request->name;
        $motel->money = $request->money;
        $motel->default_electric = $request->default_electric;
        $motel->default_water = $request->default_water;
        $motel->money_electric = $request->money_electric;
        $motel->money_water = $request->money_water;
        $motel->money_wifi = $request->money_wifi ?? 0;
        $motel->money_another = $request->money_another ?? 0;
        $motel->money_date = $request->money_date;
        $motel->kind_motel = $request->kind_motel;
        $motel->status = $request->status;

        $motel->save();

        // Redirect với thông báo thành công
        return redirect()->route('admin.motel.index')->with('success', 'Cập nhật phòng trọ thành công.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $motel = Motel::find($id);

        if (!$motel) {
            return redirect()->route('admin.motel.index')->with('error', 'Không tìm thấy phòng trọ!');
        }

        // Xóa dữ liệu
        $motel->delete();

        return redirect()->route('admin.motel.index')->with('success', 'Xóa phòng trọ thành công!');
    }
}
