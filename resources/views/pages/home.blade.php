@extends('../layout')
@section('slide')
    @include('pages.slide')
@endsection
@section('content')

<div class="row bg_center">
    <div class="col-9 bg_left">
        <style>
            .bg_center {background: white;}
            .bg_left {border-right:15px solid #F8F8FF;}
            .slide-show img {width: 840px; height: 350px; padding: 0px 10px;}
            .bg_left h3 {margin-top: 10px;}
            .carousel-indicators {margin-left: 600px;}
            .carousel-indicators li{
                background-color: #fff;
                width: 10px;
                height: 10px;
                border-radius: 5px;
                border-radius: 50%;
                border-top-left-radius: 50%;
                border-top-right-radius: 50%;
                border-bottom-right-radius: 50%;
                border-bottom-left-radius: 50%;
                opacity: .2;
                margin-left: 10px;
            }
            li.active {background-color: #b71c1c}
            .carousel-caption h3 {color: #f1592a; margin-top: -10px;}
            .carousel-inner {width: 840px;}
            .carousel-img img {margin-left: -10px; width: 860px;}
            .carousel-darkcap {
                position: absolute;
                left: 0;
                top: 0;
                width: 50%;
                height: 350px;
                background: rgba(0,0,0,0.5);
                box-shadow: none;
                padding: 1.25rem;
                padding-top: 1.25rem;
                padding-right: 1.25rem;
                padding-bottom: 1.25rem;
                padding-left: 1.25rem
                z-index: 2;
                min-width: 450px;
                text-align: left;
                color: #fff;
                display: block;
            }
            .carousel-caption {
                position: absolute;
                left: 0;
                top: 0;
                width: 860px;
                height: 350px;
                background: rgba(0,0,0,0.3);
                border-radius: 5px;
            }
        </style>
        <div class="row slide-show" >
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
					<li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
				</ol>
				<div class="carousel-inner">
                    @php
                        $i = 0;
                    @endphp
                    @foreach ($banner as $key => $ban)
                        @php
                            $i++;
                        @endphp
                        <div class="carousel-item {{ $i==1 ? 'active' : '' }}">
                            <div class="carousel-img">
                                <img src="{{asset('public/uploads/truyen/'.$ban->banner_image)}}">
                            </div>
                            <div class="carousel-caption">
                                <div class="carousel-darkcap">
                                    <h3>{{$ban->tenbanner}}</h3>
                                    <p >{{$ban->banner_tomtat}}</p>
                                    <a href="{{url('xem-truyen/'.$ban->slug_banner)}}" class="btn btn-danger">Đọc truyện</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
				</div>
                <!-- <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a> -->
			</div>
        </div>
        <h3>TRUYỆN MỚI CẬP NHẬT</h3>
        <div class="row home-item">
            @foreach ($truyen as $key => $value)
            <div class="col-3">
                <style>
                    .card-body {text-align: center;}
                    .card-body img:hover {border: 10px solid rgba(0,0,0,0.0);}
                    .card-body a{text-decoration: none;}
                    .card-body a:hover {color: green;}
                    .card-body {width: 200px; height: 350px; margin-left: -10px; margin-bottom: 10px;}
                    .card-body img{width: 200px; height: 250px; margin-left: -20px; margin-top: -20px;}
                    .card-body h5{margin-top: 10px;}
                </style>
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}" alt="{{$value->tentruyen}}">
                        <h5>{{$value->tentruyen}}</h5>
                        <h6 class="text-muted">{{$value->views_truyen}} Lượt xem</h6>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
        <div class="row">
            <a href="{{url('xem-tatca')}}" class="btn btn-success btn-outline btn-block">Xem thêm ...</a>
        </div>
    </div>
    <div class="col-3 bg_right">
        <style>
            .fanpage {border-top:5px solid #32CD32; border-bottom: 15px solid #F8F8FF;}
            .fanpage iframe {width: 280px; height: 133px; border:none; overflow:hidden; margin-left: 2px;}
            .newupdated {border-top:5px solid #32CD32; border-bottom: 15px solid #F8F8FF;}
            .newupdated li{list-style: none; text-align: left; margin-left: -30px;}
            .newupdated li:hover{background: #FFCC66;}
            .newupdated a{text-decoration: none; color: blue;}
            .newupdated a:hover{color: green;}
        </style>
        <div class="row fanpage">
            <h3>Fanpage Mangapro</h3>
            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FMangaprocom-101305011774420%2F&tabs=timeline&width=280&height=600&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
            <p>Like hoặc chia sẻ page mangapro để theo dõi manga mới nhất.</p>
        </div>
        <div class="row newupdated">
            <h3>Chapter mới cập  nhật</h3>
            @foreach ($chapter as $key => $chap)
            <div class="col-12">
                <!-- {{$chap->truyen->tentruyen}}  {{$chap->chap}}<br>
                {{$chap->truyen->views_truyen}}<br>
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$chap->truyen->hinhanh)}}" alt="{{$chap->truyen->tentruyen}}"><br> -->
                <ul>
                    <a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">
                        <li>{{$chap->truyen->tentruyen}}  {{$chap->chap}}</li>
                    </a>
                </ul>
            </div>
            @endforeach
        </div>
        <div class="row xemnhieu">
            <h3>Truyện xem nhiều</h3>
            <style>
                .xemnhieu {border-top:5px solid #32CD32;}
                .xemnhieu img {width: 60px; height: 90px; padding: 5px 5px;}
                .xemnhieu img:hover {border: 5px solid rgba(0,0,0,0.0);}
                .xemnhieu a {text-decoration: none; font-weight: bold;}
                .xemnhieu a:hover {color: green;}
                .xemnhieu ul li {margin-left: 10px;}
            </style>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active filter-sidebar" id="pills-home-tab" data-toggle="pill" href="#ngay" role="tab" aria-controls="pills-home" aria-selected="true">Ngày</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-sidebar" id="pills-profile-tab" data-toggle="pill" href="#tuan" role="tab" aria-controls="pills-profile" aria-selected="false">Tuần</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link filter-sidebar" id="pills-contact-tab" data-toggle="pill" href="#thang" role="tab" aria-controls="pills-contact" aria-selected="false">Tháng</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="ngay" role="tabpanel" aria-labelledby="pills-home-tab">
                    <span id="show0"></span>
                </div>
                <div class="tab-pane fade" id="tuan" role="tabpanel" aria-labelledby="pills-profile-tab">
                    <span id="show1"></span>
                </div>
                <div class="tab-pane fade" id="thang" role="tabpanel" aria-labelledby="pills-contact-tab">
                    <span id="show2"></span>
                </div>
            </div>
        </div>
                            
    </div>
</div>
<br>

@endsection