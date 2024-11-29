
@extends('fe.layouts.app')
@section('title','Chi tiết bài viết')
@section('header')
    @include('fe.inc.header')
@endsection
@section('main')
    <div class="login-container">
        <div class="form">
            <h1>Quên mật khẩu</h1>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="password">Vui lòng nhập Email</label>
                    <input name="password" type="password" id="password" placeholder="Nhập mật Email">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                </div>
                <button type="submit" id="loginbtn">Gửi</button>
            </form>
            <div class="footer-links">
                <a href="{{route('getLogin')}}">Đã có tài khoản?</a>
                <a href="{{route('getReginster')}}">Tạo tài khoản mới</a>
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
