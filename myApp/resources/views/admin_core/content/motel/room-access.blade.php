@extends('admin_core.layouts.test')

@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        <a href="{{route('admin.motel.create')}}">
            <button type="button" class="mb-3 mt-2 btn btn-secondary">Thêm phòng</button>
        </a>
        {{--        <button data-user-id="{{ auth()->id() }}" class="add-more-motel btn zalo-btn">Thêm vào danh sách yêu thích</button>--}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        @if(isset($motel))
            <div class="row">

                <div class="col-md-4 mb-3">
                    <div class="card room-card">
                        <!-- Header -->
                        <div class="card-header text-center bg-warning">
                            <img class="img-fluid" src="{{ asset('uploads/logoCodeCrib.png') }}">
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <h6 class="room-name">{{ $motel->name }}</h6>
                            <ol class="list-group list-group-numbered">
                                <li class="list-group-item d-flex justify-content-between align-items-start center">
                                    <div class="ms-2 me-auto">
                                        <div class="fw-bold">Nhập mật khẩu để mở khoá</div>
                                        <button type="button" class="fs-m btn-info" data-bs-toggle="modal"
                                                data-bs-target="#requestModal{{$motel->id}}">
                                            Tại đây
                                        </button>
                                    </div>
                                </li>
                            </ol>
                            <div class="modal fade" id="requestModal{{$motel->id}}" tabindex="-1"
                                 aria-labelledby="requestModalLabel{{$motel->id}}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="requestModalLabel{{$motel->id}}">Danh sách yêu
                                                cầu tham gia phòng</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('admin.check.passcode') }}" method="POST">
                                                @csrf

                                                <div class="mb-3">
                                                    <label for="motel_id" class="form-label text-dark">Tên
                                                        phòng: {{$motel->name }}</label>

                                                    <input type="text" name="motel_id" hidden value="{{ $motel->id }}"
                                                           id="">
                                                </div>

                                                <div class="mb-3">
                                                    <label for="password" class="form-label text-dark">Nhập
                                                        password</label>
                                                    <input type="text" class="form-control" id="password"
                                                           name="password" required>
                                                </div>

                                                <button type="submit" class="btn btn-primary">Kiểm Tra</button>
                                            </form>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                                Đóng
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="room-info my-3">
                                @if (session("motel_unlocked_{$motel->id}"))
                                    <div class="actions d-flex justify-content-between">
                                        <button class="btn btn-info"
                                                onclick="window.location.href='{{ route('admin.motel.addUserMotel', ['id' => $motel->id]) }}'">
                                            <i class="fas fa-user-friends"></i>
                                        </button>
                                        @if(isset($motel->getInvoicesBy($motel->id)->first()->id))
                                            <button class="btn btn-warning"
                                                    onclick="window.location.href='{{ route('admin.invoices.pay', ['id' => $motel->getInvoicesBy($motel->id)->first()->id]) }}'">
                                                <i class="fas fa-receipt"></i>
                                            </button>
                                        @endif

                                        <form action="{{ route('admin.motel.leave') }}"
                                              method="POST" style="display: inline;">
                                            @csrf
{{--                                            @method('DELETE')--}}
                                            <button type="submit" class="btn btn-danger"
                                                    onclick="return confirm('Bạn có muốn thoát phòng không?')">
                                                <i class="fas fa-sign-out-alt"></i></button>
                                        </form>
                                    </div>
                                @else
                                    <p class="text-danger">Bạn cần nhập đúng mật khẩu để mở khóa phòng.</p>
                                @endif
                            </div>
                            <div class="card-footer text-center row">
                                <div class="col-md-6  ">
                                    <p>Ngày tính
                                        tiền: {{ \Carbon\Carbon::parse($motel->money_date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Tiền phòng: {{ number_format($motel->money,0,',', '.') }} đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

            </div>
        @else
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card room-card">
                        <!-- Header -->
                        <div class="card-header text-center bg-warning">
                            <img class="img-fluid" src="{{ asset('uploads/logoCodeCrib.png') }}">
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <h6 class="room-name">Bạn chưa có phòng nào hết, mau đăng ký lẹ đi</h6>

                            <div class="card-footer text-center row">
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>

            </div>
        @endif
    </main>

@endsection




