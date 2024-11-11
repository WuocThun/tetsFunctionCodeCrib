<section class="search-bar">
    <div class="container search-container">
        <select>
{{--            <option value="phong-tro">Phòng trọ, nhà trọ</option>--}}
            @foreach($clasRoom as $class => $cl)
                <option href="#">{{$cl->title}}</option>
            @endforeach
        </select>
        <select>
            <option value="toan-quoc">Toàn quốc</option>
            <option value="ho-chi-minh">Hồ Chí Minh</option>
            <option value="ha-noi">Hà Nội</option>
        </select>
        <select>
            <option value="gia">Chọn giá</option>
        </select>
        <select>
            <option value="dien-tich">Chọn diện tích</option>
        </select>
        <button class="search-btn">Tìm kiếm</button>
    </div>
</section>
