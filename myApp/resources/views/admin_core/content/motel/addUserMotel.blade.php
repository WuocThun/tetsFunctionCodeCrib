@extends('admin_core.layouts.app')
@section('navbar')
    @include('admin_core.inc.navbar')
@endsection
@section('main')

    <main role="main" class="ml-sm-auto col">
        @include('admin_core.inc.sub_main')
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

    @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Code Crib</a></li>
                <li class="breadcrumb-item"><a href="{{route('admin.dashboardCore')}}">Quản lý</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">Thêm thành viên vào phòng</li>
            </ol>
        </nav>
        <div class="card">
            <div class="card-body">
                <button class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#addMemberModal">Thêm thành
                    viên vào phòng
                </button>
            </div>
            <div class="card-header">
                <h4>Danh sách thành viên: {{$getMotel->name}}</h4>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">STT</th>
                        <th scope="col">Họ tên</th>
                        <th scope="col">Số điện thoại</th>
                        <th scope="col">Trạng thái</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($getUserRentMotel as $motel => $user)
                    <tr>
                        <th scope="row">{{$user->id}}</th>
                        <td>{{$user->name}}</td>
                        <td> 0{{$user->phone_number}}</td>
                        <td></td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </main>
    <!-- Modal -->
    <div class="modal fade" id="addMemberModal" tabindex="-1" aria-labelledby="addMemberModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addMemberModalLabel">Thêm thành viên vào phòng</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.motel.storeUserMotel',['id',$getMotel->id])}}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                            <input type="text" class="form-control" id="motel_id" name="motel_id" value="{{$getMotel->id}}" hidden >
                        </div>
                        <div class="mb-3">
                            <label for="phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="phone_number" name="phone_number" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input class="form-control" id="password" name="password" readonly
                                   value="{{$getMotel->password}}" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm thành viên</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
