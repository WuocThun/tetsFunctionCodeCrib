@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        <a href="{{route('admin.motel.create')}}"><button type="button" class="mb-3 mt-2 btn btn-secondary">Thêm phòng</button></a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Loại tiền</th>
                        <th scope="col">Chỉ số</th>
                        <th scope="col">Số tiền</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope="row">Tiền phòng</th>
                        <td></td>
                        <td>1,000,000 VNĐ</td>
                    </tr>
                    <tr>
                        <th scope="row">Tiền điện</th>
                        <td>( {{$invoice->new_electric}}kWH - {{$invoice->old_electric}}kWH = {{$invoice->new_electric - $invoice->old_electric }} kWH x {{ number_format($invoice->money_electric,0,',', '.') }} VNĐ) =</td>
                        <td>{{ number_format($invoice->electric_fee,0,',', '.') }} VNĐ</td>
                    </tr>
                    <tr>
                        <th scope="row">Tiền nước</th>
                        <td>( {{$invoice->new_water}}kWH - {{$invoice->old_water}}kWH = {{$invoice->new_water- $invoice->old_water }} kWH x {{ number_format($invoice->money_water,0,',', '.') }} VNĐ) =</td>
                        <td>{{ number_format($invoice->water_fee,0,',', '.') }} VNĐ</td>
                    </tr>  <tr>
                        <th scope="row"></th>
                        <td class="fw-bold text-danger">Tổng tiền</td>
                        <td class="fw-bold text-danger" >{{ number_format($invoice->total_amount,0,',', '.') }} VNĐ</td>

                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="row ml-3 mb-3">
                <div class="col-md-4">
                    <button class="btn btn-info">In hoá đơn</button>
                </div>
                <div class="col-md-4">

                <button class="btn btn-warning">In hoá đơn</button>
                </div>
                <div class="col-md-4">

                <button class="btn btn-danger">In hoá đơn</button>
                </div>
                </div>
            </div>
        </div>
    </main>


@endsection

