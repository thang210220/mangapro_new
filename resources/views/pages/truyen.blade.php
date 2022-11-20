@extends('../layout')

@section('content')

<br>
<div class="row bg_center">
    <div class="col-9 bg_left">
        <style>
            .bg_center {background: white;}
            .bg_left {border-right: 15px solid #F8F8FF;}
            .bread-crumb {border-top:5px solid #32CD32;}
            .breadcrumb {background: white; width: 841px;}
            .breadcrumb a{text-decoration: none; color: #FF9900;}
            .breadcrumb a:hover {color: #007bff}
            .cen_title {text-align: center; margin-top: -10px;}
            .detail img{padding: 5px 20px; width: 100%};
            .infotruyen{list-style: none;}
            .infotruyen a{text-decoration: none;}
            .infotruyen a:hover{color: purple;}
            .noidung b{margin-left: 15px;}
            .noidung p{margin-left: 15px; font-size: 22px;}
            .list_chap b{margin-left: 15px;}
            .mucluctruyen {width: 500px;}
            .mucluctruyen li{list-style: none; padding: 5px 15px; margin-left: -50px;}
            .mucluctruyen li:hover{background: #FFCC66;}
            .mucluctruyen a{text-decoration: none;}
            .mucluctruyen a:hover{color: green;}
            .timeupdate li{list-style: none; padding: 5px 15px; color: #007bff;}
            .scrollbar {width: 820px; height: 400px; overflow-y: scroll; margin-left: 10px;}
            .nothing h3{margin-top: 10px; margin-left: 40px;}
            .cdm b{margin-left: 15px;}
            .cdm_2{text-align: center;}
            .cdm_2 img{width: 170px; height: 250px; margin-left: -15px;}
            .cdm_2 img:hover {border: 10px solid rgba(0,0,0,0.0);}
            .cdm_2 a{text-decoration: none;}
            .cdm_2 a:hover {color: green;}
        </style>
        <div class="row bread-crumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{url('xem-truyen/'.$truyen->slug_truyen)}}">{{$truyen->tentruyen}}</a></li>
                </ol>
            </nav>
        </div>
        <div class="col-12 cen_title">
            <h2><b>{{$truyen->tentruyen}}</b></h2>
        </div><br>
        <div class="row detail">
            <div class="col-md-4">
                <img class="card-img-top" src="{{asset('public/uploads/truyen/'.$truyen->hinhanh)}}">
            </div>
            <div class="col-md-8">
                @php
                    $mucluc = count($chapter);
                @endphp
                <ul class="infotruyen">
                    <!--Lấy biến wishlist -->
                    <input type="hidden" value="{{$truyen->tentruyen}}" class="wishlist_title">
                    <input type="hidden" value="{{\URL::current()}}" class="wishlist_url">
                    <input type="hidden" value="{{$truyen->id}}" class="wishlist_id">
                    <!--Lấy biến wishlist -->
                    @role('user')
                    <div class="fb-like" data-href="{{\URL::current()}}" data-width="" data-layout="standard" data-action="like" data-size="small" data-share="true"></div>
                    @endrole
                    <h5><i class="fa fa-plus"></i> Tên truyện: {{$truyen->tentruyen}}</h5><br>
                    <h5><i class="fa fa-user"></i> Tác giả: {{$truyen->tacgia}}</h5><br>
                    <h5>
                        <i class="fa fa-rss"></i> Trạng thái: 
                        @if($truyen->trangthai==0)
                            <span class="text text-primary">Hoàn thành</span>
                        @else
                            <span class="text text-primary">Đang tiến hành</span>
                        @endif
                    </h5><br>
                    <h5><i class="fa fa-tags"></i> Thể loại: 
                        @foreach($truyen->thuocnhieutheloaitruyen as $the)
                            <a href="{{url('the-loai/'.$the->slug_theloai)}}">  
                                <button type="button" class="btn btn-outline-success"><b>{{$the->tentheloai}}</b></button>
                            </a>
                        @endforeach
                    </h5><br>
                    <h5><i class="fas fa-flag"></i> Số chapter: {{$mucluc}}</h5><br>
                    <h5><i class="fas fa-eye"> Lượt xem: {{$truyen->views_truyen}} lượt xem</i></h5>
                    @if ($chapter_dau)
                    <a href="{{url('xem-chapter/'.$chapter_dau->slug_chapter)}}" class="btn btn-primary"><i class="fas fa-book-open"></i>  Đọc ngay</a>
                    <a href="{{url('xem-chapter/'.$chapter_moinhat->slug_chapter)}}" class="btn btn-primary"><i class="fas fa-book-open"></i>  Chương mới nhất</a>
                    @role('user')
                    <button class="btn btn-danger btn-thich_truyen"><i class="fa fa-heart"></i>  Thích truyện</button>
                    @endrole
                    @else
                        <a class="btn btn-danger">Đang cập nhật</a>
                    @endif
                </ul>
            </div>
        </div><br>
        <div class="row noidung">
            <b><i class="far fa-file-alt"></i>  NỘI DUNG</b>
            <p>{{$truyen->tomtat}}</p>
        </div>
        <div class="row list_chap">
            <b><i class="fas fa-list"></i>  DANH SÁCH CHAP</b>
            @if($mucluc>0)
            <div class="row scrollbar">
                <table class="table table-striped">
                    <tr>
                        <th>
                            <ul class="mucluctruyen">
                                @foreach($chapter as $key => $chap)
                                <a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">
                                    <li>
                                        {{$chap->chap}} : {{$chap->tieude}}
                                    </li>
                                </a>
                                @endforeach
                            </ul>
                        </th>
                        <th>
                            <ul class="timeupdate">
                                @foreach($chapter as $key => $chap)
                                <li>
                                    {{$chap->updated_at}}
                                </li>
                                @endforeach
                            </ul>
                        </th>
                    </tr>
                </table>
            </div>
            @else
            <div class="col-12 nothing">
                <h3>Hiện tại chưa cập nhật!</h3>
            </div>
            @endif
        </div>
        <br>
        <div class="row">
            <div style="background: white; margin-left: 15px;" class="fb-comments" data-href="{{\URL::current()}}" data-width="810" data-numposts="10"></div>
        </div><br>
        <div class="row cdm">
            <b><i class="fas fa-bookmark"></i>  TRUYỆN CÙNG DANH MỤC</b>
        </div>
        <div class="row cdm_2">
            @foreach ($cungdanhmuc as $key => $value)
            <div class="col-3">
                <div class="card-body">
                    <a href="{{url('xem-truyen/'.$value->slug_truyen)}}">
                        <img src="{{asset('public/uploads/truyen/'.$value->hinhanh)}}">
                        <br><br><h5><b>{{$value->tentruyen}}</b></h5> 
                    </a>
                    <small class="text-muted"><h6>{{$value->views_truyen}} Lượt xem</h6></small>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    <div class="col-3 bg_right">
        <style>
            .noibat {border-top:5px solid #32CD32; border-bottom: 15px solid #F8F8FF;}
            .noibat img {width: 60px; height: 90px; padding: 5px 5px;}
            .noibat img:hover {border: 5px solid rgba(0,0,0,0.0);}
            .noibat a {text-decoration: none; font-weight: bold;}
            .noibat a:hover {color: green;}

            .xemnhieu {border-top:5px solid #32CD32; border-bottom: 15px solid #F8F8FF;}
            .xemnhieu img {width: 60px; height: 90px; padding: 5px 5px;}
            .xemnhieu img:hover {border: 5px solid rgba(0,0,0,0.0);}
            .xemnhieu a {text-decoration: none; font-weight: bold;}
            .xemnhieu a:hover {color: green;}

            .yeuthich {border-top:5px solid #32CD32;}
            .yeuthich img {width: 60px; height: 90px; padding: 5px 5px;}
            .yeuthich img:hover {border: 5px solid rgba(0,0,0,0.0);}
            .yeuthich a {text-decoration: none; font-weight: bold;}
            .yeuthich a:hover {color: green;}
        </style>
        <div class="row noibat">
            <h3>Truyện nổi bật</h3>
            <div class="col-12">
                <table>
                    @foreach($truyennoibat as $key =>$noibat)
                    <tr>
                        <th>
                            <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}">
                                <img src="{{asset('public/uploads/truyen/'.$noibat->hinhanh)}}" alt="{{$noibat->tentruyen}}">
                            </a>
                        </th>
                        <th class="text-color">
                            <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}">
                                <h5>{{$noibat->tentruyen}}</h5>
                            </a>
                            <small class="text-muted"><h6>{{$noibat->views_truyen}} Lượt xem</h6></small>
                        </th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row xemnhieu">
            <h3>Truyện xem nhiều</h3>
            <div class="col-12">
                <table>
                    @foreach($truyenxemnhieu as $key =>$xemnhieu)
                    <tr>
                        <th>
                            <a href="{{url('xem-truyen/'.$xemnhieu->slug_truyen)}}">
                                <img src="{{asset('public/uploads/truyen/'.$xemnhieu->hinhanh)}}" alt="{{$xemnhieu->tentruyen}}">
                            </a>
                        </th>
                        <th class="text-color">
                            <a href="{{url('xem-truyen/'.$xemnhieu->slug_truyen)}}">
                                <h5>{{$xemnhieu->tentruyen}}</h5>
                            </a>
                            <small class="text-muted"><h6>{{$xemnhieu->views_truyen}} Lượt xem</h6></small>
                        </th>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="row yeuthich">
            <h3>Truyện yêu thích</h3>
            @role('user')
            <div class="col-12" id="yeuthich">
                <table></table>
            </div>
            @endrole
        </div>
    </div>
</div>
<br>

@endsection