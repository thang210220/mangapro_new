<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Mangapro</title>
        <link rel="shortcut icon" href="{{asset('public/uploads/truyen/icon.png')}}"/>
        
        <!-- style -->
        <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
        <link rel="stylesheet" style="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('public/css/bootstrap.css') }}">
        <script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <style type="text/css">
            body {background: #F8F8F8;}
            .switch_color{background: #363636;}
            .switch_color_light{background: #181818 !important; color: #fff}
            .text-hover:hover{color: blue;}
        </style>
    </head>
    <body>
        <div class="container">
            <!-- header -->
            <div class="row top">
                <nav class="navbar navbar-expand navbar-light">
                    <div class="navbar-collapse">
                        <style>
                            .top {background: white;}
                            .logo-top a img {width: 100%; margin-left: -30px;}
                            .search {margin-left: 10px;}
                            .scroll-search {margin-left: 20px; width: 608px; height: 400px; overflow-y: scroll;}
                            ul.dropdown-menu li{padding: 5px 15px;}
                            ul.dropdown-menu li a{color: black; text-decoration: none}
                            ul.dropdown-menu li a:hover { color: green;}
                            .sl select{width: 120px;}
                            .sl button{width: 120px; height: 37px;}
                            .log a button{width: 125px;}
                            .dangky {margin-left: 35px;}
                            .dangnhap {margin-left: 35px;}
                            ul.navbar-nav {margin-left: 35px;}
                            #navbar-Dropdown {color: blue; background: #FFCC66;}
                        </style>
                        <div class="col-2 logo-top">
                            <a href="{{url('/')}}">
                                <img src="{{asset('public/uploads/truyen/logo.png')}}">
                            </a>
                        </div>
                        <div class="col-7 search">
                            <form autocomplete="off" class="search" action="{{url('tim-kiem')}}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <input type="search" id="keywords" name="tukhoa" class="form-control" placeholder="Tìm kiếm tác giả, truyện...">
                                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                                </div>
                                <div id="search_ajax"></div>
                            </form>
                        </div>
                        <div class="col-1 sl">
                            <select class="custom-select mr-sm-2" id="switch_color">
                                <option value="light">Light</option>
                                <option value="dark">Dark</option>
                            </select>
                            <button class="btn btn-success" onclick="myFunction()">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                                </svg>
                                Chú ý
                            </button>
                        </div>
                        @role('user')
                        <div class="col-2 log">
                            <ul class="navbar-nav ms-auto">
                                <li class="nav-item dropdown">
                                    <a id="navbar-Dropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        @else
                        <div class="col-2 log">
                            <a href="{{url('dang-ky')}}" class="dangky">
                                <button class="btn btn-info" type="submit">
                                    <i class="fas fa-user-plus"> Đăng ký</i>
                                </button>
                            </a>
                            <a href="{{url('dang-nhap')}}" class="dangnhap">
                                <button class="btn btn-danger" type="submit">
                                    <i class="fas fa-sign-in-alt"> Đăng nhập</i>
                                </button>
                            </a>
                        </div>
                        @endrole
                    </div>
                </nav>
            </div>
            <!-- menu -->
            <div class="row bottom">
                <style>
                    .bottom {background: #FF9900;}
                    .navbar-collapse {margin-left: 10px;}
                    .navbar-collapse ul li:hover {background: #FFCC66;}
                </style>
                <nav class="navbar navbar-expand navbar-light">
                    <div class="navbar-collapse">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link active" aria-current="page" href="{{url('/')}}"><b>Trang chủ</b></a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b>Danh mục truyện</b>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    @foreach($danhmuc as $key => $danh)
                                    <a class="dropdown-item" href="{{url('danh-muc/'.$danh->slug_danhmuc)}}">{{$danh->tendanhmuc}}</a>
                                    @endforeach
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <b>Thể loại</b>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <div class="row" style="width: 800px">
                                        @foreach($theloai as $key => $the)
                                        <div class="col-2" style="margin: 0px 5px">
                                            <a class="dropdown-item" href="{{url('the-loai/'.$the->slug_theloai)}}">{{$the->tentheloai}}</a>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('xep-hang/')}}" aria-current="page">
                                    <b>Xếp hạng</b>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{url('trang-thai/')}}" aria-current="page">
                                    <b>Trạng thái</b>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- slide -->
            @yield('slide')
            <!-- home -->
            @yield('content')
            <!-- footer -->
            <footer>
                <style>
                    .footer {background: white; border-top:5px solid #32CD32;}
                    .left {float: left; width: 50%;}
                    .right {float: left; width: 50%;}
                    .right p {margin-top:30px;}
                    .logo a img {width: 180px; margin-top: 20px; margin-left: 15px;}
                    .detail-left {margin-bottom: 10px; margin-left: 15px; margin-top: 5px;}
                    .detail-right {margin-bottom: 10px;}
                </style>
                <div class="row footer">
                    <div class="left">
                        <div class="logo">
                            <a href="{{url('/')}}">
                                <img src="{{asset('public/uploads/truyen/logo.png')}}">
                            </a> 
                        </div>
                        <div class="detail-left">
                            Luôn cập nhật liên tục các bộ truyện mới nhanh nhất để phục vụ độc giả. Đọc truyện hoàn toàn miễn phí.
                            <br>
                            Email: akatoz2k@gmail.com
                        </div>
                    </div>
                    <div class="right">
                        <p>Chúc bạn đọc truyện vui vẻ!</p>
                        <div class="detail-right">
                            Mọi thông tin và hình ảnh trên website đều được sưu tầm trên Internet.
                            Chúng tôi không sở hữu hay chịu trách nhiệm bất kỳ thông tin nào trên web này.
                            Nếu làm ảnh hưởng đến cá nhân hay tổ chức nào, khi được yêu cầu, chúng tôi sẽ xem xét và gỡ bỏ ngay lập tức.
                        </div>
                    </div>
                </div>
            </footer>
        </div>
        <script>
            function myFunction() {
            alert("Sau khi đăng ký tài khoản của bạn sẽ chưa thể đăng nhập! Hãy quay lại sau vài phút!");
            }
        </script>
        <script src="{{ asset('js/app.js') }}" defer></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
        <!-- scrollbar của chapter -->
        <script type="text/javascript">
            const selected = document.querySelector(".selected");
            const optionsContainer = document.querySelector(".options-container");
            const optionsList = document.querySelectorAll(".option");
            selected.addEventListener("click", () => {
                optionsContainer.classList.toggle("active");
            });
            
        </script>
        <!-- Ngày tháng năm -->
        <script type="text/javascript">
            $(document).ready(function() {
                showngay();
            })
            function showngay(){
                var value = 0;
                $.ajax({
                    url:"{{url('/filter-topview-truyen')}}",
                    method:"GET",
                    data:{value:value},
                    success:function(data)
                        {
                            $('#show'+value).html(data);
                        }
                });
            }
            $('.filter-sidebar').click(function(){
                var href = $(this).attr('href');
                if(href=='#ngay'){
                    var value = 0;
                }else if(href=='#tuan'){
                    var value = 1;
                }else{
                    var value = 2;
                }
                $.ajax({
                    url:"{{url('/filter-topview-truyen')}}",
                    method:"GET",
                    data:{value:value},
                    success:function(data)
                        {
                            $('#show'+value).html(data);
                        }
                });
            })
        </script>
        <!-- Yêu thích button -->
        <script type="text/javascript">
            show_wishlist();
            function show_wishlist() {
                if(localStorage.getItem('wishlist_truyen')!=null) {
                    var data = JSON.parse(localStorage.getItem('wishlist_truyen'));
                    data.reverse();
                    for(i=0;i<data.length;i++) {
                        var title = data[i].title;
                        var img = data[i].img;
                        var id = data[i].id;
                        var url = data[i].url;
                        $('#yeuthich').append(`<tr>
                            <th>
                                <a href="`+url+`">
                                    <img src="`+img+`" alt="`+title+`">
                                </a>
                            </th>
                            <th class="text-color">
                                <a href="`+url+`">
                                    <h5>`+title+`</h5>
                                </a>
                            </th>
                        </tr>`);
                    }
                }
            }

            $('.btn-thich_truyen').click(function(){
                const id = $('.wishlist_id').val();
                const title = $('.wishlist_title').val();
                const img = $('.card-img-top').attr('src');
                const url = $('.wishlist_url').val();

                const item = {
                    'id': id,
                    'title': title,
                    'img': img,
                    'url': url
                }
                if(localStorage.getItem('wishlist_truyen')==null){
                    localStorage.setItem('wishlist_truyen', '[]');
                }
                var old_data = JSON.parse(localStorage.getItem('wishlist_truyen'));

                var matches = $.grep(old_data, function(obj){
                    return obj.id == id;
                })
                if(matches.length){
                    alert('Truyện đã có trong danh sách yêu thích!');
                }else{
                    if(old_data.length<=5){
                        old_data.push(item);
                    }else{
                        alert('Đã đạt tới giới hạn lưu truyện yêu thích!');
                    }
                    $('#yeuthich').append(`<tr>
                        <th>
                            <a href="`+url+`">
                                <img src="`+img+`" alt="`+title+`">
                            </a>
                        </th>
                        <th class="text-color">
                            <a href="`+url+`">
                                <h5>`+title+`</h5>
                            </a>
                        </th>
                    </tr>`);
                    localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
                    alert('Đã lưu vào danh sách truyện yêu thích!');
                }
                localStorage.setItem('wishlist_truyen', JSON.stringify(old_data));
            });
        </script>
        <!-- Màu theme -->
        <script type="text/javascript">
            $(document).ready(function() {
                if(localStorage.getItem('switch_color')!==null) {
                    const data = localStorage.getItem('switch_color');
                    const data_obj = JSON.parse(data);
                    $(document.body).addClass(data_obj.class_1);
                    $('.top').addClass(data_obj.class_2);
                    $('.slide').addClass(data_obj.class_2);
                    $('.bg_left').addClass(data_obj.class_2);
                    $('.bg_right').addClass(data_obj.class_2);
                    $('.footer').addClass(data_obj.class_2);
                    $('.noidung').addClass(data_obj.class_2);
                    $('.all').addClass(data_obj.class_2);
                    $('.danhmuc').addClass(data_obj.class_2);
                    $('.theloai').addClass(data_obj.class_2);
                    $('.timkiem').addClass(data_obj.class_2);
                    $('.updating').addClass(data_obj.class_2);
                    $('.breadcrumb').addClass(data_obj.class_2);
                    $('.bread-crumb').addClass(data_obj.class_2);
                    $('.xephang').addClass(data_obj.class_2);
                    $('.trangthai').addClass(data_obj.class_2);

                    $('.bg_left').css('border-right','15px solid #363636');
                    $('.fanpage').css('border-bottom','15px solid #363636');
                    $('.newupdated').css('border-bottom','15px solid #363636');
                    $('.noibat').css('border-bottom','15px solid #363636');
                    $('.xemnhieu').css('border-bottom','15px solid #363636');
                    $('.timeupdate > li').css('color','#007bff');

                    $("select option[value='dark']").attr("selected", "selected");
                }

                $("#switch_color").change(function() {
                    $(document.body).toggleClass("switch_color");
                    $('.top').toggleClass("switch_color_light");
                    $('.slide').toggleClass("switch_color_light");
                    $('.bg_left').toggleClass("switch_color_light");
                    $('.bg_right').toggleClass("switch_color_light");
                    $('.footer').toggleClass("switch_color_light");
                    $('.noidung').toggleClass("switch_color_light");
                    $('.all').toggleClass("switch_color_light");
                    $('.danhmuc').toggleClass("switch_color_light");
                    $('.theloai').toggleClass("switch_color_light");
                    $('.timkiem').toggleClass("switch_color_light");
                    $('.updating').toggleClass("switch_color_light");
                    $('.breadcrumb').toggleClass("switch_color_light");
                    $('.bread-crumb').toggleClass("switch_color_light");
                    $('.xephang').toggleClass("switch_color_light");
                    $('.trangthai').toggleClass("switch_color_light");

                    $('.bg_left').css('border-right','15px solid #363636');
                    $('.fanpage').css('border-bottom','15px solid #363636');
                    $('.newupdated').css('border-bottom','15px solid #363636');
                    $('.noibat').css('border-bottom','15px solid #363636');
                    $('.xemnhieu').css('border-bottom','15px solid #363636');
                    $('.timeupdate > li').css('color','#007bff');

                    if($(this).val() == 'dark'){
                        var item = {
                            'class_1':'switch_color',
                            'class_2':'switch_color_light'
                        }
                        localStorage.setItem('switch_color',JSON.stringify(item));
                    }else if($(this).val() == 'light'){
                        localStorage.removeItem('switch_color');
                        $('.bg_left').css('border-right','15px solid #F8F8FF');
                        $('.fanpage').css('border-bottom','15px solid #F8F8FF');
                        $('.newupdated').css('border-bottom','15px solid #F8F8FF');
                        $('.noibat').css('border-bottom','15px solid #F8F8FF');
                        $('.xemnhieu').css('border-bottom','15px solid #F8F8FF');
                        $('.timeupdate > li').css('color','#007bff');
                    }
                });
            });
        </script>
        <!-- Tìm kiếm -->
        <script type="text/javascript">
            $('#keywords').keyup( function(){
                var keywords = $(this).val();
                if(keywords != '')
                {
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{url('timkiem-ajax')}}",
                        method:"POST",
                        data:{keywords:keywords, _token:_token},
                        success:function(data){
                            $('#search_ajax').fadeIn();
                                $('#search_ajax').html(data);
                        }
                    });
                }else{
                    $('#search_ajax').fadeOut();
                }
            });
            $(document).on('click', '.li_timkiem_ajax', function(){
                $('#keywords').val( $(this).text() );
                $('#search_ajax').fadeOut();
            });
        </script>
        <!-- Carousel -->
        <script type="text/javascript">
            $('.owl-carousel').owlCarousel({
                loop:true,
                margin:10,
                dot:true,
                // nav:true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:8
                    }
                }
            })
        </script>
        <script type="text/javascript">
            $('.select-chapter').on('change',function(){
                var url = $(this).val();
                if(url){
                    window.location = url;
                }
                return false;
            });

            current_chapter();

            function current_chapter(){
                var url = window.location.href;
                $('.select-chapter').find('option[value="'+url+'"]').attr("selected",true);
            }
        </script>
        
        <div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v13.0" nonce="cqIhseRn"></script>
    </body>
</html>
