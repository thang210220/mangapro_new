@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($chapter);
                @endphp
                <div class="card-header">Danh sách chapter: {{$count}}</div>

                <style>
                    .title_truyen3 {margin-left: 10px}
                    .kytu3 {margin-left: 10px}
                    .kytu3 a {color: black; padding: 5px 13px; background: #FFCC66; cursor: pointer; font-weight: bold;}
                    .kytu3 a:hover {color: blue; margin-left: 10px}
                </style>
                <div class="row">
                    <h3 class="title_truyen3">Lọc A - Z</h3>
                    <table class="kytu3">
                        <tr>
                        @foreach(range('A', 'Z') as $char)
                            <th><a href="{{url('/kytu3/'.$char)}}">{{$char}}</a></th>
                        @endforeach
                        </tr>
                    </table>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-dark" id="myTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Chapter</th>
                                <th>Tên Chapter</th>
                                <th>Thuộc truyện</th>
                                <th>Slug Chapter</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($chapter as $key => $tr)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $tr->chap }}</td>
                                <td>{{ $tr->tieude }}</td>
                                <td>{{ $tr->truyen->tentruyen }}</td>
                                <td>{{ $tr->slug_chapter }}</td>
                                <td>{{$tr->created_at}} <br><p>{{$tr->created_at->diffForHumans()}}</p></td>
                                <td>{{$tr->updated_at}} <br><p>{{$tr->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    <a href="{{route('chapter.edit',[$tr->id])}}" class="btn btn-primary" style="width: 110px;">Edit</a><br><br>
                                    <a href="{{url('/add-gallery/'.$tr->id)}}" class="btn btn-success" style="width: 110px; margin-bottom: 10px; margin-top: -10px;">Chi tiết</a>
                                    <form action="{{route('chapter.destroy',[$tr->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 110px; margin-bottom: 10px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
