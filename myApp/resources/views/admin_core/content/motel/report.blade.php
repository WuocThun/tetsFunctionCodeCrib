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
            <!-- Summary Section -->
{{--        <div class="card">--}}
{{--            <div class="card-body">--}}
{{--            <div class="row mb-2">--}}
{{--                <div class="col-lg-3 col-md-6 mb-3">--}}
{{--                    <div class="card text-center bg-warning text-white">--}}
{{--                        <div class="card-body">--}}
{{--                            <button class="btn btn-white"><i class="fas fa-money-bill"></i></button>--}}
{{--                            <h5 class="card-title">Tổng thu</h5>--}}
{{--                            <p class="card-text fs-4">{{ number_format($totalAmount,0,',', '.') }} VNĐ</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 mb-3">--}}
{{--                    <div class="card text-center bg-primary text-white">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Tổng nợ</h5>--}}
{{--                            <p class="card-text fs-4">0 VNĐ</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 mb-3">--}}
{{--                    <div class="card text-center bg-danger text-white">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Tổng điện</h5>--}}
{{--                            <p class="card-text fs-4">{{ number_format($totalElectric,0,',', '.') }} VNĐ</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="col-lg-3 col-md-6 mb-3">--}}
{{--                    <div class="card text-center bg-info text-white">--}}
{{--                        <div class="card-body">--}}
{{--                            <h5 class="card-title">Tổng nước</h5>--}}
{{--                            <p class="card-text fs-4">17,500 VNĐ</p>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--            </div>--}}
{{--            <div class="card">--}}
{{--                <!-- Export and Filter Section -->--}}
{{--                <div class="card-header">--}}
{{--                    <div class="d-flex justify-content-between align-items-center mb-3">--}}
{{--                        <button class="btn btn-primary">Xuất Excel báo cáo</button>--}}
{{--                        <div class="d-flex">--}}
{{--                            <input type="date" class="form-control me-2">--}}
{{--                            <select class="form-select">--}}
{{--                                <option selected>Tháng 7</option>--}}
{{--                                <option>Tháng 8</option>--}}
{{--                                <option>Tháng 9</option>--}}
{{--                            </select>--}}
{{--                            <button class="btn btn-danger ms-2">Xóa</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <!-- Table Section -->--}}
{{--                <div class="card-body">--}}
{{--                    <table class="table">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th>STT</th>--}}
{{--                            <th>Tên phòng</th>--}}
{{--                            <th>Ngày</th>--}}
{{--                            <th>Tiền phòng</th>--}}
{{--                            <th>Tiền điện</th>--}}
{{--                            <th>Tiền nước</th>--}}
{{--                            <th>Tiền phụ thu</th>--}}
{{--                            <th>Tên nợ</th>--}}
{{--                            <th>Tổng tiền</th>--}}
{{--                            <th>Trạng thái</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        <tr>--}}
{{--                            <th scope="row">1</th>--}}
{{--                            <td>Mark</td>--}}
{{--                            <td>Otto</td>--}}
{{--                        </tr>--}}


{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="container mt-5">
            <h2 class="text-center mb-4">Báo cáo tài chính</h2>
            <div class="row mb-4">
                <div class="col-lg-4">
                    <div class="card text-center bg-success text-white">
                        <div class="card-body">
                            <h5 class="card-title">Tổng tiền thu được</h5>
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
                    <th>Tiền điện</th>
                    <th>Tiền nước</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                @foreach($invoices as $index => $invoice)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $invoice->id }}</td>
                        <td>{{ number_format(($invoice->new_electric - $invoice->old_electric) * $invoice->electric_fee, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format(($invoice->new_water - $invoice->old_water) * $invoice->water_fee, 0, ',', '.') }} VNĐ</td>
                        <td>{{ number_format($invoice->total_amount, 0, ',', '.') }} VNĐ</td>
                        <td>{{ ucfirst($invoice->status) }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </main>

@endsection

