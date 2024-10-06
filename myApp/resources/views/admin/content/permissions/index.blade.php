@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Danh sách tất cả người dùng</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <a href="{{route('admin.user.create')}}" class="btn btn-success"> Thêm người dùng </a>
                        <table class="table table-striped table-responsive">
                            <thead>
                            <tr>
                                <table id="myTable" class="table">
                                    <thead>
                                    <th scope="col">ID</th>
                                    <th scope="col">Tên User</th>
                                    <th scope="col">Email</th>
{{--                                    <th scope="col">Password</th>--}}
                                    <th scope="col">Vai trò (roles)</th>
                                    <th scope="col">Quyền (permission)</th>
                                    <th scope="col">Quản lý</th>
                                    </thead>
                                    <tbody>
                                    @foreach($user as $key =>$us)
                                    <tr>
                                        <th>{{$us->id}}</th>
                                        <th>{{$us->name}}</th>
                                        <th>{{$us->email}}</th>
                                        <th></th>
                                        <th></th>
                                        <th>
                                            <a href="{{route('admin.assgin',$us->id)}}" class="btn btn-warning">Phân vai trò</a>
                                            <a href="{{route('admin.permission',$us->id)}}" class="btn btn-success">Phân thêm quyền</a>
                                        </th>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                </th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
