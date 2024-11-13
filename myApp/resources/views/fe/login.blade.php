
@extends('fe.layouts.app')
@section('title','Chi tiết bài viết')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
<div class="login-container">
    <div class="form">
        <h1>Đăng nhập</h1>
        <form>
            <div class="form-group">
                <label for="phone">SỐ ĐIỆN THOẠI</label>
                <input type="text" id="phone" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-group">
                <label for="password">MẬT KHẨU</label>
                <input type="password" id="password" placeholder="Nhập mật khẩu">
            </div>
            <button type="submit" id="loginbtn">Đăng nhập</button>
        </form>
        <div class="footer-links">
            <a href="#">Bạn quên mật khẩu?</a>
            <a href="register.html">Tạo tài khoản mới</a>
        </div>
    </div>
</div>
@endsection
@section('overView')
    @include('fe.inc.over_view')
@endsection
@section('footer')
    @include('fe.inc.footer')
@endsection
