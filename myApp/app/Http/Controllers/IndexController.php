<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rooms;
use App\Models\Blogs;
use App\Models\User;
use App\Providers\VietMapProviders;
use Carbon\Carbon;
use App\Models\RoomsClassification;

class IndexController extends Controller

{
    public function getAllClassRoom()
    {
        $clasRoom =RoomsClassification::take(3)->get();
        return view ('fe.inc.header',compact('clasRoom'));
    }
    public  function  dichvu()
    {
        return view('fe.dichvu');
    }
    public function __construct(VietMapProviders $vietnamMapService)
    {
        $this->VietMapProviders = $vietnamMapService;
    }
    public function index()
    {
        $rooms = Rooms::all();

        return view('fe.index',compact('rooms'));
    }
    public function indexBlog(){
        $blogs = Blogs::all();
        return view('fe.tintuc',compact('blogs'));
    }
    public function getRoom($slug)
    {
        $room = Rooms::where('slug',$slug)->first();
        $getUserId = $room->user_id;
        $getClassRoom = $room->rooms_class_id;

        $ClassRoom = RoomsClassification::find($getClassRoom);
        $findUser = User::find($getUserId)->first();
        $createdDate = Carbon::parse($room->created_at);
        $now = Carbon::now();
        if ($createdDate->diffInHours($now) < 24) {
            // Nếu dưới 24 giờ, hiển thị số giờ
            $timePosted = (int) $createdDate->diffInHours($now) . ' giờ trước';
        } else {
            // Nếu trên 24 giờ, hiển thị số ngày
            $timePosted = (int) $createdDate->diffInDays($now) . ' ngày trước';
        }
        $getProvince = $this->VietMapProviders->getProvinceData($room->province);
        $getDistrict = $this->VietMapProviders->getDistrictData($room->province);
        //        $districtData = json_encode($getDistrict->getContent(),true);
        $provinceData = json_decode($getProvince->getContent(), true);

        return view('fe.chitiet',compact('room','findUser','timePosted','ClassRoom','provinceData','getDistrict'));
//        return view('fe.chitiet');
    }
    public function getBlog($slug)
    {

        $blog = Blogs::where('slug',$slug)->first();
        return view('fe.baiviet',compact('blog'));
    }
}

