@extends('../layout')

@section('content')

<br>
<div class="row bread-crumb">
    <style>
        .bread-crumb {border-top:5px solid #32CD32; background: white;}
        .breadcrumb {background: white;}
        .breadcrumb a{text-decoration: none; color: #FF9900;}
        .breadcrumb a:hover {color: #007bff}
        .bread-crumb h3 {margin-left: 10px;}
        .all{background: white; text-align: center;}
        .all img{width: 150px; height: 220px; margin-left: -15px;}
        .all img:hover {border: 10px solid rgba(0,0,0,0.0);}
        .all a{text-decoration: none;}
        .all a:hover {color: green;}
        #all {background: white; border-top:5px solid #32CD32;}
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Xem tất cả</a></li>
        </ol>
        <h3>Xem tất cả</h3>
    </nav>
</div>

<br>
<div class="row all" id="all">
    @foreach ($xemtatca as $key => $value)
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
    {{ $xemtatca->links('pagination::bootstrap-4') }}
</div>    

@endsection