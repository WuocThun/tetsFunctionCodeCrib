<?php

namespace App\Providers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use App\Models\RoomsClassification;
use App\Models\Rooms;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(Request $request): void
    {
        View::composer(['fe.inc.header','fe.inc.search_bar'], function ($view) {
            // Ví dụ: Lấy danh sách phòng để truyền vào navbar
            $clasRoom =RoomsClassification::take(3)->get();
            $view->with('clasRoom', $clasRoom);
        });
//Bộ lọc
        View::composer('fe.fitler_price', function ($view) {
            $request = request();
            $query = Rooms::query();

            // Lọc theo giá nếu `min_price` và `max_price` có trong request
            if ($request->has('min_price') && $request->has('max_price')) {
                $query->whereBetween('price', [$request->min_price, $request->max_price]);
            } elseif ($request->has('min_price')) {
                $query->where('price', '>=', $request->min_price);
            }
            if ($request->has('orderby')){
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
            $rooms = $query->get();

            // Lấy dữ liệu và truyền vào view
            $view->with('rooms', $rooms);
        });
    }
}
