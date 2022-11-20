@extends('../layout')

@section('content')

<br>
<div class="row bread-crumb">
    <style>
        .bread-crumb {border-top:5px solid #32CD32; background: white;}
        .breadcrumb {background: white;}
        .breadcrumb a{text-decoration: none; color: #FF9900;}
        .breadcrumb a:hover {color: #007bff}
        .name a{text-decoration: none;}
        .name a:hover{color: green;}
        .noidung {background: white; border-top:5px solid #32CD32;}
        .noidung img {width: 905px;}
        .isDisabled{color: currentColor; pointer-events: none; opacity: 0.5; text-decoration: none;}
    </style>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{url('/')}}">Trang chủ</a></li>
            <li class="breadcrumb-item"><a href="{{url('xem-truyen/'.$truyen_breadcrumb->slug_truyen)}}">{{$truyen_breadcrumb->tentruyen}}</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a href="{{url('xem-chapter/'.$chapter->slug_chapter)}}">{{$chapter->chap}} - {{$chapter->tieude}}</a></li>
        </ol>
        <h4 class="name" style="margin-left: 10px"><a href="{{url('xem-truyen/'.$truyen_breadcrumb->slug_truyen)}}">{{$truyen_breadcrumb->tentruyen}}</a> - {{$chapter->chap}}<small class="text-muted">  (Cập nhật lúc: {{$chapter->updated_at}})</small></h4>
    </nav>
</div>

<br>
<div class="row noidung">
    <center>
        @foreach($gallery as $key => $gal)
            <img src="{{asset('public/uploads/gallery/'.$gal->gallery_image)}}">
        @endforeach
    </center>
<br>
</div><br>
<center>
    <div style="background: white;" class="fb-comments" data-href="{{\URL::current()}}" data-width="950" data-numposts="10"></div><br><br>
</center>
<style>
    *{margin: 0;box-sizing: border-box;}
    .chapter-select{padding-left: 355px;position: fixed;bottom: -1px;}
    .select-box{display: flex; width: 400px;flex-direction: column;}
    .select-box .options-container{background: #fff;color: #fff;max-height: 0;width: 100%;opacity: 0;
    transition: all 0.4s;border-radius: 8px;overflow: hidden;margin-left: 20px}
    .selected{background: #fff;border-radius: 8px;margin-top: 8px;margin-bottom: 8px;position: relative;order: 0;}
    .selected::after {content: "";position: absolute;transition: all 0.4s;}
    .select-box .options-container.active + .selected::after {transform: rotateX(180deg);top: -6px;}
    .select-box .options-container.active{max-height: 240px;opacity: 1;overflow-y:scroll;}
    .select-box .options-container::-webkit-scrollbar {background: #F5F5F5;border-radius: 0px 8px 8px 0px;}
    .select-box .options-container::-webkit-scrollbar-thumb {background: #B5B5B5;border-radius: 0px 8px 8px 0px;}
    .select-box .option,
    .selected{padding: 1px 12px;cursor: pointer;text-align: center;}
    .select-box .option:hover{background: #00B2EE;color:}
    .select-box .option .radio{display: none;}
    .button-prev a {margin-left: 415px;}
    .button-next a {margin-left: -24px;}
    .option a{text-decoration: none; color: #000;}
    .option a:hover{color: #fff;}
    .chapter-control{background-color: #242526;margin-left: -525px;width: 1490px}
</style>
    <div class="container chapter-select">
        <div class="select-box">
            <div class="options-container">
                @foreach($all_chapter as $key => $chap)
                <div class="option">
                    <input type="radio" class="radio" id="{{$chap->chap}}" name="category">
                    <label for="{{$chap->chap}}">
                        <a href="{{url('xem-chapter/'.$chap->slug_chapter)}}">
                            {{$chap->chap}} : {{$chap->tieude}}
                        </a>
                    </label>
                </div>
                @endforeach
            </div>
            <div class="row chapter-control">
                <div class="col-4 button-prev">
                    <a href="{{url('xem-chapter/'.$previous_chapter)}}" class="btn btn-link {{$chapter->id==$min_id->id ? 'isDisabled' : ''}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="35" fill="currentColor" class="bi-pre bi-arrow-left-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </a>
                </div>
                <div class="col-4 selected">
                    {{$chapter->chap}} : {{$chapter->tieude}}
                </div>
                <div class="col-4 button-next">
                    <a href="{{url('xem-chapter/'.$next_chapter)}}" class="btn btn-link {{$chapter->id==$max_id->id ? 'isDisabled' : ''}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="35" fill="currentColor" class="bi-nex bi-arrow-right-circle-fill" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 1 0 16A8 8 0 0 1 8 0zM4.5 7.5a.5.5 0 0 0 0 1h5.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H4.5z"/>
                        </svg>
                    </a>
                </div>
            </div> 
        </div>
    </div>
<style>
    .cart_icon {position: fixed; right: 30px; top: 85%;}
    .cart_icon img {width: 70px;}
</style>
<span class="cart_icon">
    <a href="#"><img src="{{asset('public/uploads/truyen/arrow.png')}}"></a>
</span>

@endsection
