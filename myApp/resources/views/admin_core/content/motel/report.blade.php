@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        {{--        <button data-user-id="{{ auth()->id() }}" class="add-more-motel btn zalo-btn">Thêm vào danh sách yêu thích</button>--}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="container mt-5">
            <h2 class="text-center mb-4">Báo cáo tài chính</h2>
            <div class="row mb-4">
                <div class="col-lg-4">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tổng tiền phòng thu được</h5>
                            <p class="card-text fs-4">{{ number_format($totalAmount, 0, ',', '.') }} VNĐ</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center bg-primary text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tổng tiền điện thu được</h5>
                            <p class="card-text fs-4">{{ number_format($totalElectric, 0, ',', '.') }} VNĐ</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card text-center bg-info text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tổng tiền nước thu được</h5>
                            <p class="card-text fs-4">{{ number_format($totalWater, 0, ',', '.') }} VNĐ</p>
                        </div>
                    </div>
                </div>
            </div>

            <h3 class="mt-4">Chi tiết hóa đơn</h3>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>STT</th>
                    <th>Mã hóa đơn</th>
                    <th>Tiền phòng</th>
                    <th>Tiền điện</th>
                    <th>Tiền nước</th>
                    <th>Tiền phụ thu</th>
                    <th>Tổng tiền</th>
                    <th>Đã thanh toán ngày</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $index => $invoice)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $invoice->motel->name }}</td>
                        <td>{{  number_format(($invoice->all_money - $invoice->electric_fee - $invoice->water_fee) , 0, ',', '.') . ' VNĐ',}}</td>
                        <td>{{ number_format(($invoice->new_electric - $invoice->old_electric) * $invoice->electric_fee, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format(($invoice->new_water - $invoice->old_water) * $invoice->water_fee, 0, ',', '.') }} VNĐ</td>
                        <td>{{            number_format($invoice->money_another , 0, ',', '.') . ' VNĐ',}}</td>
                        <td>{{ number_format($invoice->total_amount, 0, ',', '.') }} VNĐ</td>
{{--                        <td>{{ ucfirst($invoice->status) }}</td>--}}
                        <td>{{ \Carbon\Carbon::parse($invoice->paid_at)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <div class=" mt-3">
                <a href="{{ route('admin.export.invoices') }}" class="btn btn-success mb-3">
                    <i class="fas fa-file-excel"></i> Xuất Excel
                </a>
            </div>
        </div>

    </main>

@endsection

