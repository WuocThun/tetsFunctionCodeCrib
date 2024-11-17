@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')
    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Code Crib</a></li>
                <li class="breadcrumb-item"><a href="index.html">Quản lý</a></li>
                <li class="breadcrumb-item active" aria-current="page">Nạp tiền</li>
            </ol>
        </nav>
        <div class="main-box">

            <div class="note alert alert-success js-promotion-payment-daily" role="alert">
                <p><strong>Khuyến mãi:</strong></p>
                <ul>
                    <li>Nạp từ 50.000 đến dưới 1.000.000 tặng <strong>10%</strong></li>
                    <li>Nạp từ 1.000.000 đến dưới 2.000.000 tặng <strong>20%</strong></li>
                    <li>Nạp từ 2.000.000 trở lên tặng <strong>25%</strong></li>
                </ul>
            </div>

            <div class="payment-form">
                <form action="{{ route('admin.payment.mbbank.createPaymentLink') }}" method="post">
                    @csrf
                    <div class="checkout">
                        <div class="product">
                            <p><strong>Tên người nhận:</strong> {{ auth()->user()->name }}</p>

                            <label for="amount"><strong>Giá tiền:</strong></label>
                            <div class="input-group mb-3">
                                <input type="number" id="amount" name="amount" class="form-control" min="2000"
                                       max="9000000" step="1" required
                                       oninput="convertAmount()" placeholder="Nhập số tiền...">
                                <div class="input-group-append">
                                    <span class="input-group-text">VNĐ</span>
                                </div>
                            </div>

                            <p id="amountText" class="amount-text"></p>
                        </div>

                        <button type="submit" class="btn btn-primary" id="create-payment-link-btn">
                            Tạo Link thanh toán
                        </button>
                    </div>
                </form>

            </div>

        </div>

    </main>

    <div class="col-md-3 d-none d-md-block">
        <div class="card mb-3">
            <div class="card-body">
                <div>Số dư tài khoản</div>
                <h3 class="heading" style="margin-top: 0; margin-bottom: 0; color: #28a745;">
                    <strong>{{number_format(auth()->user()->balance,0,',', '.')}} VND</strong>
                </h3>
            </div>
        </div>
        <a class="btn btn-secondary btn-block" href="./lich-su-nap-tien.html">Lịch sử nạp tiền <svg
                xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                stroke-linejoin="round" class="feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg></a>
        <a class="btn btn-secondary btn-block" href="./lich-su-thanh-toan.html">Lịch sử thanh toán
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                 fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                 stroke-linejoin="round" class="feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg></a>
        <a class="btn btn-secondary btn-block" href="https://phongtro123.com/bang-gia-dich-vu">Bảng
            giá dịch vụ <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                             viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                             stroke-linecap="round" stroke-linejoin="round"
                             class="feather feather-chevron-right">
                <polyline points="9 18 15 12 9 6"></polyline>
            </svg></a>
    </div>

@endsection
@section('script')
    <script src="{{asset('style/js/payment.js')}}"></script>
@endsection
