@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($truyen);
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
                <div class="card-body">
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
                            @foreach($truyen as $key => $tr)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $tr->tentruyen }}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$tr->hinhanh)}}" height="150" width="100"></td>
                                <td>
                                    {{ $tr->tacgia }}
                                </td>
                                <td>
                                    <p style="width: 300px">
                                        {{ $tr->tomtat }}
                                    </p>
                                </td>
                                <td>{{ $tr->danhmuctruyen->tendanhmuc }}</td>
                                <td>
                                    @foreach($tr->thuocnhieutheloaitruyen as $key => $value)    
                                        <span class="badge text-bg-primary">{{ $value->tentheloai }}</span>
                                    @endforeach
                                </td>
                                <td>{{$tr->created_at}} <br><p>{{$tr->created_at->diffForHumans()}}</p></td>
                                <td>{{$tr->updated_at}} <br><p>{{$tr->updated_at->diffForHumans()}}</p></td>
                                <td>
                                    @if($tr->trangthai==0)
                                        <span class="text text-success">Hoàn thành</span>
                                    @else
                                        <span class="text text-primary">Đang tiến hành</span>
                                    @endif
                                </td>
                                <td>
                                    @if($tr->truyen_noibat == 0)
                                        <form>
                                            @csrf
                                            <select style="width: 120px" name="truyennoibat" data-truyen_id="{{$tr->id}}" class="custom-select truyennoibat">
                                                <option selected value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @elseif($tr->truyen_noibat == 1)
                                        <form>
                                            @csrf
                                            <select style="width: 120px" name="truyennoibat" data-truyen_id="{{$tr->id}}" class="custom-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option selected value="1">Truyện nổi bật</option>
                                                <option value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @else($tr->truyen_noibat == 2)
                                        <form>
                                            @csrf
                                            <select style="width: 120px" name="truyennoibat" data-truyen_id="{{$tr->id}}" class="custom-select truyennoibat">
                                                <option value="0">Truyện hay</option>
                                                <option value="1">Truyện nổi bật</option>
                                                <option selected value="2">Truyện xem nhiều</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    @if($tr->top_view == 0)
                                        <form>
                                            @csrf
                                            <select style="width: 70px" name="topview" data-truyen_id="{{$tr->id}}" class="custom-select topview">
                                                <option selected value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @elseif($tr->top_view == 1)
                                        <form>
                                            @csrf
                                            <select style="width: 70px" name="topview" data-truyen_id="{{$tr->id}}" class="custom-select topview">
                                                <option value="0">Ngày</option>
                                                <option selected value="1">Tuần</option>
                                                <option value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @else($tr->top_view == 2)
                                        <form>
                                            @csrf
                                            <select style="width: 70px" name="topview" data-truyen_id="{{$tr->id}}" class="custom-select topview">
                                                <option value="0">Ngày</option>
                                                <option value="1">Tuần</option>
                                                <option selected value="2">Tháng</option>
                                            </select>
                                        </form>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('truyen.edit',[$tr->id])}}" class="btn btn-primary" style="width: 70px; margin-bottom: 10px;">Edit</a><br><br>
                                    <form action="{{route('truyen.destroy',[$tr->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 70px; margin-bottom: 10px; margin-top: -20px">Delete</button>
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
