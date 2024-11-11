<header>
    <div class="container header-container">
        <div class="logo">
            <img src="https://phongtro123.com/images/logo.png" alt="Phongtro123 Logo">
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="{{route('welcome')}}">Trang chủ</a></li>
                @foreach($clasRoom as $class => $cl)
                <li><a href="#">{{$cl->title}}</a></li>
                @endforeach
                <li><a href="{{route('indexBlog')}}">Tin tức</a></li>
                <li><a href="{{route('dichvu')}}">Dịch vụ</a></li>
            </ul>
        </nav>
        <div class="user-options">
            <button class="btn">Yêu thích</button>
            <a href="{{route('admin.index')}}" style="text-decoration: none;">
                <button class="btn">Đăng nhập</button></a>
            <a href="{{route('admin.roomsCore.createCore')}}" style="text-decoration: none;">
            <button class="btn highlight">Đăng tin miễn phí</button></a>
        </div>
    </div>
</header>
