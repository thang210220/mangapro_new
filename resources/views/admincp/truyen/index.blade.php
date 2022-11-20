@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($list_truyen);
                @endphp
                <div class="card-header">Danh sách truyện: {{$count}}</div>
                <style>
                    .title_truyen {margin-left: 10px}
                    .kytu {margin-left: 10px}
                    .kytu a {color: black; padding: 5px 13px; background: #FFCC66; cursor: pointer; font-weight: bold;}
                    .kytu a:hover {color: blue; margin-left: 10px}
                </style>
                <div class="row">
                    <h3 class="title_truyen">Lọc A - Z</h3>
                    <table class="kytu">
                        <tr>
                        @foreach(range('A', 'Z') as $char)
                            <th><a href="{{url('/kytu/'.$char)}}">{{$char}}</a></th>
                        @endforeach
                        </tr>
                    </table>
                </div>
                <div id="thongbao"></div>
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
                                <th>Tên truyện</th>
                                <th>Ảnh</th>
                                <th>Tác giả</th>
                                <th>Tóm tắt</th>
                                <th>Danh mục</th>
                                <th>Thể loại</th>
                                <th>Ngày tạo</th>
                                <th>Ngày cập nhật</th>
                                <th>Trạng thái</th>
                                <th>Loại truyện</th>
                                <th>Top View</th>
                                <th>Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($list_truyen as $key => $truyen)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $truyen->tentruyen }}</td>
                                <td>
                                    <img src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}" height="150" width="100">
                                </td>
                                <td>
                                    {{ $truyen->tacgia }}
                                </td>
                                <td>
                                    <p style="width: 300px;">
                                        {{ $truyen->tomtat }}
                                    </p>
                                </td>
                                <td>{{ $truyen->danhmuctruyen->tendanhmuc }}</td>
                                <td>
                                    @foreach($truyen->thuocnhieutheloaitruyen as $key => $value)    
                                        <span class="badge text-bg-primary">{{ $value->tentheloai }}</span>
                                    @endforeach
                                </td>
                                <td>{{$truyen->created_at}} <br><p>{{$truyen->created_at->diffForHumans()}}</p></td>
                                <td>{{$truyen->updated_at}} <br><p>{{$truyen->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    @if($truyen->trangthai==0)
                                        <span class="text text-success">Hoàn thành</span>
                                    @else
                                        <span class="text text-primary">Đang tiến hành</span>
                                    @endif
                                </td>
                                <td>
                                    @if($truyen->truyen_noibat == 0)
                                        <form>
                                            @csrf
                                            <select style="width: 120px" name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                                <option selected value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @elseif($truyen->truyen_noibat == 1)
                                        <form>
                                            @csrf
                                            <select style="width: 120px" name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option selected value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @else($truyen->truyen_noibat == 2)
                                        <form>
                                            @csrf
                                            <select style="width: 120px" name="truyennoibat" data-truyen_id="{{$truyen->id}}" class="custom-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option selected value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if($truyen->top_view == 0)
                                        <form>
                                            @csrf
                                            <select style="width: 70px" name="topview" data-truyen_id="{{$truyen->id}}" class="custom-select topview">
                                                <option selected value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @elseif($truyen->top_view == 1)
                                        <form>
                                            @csrf
                                            <select style="width: 70px" name="topview" data-truyen_id="{{$truyen->id}}" class="custom-select topview">
                                                <option value="0">Ngày</option>
                                                <option selected value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @else($truyen->top_view == 2)
                                        <form>
                                            @csrf
                                            <select style="width: 70px" name="topview" data-truyen_id="{{$truyen->id}}" class="custom-select topview">
                                                <option value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option selected value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('truyen.edit',[$truyen->id])}}" class="btn btn-primary" style="width: 70px; margin-bottom: 10px;">Edit</a>
                                    <form action="{{route('truyen.destroy',[$truyen->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 70px; margin-bottom: 10px;">Delete</button>
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
