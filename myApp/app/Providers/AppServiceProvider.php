<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\RoomsClassification;
use App\Models\Rooms;
use App\Providers\VietMapProviders;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(VietMapProviders::class, function ($app) {
            return new VietMapProviders();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void {
        View::composer(['fe.inc.header', 'fe.inc.search_bar','fe.inc.fitler_blogs_right'], function ($view) {
            // Lấy tất cả các tỉnh (province) từ bảng Rooms
            $provincesIds = Rooms::pluck('province')->unique();
            // Mảng để chứa tất cả dữ liệu tỉnh
            $randomRooms = Rooms::inRandomOrder()->take(5)->get();

            $allProvinceData = [];

            // Duyệt qua các ID tỉnh
            foreach ($provincesIds as $provinceId) {
                // Gọi API để lấy thông tin tỉnh
                $vietMapProvider = app(VietMapProviders::class);
                $getProvince = $vietMapProvider->getProvinceData($provinceId);

                // Giải mã JSON trả về
                $provinceData = json_decode($getProvince->getContent(), true);

                // Kiểm tra nếu dữ liệu trả về là mảng, nếu không thì tạo thành mảng
                if (is_array($provinceData)) {
                    $allProvinceData[] = $provinceData; // Thêm vào mảng kết quả
                } else {
                    $allProvinceData[] = [$provinceData]; // Đảm bảo dữ liệu luôn là mảng
                }
            }

            // Lấy danh sách phòng để truyền vào navbar
            $clasRoom = RoomsClassification::take(3)->get();

            // Truyền các dữ liệu vào view
            $view->with([
                'clasRoom' => $clasRoom,
                'provinceData' => $allProvinceData, // Truyền mảng các tỉnh vào view
                'randomRooms' => $randomRooms,
            ]);
        });
        //Bộ lọc
        View::composer('fe.fitler_price', function ($view) {
            $request = request();
            $query   = Rooms::query();
            $randomRooms = Rooms::inRandomOrder()->take(3)->get();

            // Lọc theo giá nếu `min_price` và `max_price` có trong request
            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('price',
                    [$request->min_price, $request->max_price]);
            } elseif ($request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('orderby')) {
                $orderBy = $request->get('orderby');
                if ($orderBy == 'moi-nhat') {
                    // Nếu giá trị là 'moi-nhat', sắp xếp theo ID giảm dần (mới nhất trước)
                    $query->orderBy('id', 'desc');
                } elseif ($orderBy == 'mac-dinh') {
                    // Nếu giá trị là 'mac-dinh', sắp xếp theo ID tăng dần (theo mặc định)
                    $query->orderBy('id', 'asc');
                } else {
                    // Nếu giá trị không phải là 'moi-nhat' hoặc 'mac-dinh', bạn có thể sử dụng sắp xếp mặc định
                    $query->orderBy('id', 'asc');
                }
            }
            $rooms = $query->paginate(7);;

            // Lấy dữ liệu và truyền vào view
            $view->with('rooms', $rooms,);
        });
    }

}
