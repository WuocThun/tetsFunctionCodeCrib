{{--<header class="sticky-top">--}}
{{--    <div class="container header-container">--}}
{{--        <div class="logo">--}}
{{--            <img src="https://phongtro123.com/images/logo.png" alt="Phongtro123 Logo">--}}
{{--        </div>--}}

{{--        <div class="user-options ">--}}
{{--            @if (Auth::check())--}}
{{--                <div class="row">--}}
{{--                    <div class="col-12 col-sm-4 d-flex justify-content-center justify-content-sm-start">--}}
{{--                        <!-- Hiển thị avatar người dùng -->--}}
{{--                        <img width="50px" height="50px" src="{{asset('uploads/'.Auth::user()->avatar)}}" alt="Avatar" class="rounded-circle">--}}
{{--                    </div>--}}
{{--                    <div class="col-12 col-sm-8">--}}
{{--                        <!-- Hiển thị thông tin người dùng -->--}}
{{--                        <div class="row text-header">--}}
{{--                            <div class="col-12">--}}
{{--                                Xin chào: <strong>{{ Auth::user()->name }}</strong>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="row text-header">--}}
{{--                            <div class="col-12">--}}
{{--                                Mã số tài khoản: <strong>{{ Auth::id() }}</strong>--}}
{{--                            </div>--}}
{{--                            <div class="col-12">--}}
{{--                                TK Chính : <strong>{{ number_format(Auth::user()->balance, 0, ',', '.') }} VNĐ</strong>--}}
{{--                            </div>--}}

{{--                            <form method="POST" action="{{ route('logout') }}">--}}
{{--                                @csrf--}}
{{--                                <x-dropdown-link :href="route('logout')"--}}
{{--                                                 onclick="event.preventDefault();--}}
{{--                                                this.closest('form').submit();">--}}
{{--                                    {{ __('Log Out') }}--}}
{{--                                </x-dropdown-link>--}}
{{--                            </form>--}}
{{--                        </div>--}}

{{--                        <!-- Thêm button "Đăng tin" -->--}}
{{--                    </div>--}}
{{--                </div>--}}

{{--        </div>--}}

{{--@else--}}
{{--            <button class="btn">Yêu thích</button>--}}
{{--            <a href="{{route('getLogin')}}" style="text-decoration: none;">--}}
{{--                <button class="btn">Đăng nhập</button>--}}
{{--            </a>--}}

{{--            <a href="{{route('getReginster')}}" style="text-decoration: none;">--}}
{{--                <button class="btn highlight">Đăng ký</button>--}}
{{--            </a>--}}
{{--        @endif--}}
{{--                    <a href="{{route('admin.roomsCore.createCore')}}" style="text-decoration: none;">--}}
{{--                    <button class="btn highlight">Đăng tin miễn phí</button></a>--}}
{{--    </div>--}}
{{--</header>--}}
{{--<nav class="navbar navbar_header navbar-light bg-primary-subtle">--}}
{{--    <div class="container-fluid justify-content-center">--}}
{{--        <nav class="main-nav">--}}
{{--            <ul class="text-center d-flex justify-content-center">--}}
{{--                <li class="mx-3">--}}
{{--                    <a class="" href="{{ route('welcome') }}">Trang chủ</a>--}}
{{--                </li>--}}
{{--                @foreach($clasRoom as $class => $cl)--}}
{{--                    <li class="mx-3"><a class="" href="{{ route('laydichvu', $cl->slug) }}">{{ $cl->title }}</a></li>--}}
{{--                @endforeach--}}
{{--                <li class="mx-3"><a class="" href="{{ route('indexBlog') }}">Tin tức</a></li>--}}
{{--                <li class="mx-3"><a class="" href="{{ route('dichvu') }}">Dịch vụ</a></li>--}}
{{--            </ul>--}}
{{--        </nav>--}}
{{--    </div>--}}
{{--</nav>--}}
<header class="navbar">
    <div class="navbar-top">
        <div class="logo">
            <span>PHONGTRO</span><span class="highlight">123</span>.com
            <p>Kênh thông tin phòng trọ số 1 Việt Nam</p>
        </div>
        @if (Auth::check())
        <div class="user-info">
            <div class="imguser">
            </div>

            <div class="flexinfo">
                <span>Xin chào, <b>{{ Auth::user()->name }}</b></span>
                <span>Mã tài khoản: {{ Auth::id() }}</span>
                <span>TK Chính: <b>{{ number_format(Auth::user()->balance, 0, ',', '.') }} VNĐ</b></span>
            </div>
            <span class="icon"><a href="{{route('wishlist.list')}}">Yêu thích</a></span>
            <span class="icon">Quản lý tài khoản</span>

            <button class="btn-dang-tin">Đăng tin miễn phí</button>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
            @else
                <div class="user-info">
{{--                    <div class="imguser">--}}
{{--                    </div>--}}

                    <div class="flexinfo">
                    </div>
                    <a href="{{route('getLogin')}}" style="text-decoration: none;">
                        <button class="btn">Đăng nhập</button>
                    </a>

                    <a href="{{route('getReginster')}}" style="text-decoration: none;">
                        <button class="btn highlight">Đăng ký</button>
                    </a>
            @endif

        </div>
    </div>
    <nav class="navbar-bottom">
        <nav class="main-nav">
            <ul class="text-center d-flex justify-content-center">
                <li class="mx-3">
                    <a class="" href="{{ route('welcome') }}">Trang chủ</a>
                </li>
                @foreach($clasRoom as $class => $cl)
                    <li class="mx-3"><a class="" href="{{ route('laydichvu', $cl->slug) }}">{{ $cl->title }}</a></li>
                @endforeach
                <li class="mx-3"><a class="" href="{{ route('indexBlog') }}">Tin tức</a></li>
                <li class="mx-3"><a class="" href="{{ route('dichvu') }}">Dịch vụ</a></li>
            </ul>
        </nav>
    </nav>
</header>
