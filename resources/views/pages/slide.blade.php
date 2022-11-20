<br>
<div class="row slide">
    <style>
        .slide {background: white; border-top:5px solid #32CD32}
        .slide h3 {margin-top: 5px;}
        .item-slide a img {width: 120px; height: 180px;}
        .item-slide img:hover {border: 10px solid rgba(0,0,0,0.0);}
        .carousel-control-next {background: url(right-arrow.png) left top no-repeat;background-image: url(right-arrow.png);}
        .carousel-control-prev {background: url(left-arrow.png) left top no-repeat;background-image: url(left-arrow.png);}
    </style>
    <h3>TRUYỆN NỔI BẬT</h3>
    <div class="owl-carousel owl-theme">
        @foreach($truyennoibat as $key =>$noibat)
            <div class="item-slide">
                <a href="{{url('xem-truyen/'.$noibat->slug_truyen)}}">
                    <img src="{{asset('public/uploads/truyen/'.$noibat->hinhanh)}}">
                </a>
            </div>
        @endforeach
    </div>
    <span class="carousel-control-prev" style="top: 260px; left: 160px;"></span>
    <span class="carousel-control-next" style="top: 260px; left: 1277px;"></span>
</div>
<br>
