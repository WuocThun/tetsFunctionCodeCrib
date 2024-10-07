@extends('admin.layouts.app')
@section('navbar')
    @include('admin.inc.navbar')
@endsection
@section('main')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">Danh Sách Blog</div>

                    <div class="card-body">

                        <p>{{$blog->title}}</p>
                        @php
                        echo $blog->description
                        @endphp
                            @if($blog->status == 1)
                                <p class="text-success btn"> Hiển thị </p>
                            @elseif($blog->status == 0)
                                <p class="text-danger btn"> Không hiện thị </p>
                            @else
                                <p class="text-warning btn"> Đang đợi duyệt</p>
                            @endif

                            {{$blog->created_at}}

                            <img width="200px" height="100px"
                                 src="{{asset('uploads/blogs/'.$blog->image)}}" alt="">
                            <a class="btn btn-warning"
                               href="{{route('admin.get_pending_blogs')}}">Quay lại</a>
                        <a class="btn btn-primary"
                           href="{{route('admin.get_pending_blogs')}}">Xác nhận duyệt bài</a>
                        <a class="btn btn-danger"
                           href="{{route('admin.get_pending_blogs')}}">Từ chối</a>

                        {{--                                                <form method="post"--}}
                            {{--                                                      action="{{route('admin.blogs.destroy',[$blog->id])}}">--}}
                            {{--                                                    @method('DELETE')--}}
                            {{--                                                    @csrf--}}
                            {{--                                                    <button onclick="return confirm('Bạn có muốn xoá?')"--}}
                            {{--                                                            class="btn btn-danger">Xoá--}}
                            {{--                                                    </button>--}}
                            {{--                                                </form>--}}
                        {{--                                                    {{$bloggory->links('pagination::boostrap-4')}}--}}
                        {{--                        {{$blog->links('pagination::bootstrap-4')}}--}}


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
