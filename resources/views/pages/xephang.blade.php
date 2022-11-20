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
        .xephang {background: white; border-top:5px solid #32CD32; text-align: center;}
        .xephang img:hover {border: 10px solid rgba(0,0,0,0.0);}
        .xephang a{text-decoration: none;}
        .xephang a:hover {color: green;}
        .xephang h3 {margin-left: 15px;}
        .carousel-control-next {background: url(right-arrow.png) left top no-repeat;background-image: url(right-arrow.png);}
        .carousel-control-prev {background: url(left-arrow.png) left top no-repeat;background-image: url(left-arrow.png);}
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Xếp hạng</a></li>
        </ol>
        <h3>Bảng xếp hạng</h3>
    </nav>
</div>

<br>
<div class="row">
    <div class="col-12 xephang">
        <h3>Theo ngày</h3>
        <div class="owl-carousel owl-theme">
            @foreach ($day as $key => $value)
                <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                    <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: 120px; height: 180px; margin-left: -13px;">
                    <br><br><h5><b>{{$value->tentruyen}}</b></h5>
                    <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                </a>
            @endforeach
        </div>
        <span class="carousel-control-prev" style="top: 80px;"></span>
        <span class="carousel-control-next" style="top: 80px; left: 1100px;"></span>
    </div>
    
    <div class="col-12 xephang">
        <h3>Theo tuần</h3>
        <div class="owl-carousel owl-theme">
            @foreach ($week as $key => $value)
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: 120px; height: 180px; margin-left: -13px;">
                        <br><br><h5><b>{{$value->tentruyen}}</b></h5>
                        <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                    </a>
                </div>
            @endforeach
        </div>
        <span class="carousel-control-prev" style="top: 90px"></span>
        <span class="carousel-control-next" style="top: 90px; left: 1100px;"></span>
    </div>
    
    <div class="col-12 xephang">
        <h3>Theo tháng</h3>
        <div class="owl-carousel owl-theme">
            @foreach ($month as $key => $value)
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" style="width: 120px; height: 180px; margin-left: -13px;">
                        <br><br><h5><b>{{$value->tentruyen}}</b></h5>
                        <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                    </a>
                </div>
            @endforeach
        </div>
        <span class="carousel-control-prev" style="top: 90px"></span>
        <span class="carousel-control-next" style="top: 90px; left: 1100px;"></span>
    </div>

</div><br>

@endsection