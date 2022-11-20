@extends('../layout')

@section('content')

<br>
<div class="row bread-crumb">
    <style>
        .bread-crumb {border-top:5px solid #32CD32; background: white;}
        .breadcrumb {background: white;}
        .breadcrumb a{text-decoration: none; color: #FF9900;}
        .breadcrumb a:hover {color: #007bff}
        .bread-crumb h3 {margin-left: 15px;}
        .trangthai {background: white; border-top:5px solid #32CD32; text-align: center;}
        .trangthai img{width: 150px; height: 220px; margin-left: -15px;}
        .trangthai img:hover {border: 10px solid #DCDCDC;}
        .trangthai a{text-decoration: none;}
        .trangthai a:hover {color: green;}
        .trangthai h3 {margin-left: 15px;}
        .btn {margin-left: 15px;}
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('/trang-thai')}}">Trạng thái</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Đang tiến hành</a></li>
        </ol>
        <h3>Manga đang tiến hành</h3>
        <a href="{{url('/hoanthanh/')}}" class="btn btn-danger">Hoàn thành</a>
        <a href="{{url('/dangtienhanh/')}}" class="btn btn-success">Đang tiến hành</a>
    </nav>
</div>

<br>
<div class="row trangthai">
    @foreach ($dangtienhanh as $key => $value)
        <div class="col-2">
            <div class="card-body">
                <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                    <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" >
                    <br><br><h5><b>{{$value->tentruyen}}</b></h5>
                    <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                </a>
            </div>
        </div>
    @endforeach
</div><br>
<div class="row">
    {{ $dangtienhanh->links('pagination::bootstrap-4') }}
</div>

@endsection