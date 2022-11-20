@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm truyện</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('truyen.store')}}" enctype='multipart/form-data'>
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên truyện</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('tentruyen')}}" onkeyup="ChangeToSlug();" name="tentruyen" id="slug" aria-describedby="emailHelp" placeholder="Tên truyện ...">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tác giả</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('tacgia')}}" name="tacgia" aria-describedby="emailHelp" placeholder="Tác giả ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug truyện</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('slug_truyen')}}" name="slug_truyen" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug truyện ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Tóm tắt truyện</label>
                            <textarea style="margin-top:10px; resize: none;" name="tomtat" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Danh mục truyện</label><br>
                            <select style="margin-top:10px; width:100%" name="danhmuc" class="custom-select">
                                @foreach($danhmuc as $key => $muc)
                                <option value="{{$muc->id}}">{{$muc->tendanhmuc}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Banner truyện</label><br>
                            <select style="margin-top:10px; width:100%" name="banner" class="custom-select">
                                @foreach($banner as $key => $ban)
                                <option value="{{$ban->id}}">{{$ban->tenbanner}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Thể loại truyện</label><br>
                            @foreach($theloai as $key => $the)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="checkbox" name="theloai[]" id="theloai_{{$the->id}}" value="{{$the->id}}">
                                <label class="form-check-label" for="theloai_{{$the->id}}">{{$the->tentheloai}}</label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Ảnh</label><br>
                            <input style="margin-top:10px" type="file" class="form-control-file" name="hinhanh">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Trạng thái</label><br>
                            <select style="margin-top:10px; width:100%" name="trangthai" class="custom-select">
                                <option value="0">Hoàn thành</option>
                                <option value="1">Đang tiến hành</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Kiểu</label><br>
                            <select style="margin-top:10px; width:100%" name="truyennoibat" class="custom-select">
                                <option value="0">Truyện hay</option>
                                <option value="1">Truyện nổi bật</option>
                                <option value="2">Truyện xem nhiều</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Top view</label><br>
                            <select style="margin-top:10px; width:100%" name="topview" class="custom-select">
                                <option value="0">Ngày</option>
                                <option value="1">Tuần</option>
                                <option value="2">Tháng</option>
                            </select>
                        </div>

                        <button style="margin-top:10px" type="submit" name="themtruyen" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
