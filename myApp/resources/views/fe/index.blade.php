@extends('fe.layouts.app')
@section('header')
    @include('fe.inc.header')
@endsection
@section('searchBar')
    @include('fe.inc.search_bar')
@endsection
@section('hotZone')
    @include('fe.inc.hot_zone')
@endsection
@section('main')
<style>
    .call-btn {
        background-color: #007bff;
        border: none;
        font-size: 14px;
        color: white;
    }
</style>
    <section class="search-results">
        <div class="container search-results-container">
            <div class="results-left">
                <h2>Tổng {{count($rooms)}} kết quả</h2>
                <div class="sort-options">
                    <span>Sắp xếp: </span>
                    <button class="btn sort-btn">Mặc định</button>
                    <button class="btn sort-btn">Mới nhất</button>
                    <button class="btn sort-btn">Có video</button>
                </div>
                @foreach($rooms as $room => $room1)
                <a href="{{route('getRoom',$room1->slug)}}" style="text-decoration: none;">
                    <div class="result-item">
                        @php
                            $images = json_decode($room1->image, true);
                        @endphp
                        <img src="{{asset('uploads/fe/img/room1.jpg')}}" alt="Ký túc xá Tân Bình">
                        <div class="result-info">
                            <h3>{{$room1->title}}</h3>
                            <p>{{$room1->price}}triệu/tháng - {{$room1->area}}m² </p>
                            <p>{{$room1->full_address}}</p>

{{--                            <p>{{ \Illuminate\Support\Str::limit($room1->description, 15, '...') }}</p>--}}
                            <div class="contact-options">
                                <button class="btn  call-btn">Gọi {{$room1->phone_number}}</button>
                                <button class="btn zalo-btn">Nhắn Zalo</button>
                            </div>
                        </div>
                    </div>
                </a>
                @endforeach
                <div class="pagination">
                    <button class="prev">« Trang trước</button>
                    <button class="active">1</button>
                    <button>2</button>
                    <button>3</button>
                    <button>4</button>
                    <button>5</button>
                    <button class="next">» Trang sau »</button>
                </div>
            </div>

            <div class="results-right">
                <div class="filter-section">
                    <h3>Xem theo giá</h3>
                    <ul>
                        <li>Dưới 1 triệu</li>
                        <li>Từ 1 - 2 triệu</li>
                        <li>Từ 2 - 3 triệu</li>
                        <li>Từ 3 - 5 triệu</li>
                        <li>Từ 5 - 7 triệu</li>
                        <li>Từ 7 - 10 triệu</li>
                        <li>Từ 10 - 15 triệu</li>
                        <li>Trên 15 triệu</li>
                    </ul>
                </div>

                <div class="filter-section">
                    <h3>Xem theo diện tích</h3>
                    <ul>
                        <li>Dưới 20m²</li>
                        <li>Từ 20 - 30m²</li>
                        <li>Từ 30 - 50m²</li>
                        <li>Từ 50 - 70m²</li>
                        <li>Từ 70 - 90m²</li>
                        <li>Trên 90m²</li>
                    </ul>
                </div>

                <div class="filter-section">
                    <h3>Danh mục cho thuê</h3>
                    <ul>
                        <li>Cho thuê phòng trọ (77,318)</li>
                        <li>Cho thuê nhà nguyên căn (11,863)</li>
                        <li>Cho thuê căn hộ (13,604)</li>
                        <li>Cho thuê căn hộ mini (3,048)</li>
                        <li>Cho thuê căn hộ dịch vụ (7,810)</li>
                        <li>Cho thuê mặt bằng (2,390)</li>
                        <li>Tìm người ở ghép (15,847)</li>
                    </ul>
                </div>
                <div class="newstr">
                    <h3>Tin đăng mới</h3>
                    <ul>
                        <li>
                            <a href="#">
                                <img src="{{asset('uploads/fe/img/room1.jpg')}}" alt="Phòng trọ mới">
                                <div>
                                    <span class="post-meta">Phòng trọ tiện nghi Q1</span>
                                    <span class="post-price">2.5 triệu/tháng</span>
                                    <span class="post-time">Đăng 2 giờ trước</span>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                <img src="{{asset('uploads/fe/img/room2.jpg')}}" alt="Phòng trọ mới">
                                <div>
                                    <span class="post-meta">Phòng trọ gần Đại học Kinh Tế</span>
                                    <span class="post-price">3.0 triệu/tháng</span>
                                    <span class="post-time">Đăng 5 giờ trước</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

        </div>

    </section>
@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection

