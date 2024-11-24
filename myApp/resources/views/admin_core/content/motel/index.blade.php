@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        <a href="{{route('admin.motel.create')}}"><button type="button" class="mb-3 mt-2 btn btn-secondary">Thêm phòng</button></a>
{{--        <button data-user-id="{{ auth()->id() }}" class="add-more-motel btn zalo-btn">Thêm vào danh sách yêu thích</button>--}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row">
            @foreach($motels as $motel)
                <div class="modal fade" id="addMemberModal{{$motel->id}}" tabindex="-1" aria-labelledby="addMemberModalLabel{{$motel->id}}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addMemberModalLabel{{$motel->id}}">Thông tin hoá đơn</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.invoices.create') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="motel_id" value="{{ $motel->id }}">

                                    <div class="row">
                                        <div class="col-md-6 mb-4">
                                            <label for="new_electric_{{$motel->id}}" class="form-label text-dark">Chỉ số điện mới:</label>
                                            <input type="number"  class="form-control" name="new_electric" min="{{$motel->default_electric}}" required>
                                            <input type="number" hidden class="form-control" name="money_water" value="{{$motel->money_water}}" required>
                                            <input type="number" hidden class="form-control" name="money_electric" value="{{$motel->money_electric}}" required>
                                            <input type="number" hidden class="form-control" name="money" value="{{$motel->money}}" required>
                                            <input type="number" hidden class="form-control" name="money_another" value="{{$motel->money_another}}" required>


                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="old_electric_{{$motel->id}}" class="form-label text-dark">Chỉ số điện cũ:</label>
                                            <input type="number" class="form-control" value="{{$motel->default_electric}}" name="old_electric" readonly>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="new_water_{{$motel->id}}" class="form-label text-dark">Chỉ số nước mới:</label>
                                            <input type="number" class="form-control" name="new_water" min="{{$motel->default_water}}" required>
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <label for="old_water_{{$motel->id}}" class="form-label text-dark">Chỉ số nước cũ:</label>
                                            <input type="number" class="form-control" value="{{$motel->default_water}}" name="old_water" readonly>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                        <button type="submit" class="btn btn-info">Tạo hoá đơn</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <div class="card room-card">
                        <!-- Header -->
                        <div class="card-header text-center bg-warning">
                            <img class="img-fluid" src="{{ asset('uploads/logoCodeCrib.png') }}">
                        </div>
                        <!-- Body -->
                        <div class="card-body">
                            <h6 class="room-name">{{ $motel->name }}</h6>
                            <span class="badge bg-secondary room-status status-room">Phòng chưa cài đặt</span>
                            <div class="room-info my-3">
                                <div class="row mb-2">
                                    <div class="col-md-6">
                                        <button class="btn btn-secondary rounded-circle status-room">
                                            Hiện có: {{ $motel->users_count }} người
                                        </button>
                                    </div>
                                    <div class="col-md-6">
                                        @if ($motel->users_count < $motel->total_member) <!-- Kiểm tra xem có dưới 4 người không -->
                                        <button class="btn btn-secondary room-type-btn status-room">
                                            Phòng trống: {{$motel->total_member}}
                                        </button>
                                        @else
                                            <button class="btn btn-success room-type-btn status-room" disabled>
                                                Phòng đã đầy
                                            </button>
                                        @endif
                                    </div>
                                </div>
                                <div class="actions d-flex justify-content-between">
                                    <button class="btn btn-info" onclick="window.location.href='{{ route('admin.motel.addUserMotel', ['id' => $motel->id]) }}'">
                                        <i class="fas fa-user"></i>
                                    </button>
                                    <button class="btn btn-warning" onclick="window.location.href='{{ route('admin.motel.edit', ['id' => $motel->id]) }}'">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button class="btn btn-purple" data-bs-toggle="modal" data-bs-target="#addMemberModal{{$motel->id}}">
                                        <i class="fas fa-calendar"></i>
                                    </button>

                                    <form action="{{ route('admin.motel.destroy', ['id' => $motel->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>

                                </div>
                            </div>
                            <div class="card-footer text-center row">
                                <div class="col-md-6  ">
                                    <p>Ngày tính tiền: {{ \Carbon\Carbon::parse($motel->money_date)->format('d/m/Y') }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p>Tiền phòng: {{ number_format($motel->money,0,',', '.') }} đ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Card -->
                </div>
            @endforeach

        </div>
    </main>


@endsection

