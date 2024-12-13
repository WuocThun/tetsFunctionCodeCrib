<div class="results-right">

    <div class="filter-section">
        <h3>Đặt cọc để xem phòng </h3>
        <ul>
            <label for="">Giá tiền</label>
            <input type="number" name="prepay" id="">
        </ul>
    </div>
    <div class="filter-section">
        <h3>Danh mục cho thuê</h3>
        <ul>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=0&max_price=1000000') }}">Dưới 1 triệu</a></li>
            <li>  <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=1000000&max_price=2000000') }}"> 1 triệu - 2 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=2000000&max_price=3000000') }}">2 triệu - 3 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=3000000&max_price=5000000') }}">3 triệu - 5 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=5000000') }}">Trên 5 triệu</a></li>
        </ul>
    </div>

    <div class="newstr">
        <h3>Phòng ngẫu nhiên</h3>
        <ul>
                @foreach($randomRooms as $room)
            <li>
                <a href="{{route('getRoom',$room->slug)}}">
                    <img src=" {{asset('uploads/fe/img/room1.jpg')}} " alt="Phòng trọ mới" />
                    <div>
                        <span class="post-meta">{{ \Illuminate\Support\Str::limit($room->title, 15, '...') }}</span>
                        <span class="post-price">{{number_format($room->price,0,',', '.')}} nghìn/tháng</span>
{{--                        <span class="post-time">{{$room->}}</span>--}}
                    </div>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
    <div class="newstr">
        <h3>Tin ngẫu nhiên</h3>
        <ul>
                @foreach($randomBlogs as $blogs)
            <li>
                <a href="{{route('getBlog',$blogs->slug)}}">
                    <img src=" {{asset('uploads/fe/img/room1.jpg')}} " alt="Phòng trọ mới" />
                    <div>
                        <span class="post-meta">{{ \Illuminate\Support\Str::limit($blogs->title, 15, '...') }}</span>
{{--                        <span class="post-price">{{number_format($room->price,0,',', '.')}} nghìn/tháng</span>--}}
{{--                        <span class="post-time">{{$room->}}</span>--}}
                    </div>
                </a>
            </li>
            @endforeach

        </ul>
    </div>
</div>
