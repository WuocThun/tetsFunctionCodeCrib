<div class="results-right">
    <div class="filter-section">
        <h3>Danh mục cho thuê</h3>
        <ul>
{{--            <li>Cho thuê phòng trọ (77,318)</li>--}}
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=0&max_price=1000000') }}">Dưới 1 triệu</a></li>
            <li>  <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=1000000&max_price=2000000') }}"> 1 triệu - 2 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=2000000&max_price=3000000') }}">2 triệu - 3 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=3000000&max_price=5000000') }}">3 triệu - 5 triệu</a></li>
            <li> <a class="filer_blogs" href="{{ url('/bo-loc/phong?min_price=5000000') }}">Trên 5 triệu</a></li>
        </ul>
    </div>

    <div class="newstr">
        <h3>Tin đăng mới</h3>
        <ul>
            <li>
                <a href="#">
                    <img src=" {{asset('uploads/fe/img/room1.jpg')}} " alt="Phòng trọ mới" />
                    <div>
                        <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                        <span class="post-price">2.5 triệu/tháng</span>
                        <span class="post-time">Đăng 2 giờ trước</span>
                    </div>
                </a>
            </li>

        </ul>
    </div>
</div>
