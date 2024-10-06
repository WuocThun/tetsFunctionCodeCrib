@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Cấp quyền cho User: <b> {{$user->name}}</b>
                </div>
                <form action="{{route('admin.insert_permission', $user->id)}}" method="post">
                    @csrf
                    @if(isset($name_roles))
                        Vai trò hiện tại của bạn: <b>{{$name_roles}}</b>
                    @endif
                    @foreach($permission as $key => $per)
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" name="permission[]" multiple value="{{$per->name}}"
                                   id="{{$per->id}}">
                            <label class="form-check-label" for="{{$per->id}}">
                                {{$per->name}}
                            </label>
                        </div>
                    @endforeach
                    <br>

                    <input type="submit" name="insertRole" value="Cấp quyền cho User" class="btn btn-primary">
                </form>
            </div>
        </div>
    </div>
@endsection
