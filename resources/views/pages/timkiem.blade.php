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
        .timkiem{text-align: center;}
        .timkiem img{width: 150px; height: 220px; margin-left: -15px;}
        .timkiem img:hover {border: 10px solid rgba(0,0,0,0.0);}
        .timkiem a{text-decoration: none;}
        .timkiem a:hover {color: green;}
        #timkiem {background: white; border-top:5px solid #32CD32;}
        .updating {background: white;}
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="#">Tìm kiếm</a></li>
        </ol>
        <h3>Từ khóa tìm kiếm: {{$tukhoa}}</h3>
    </nav>
</div>

<br>
<div class="row timkiem" id="timkiem">
    @php
        $count = count($truyen);
    @endphp
    @if($count == 0)
        <div class="col-md-12 updating">
            <div class="card-body">
                <h3>Không tìm thấy truyện...</h3>
            </div>
        </div>
    @else
        @foreach ($truyen as $key => $value)
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
    @endif
</div><br>
<div class="row">
    {{ $truyen->links('pagination::bootstrap-4') }}
</div>

@endsection