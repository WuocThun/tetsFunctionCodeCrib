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
    <section class="search-results">
        <div class="container search-results-container">
            <div class="results-left">
                <div style="margin-bottom: 20px; ">
                    <a href="{{route('welcome')}}" style="text-decoration: none; ">Trang chủ</a> > Tin tức
                </div>
                <h2 style="margin-bottom: 20px;">Tin tức thị trường, chia sẻ kinh nghiệm Bất động sản</h2>
                @foreach($blogs as $key => $blog)

                <a href="{{route('getBlog',$blog->slug)}}" style="text-decoration: none;">
                    <div class="result-item">
                        <img src="{{asset('uploads/blogs/'.$blog->image)}}" alt="Ký túc xá Tân Bình">
                        <div class="result-info">
                            <h3>{{$blog->title}}</h3>
                            <p>{{ \Illuminate\Support\Str::limit($blog->content, 100)}}</p>
                            <div class="contact-options">

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

           @include('fe.inc.search_left')

        </div>

    </section>

@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection

