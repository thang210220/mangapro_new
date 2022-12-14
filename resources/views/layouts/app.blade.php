<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{csrf_token()}}">

    <title>Mangapro</title>
    <link rel="shortcut icon" href="{{asset('public/uploads/truyen/icon.png')}}"/>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-dark shadow-sm">
            <div class="container">
                <a class="logo" href=" {{ route('home') }}"><img src="{{asset('public/uploads/truyen/logo.png')}}" style="margin-left: 30px; width:180px;"></a>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a style="color: #fff" class="nav-link" href=" {{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a style="color: #fff" class="nav-link" href=" {{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a style="color: #fff" id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            load_gallery();

            function load_gallery(){
                var chap_id = $('.chap_id').val();
                var _token = $('input[name="_token"]').val();
                // alert(chap_id);
                $.ajax({
                    url:"{{url('/select-gallery')}}",
                    method:"POST",
                    data:{chap_id:chap_id, _token:_token},
                    success:function(data){
                        $('#gallery_load').html(data);
                    }
                });
            }
            $('#file').change(function(){
                var error = '';
                var files = $('#file')[0].files;
                if (files.length > 100){
                    error+='<p>B???n ch??? ???????c ch???n t???i ??a 3 ???nh</p>';
                }else if (files.length==''){
                    error+='<p>B???n kh??ng ???????c b??? tr???ng ???nh</p>';
                }else if (files.size > 2000000){
                    error+='<p>???nh c???a b???n qu?? l???n</p>';
                }
                if (error==''){

                }else {
                    $('#file').val('');
                    $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                    return false;
                }
            });
            $(document).on('click','.delete-gallery',function(){
                var gal_id = $(this).data('gal_id');
                var _token = $('input[name="_token"]').val();
                if(confirm('B???n mu???n x??a h??nh ???nh n??y kh??ng?')){
                    $.ajax({
                        url:"{{url('/delete-gallery')}}",
                        method:"POST",
                        data:{gal_id:gal_id, _token:_token},
                        success:function(data){
                            load_gallery();
                            $('#error_gallery').html('<h3 class="text-danger">X??a h??nh ???nh th??nh c??ng</h3>');
                        }
                    });
                }
            });
            $(document).on('change','.file_image',function(){
                var gal_id = $(this).data('gal_id');
                var image = document.getElementById('file-'+gal_id).files[0];
                var form_data = new FormData();
                form_data.append("file", document.getElementById('file-'+gal_id).files[0]);
                form_data.append("gal_id",gal_id);
                    $.ajax({
                        url:"{{url('/update-gallery')}}",
                        method:"POST",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:form_data,
                        contentType:false,
                        cache:false,
                        processData:false,
                        success:function(data){
                            load_gallery();
                            $('#error_gallery').html('<h3 class="text-danger">C???p nh???t h??nh ???nh th??nh c??ng</h3>');
                        }
                    });
            });
        });
    </script>

    <script type="text/javascript">
        $('#keywords2').keyup( function(){
            var keywords2 = $(this).val();
            if(keywords2 != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('timkiem-ajax2')}}",
                    method:"POST",
                    data:{keywords2:keywords2, _token:_token},
                    success:function(data){
                        $('#search_ajax').fadeIn();
                            $('#search_ajax').html(data);
                    }
                });
            }else{
                $('#search_ajax').fadeOut();
            }
        });
        $(document).on('click', '.li_timkiem_ajax2', function(){
            $('#keywords2').val( $(this).text() );
            $('#search_ajax').fadeOut();
        });
    </script>

    <script type="text/javascript">
        $('#keywords3').keyup( function(){
            var keywords3 = $(this).val();
            if(keywords3 != '')
            {
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{url('timkiem-ajax3')}}",
                    method:"POST",
                    data:{keywords3:keywords3, _token:_token},
                    success:function(data){
                        $('#search_ajax3').fadeIn();
                            $('#search_ajax3').html(data);
                    }
                });
            }else{
                $('#search_ajax3').fadeOut();
            }
        });
        $(document).on('click', '.li_timkiem_ajax3', function(){
            $('#keywords3').val( $(this).text() );
            $('#search_ajax3').fadeOut();
        });
    </script>

    <script src="{{ asset('public/ckeditor/ckeditor.js') }}"></script>

    <script type="text/javascript">
        CKEDITOR.replace('ckeditor', {
            filebrowserImageUploadUrl : "{{ url('uploads-ckeditor?_token='.csrf_token()) }}",
            filebrowserUploadMethod :'form'

        });
    </script>
            
    <script type="text/javascript">
        function ChangeToSlug()
        {
            var slug;
            //L???y text t??? th??? input title 
            slug = document.getElementById("slug").value;
            slug = slug.toLowerCase();
            //?????i k?? t??? c?? d???u th??nh kh??ng d???u
                slug = slug.replace(/??|??|???|???|??|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'a');
                slug = slug.replace(/??|??|???|???|???|??|???|???|???|???|???/gi, 'e');
                slug = slug.replace(/i|??|??|???|??|???/gi, 'i');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???|??|???|???|???|???|???/gi, 'o');
                slug = slug.replace(/??|??|???|??|???|??|???|???|???|???|???/gi, 'u');
                slug = slug.replace(/??|???|???|???|???/gi, 'y');
                slug = slug.replace(/??/gi, 'd');
                //X??a c??c k?? t??? ?????t bi???t
                slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                //?????i kho???ng tr???ng th??nh k?? t??? g???ch ngang
                slug = slug.replace(/ /gi, "-");
                //?????i nhi???u k?? t??? g???ch ngang li??n ti???p th??nh 1 k?? t??? g???ch ngang
                //Ph??ng tr?????ng h???p ng?????i nh???p v??o qu?? nhi???u k?? t??? tr???ng
                slug = slug.replace(/\-\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-\-/gi, '-');
                slug = slug.replace(/\-\-\-/gi, '-');
                slug = slug.replace(/\-\-/gi, '-');
                //X??a c??c k?? t??? g???ch ngang ??? ?????u v?? cu???i
                slug = '@' + slug + '@';
                slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                //In slug ra textbox c?? id ???slug???
            document.getElementById('convert_slug').value = slug;
        }
    </script>

    <script type="text/javascript">
        $('.truyennoibat').change(function(){
            const truyennoibat = $(this).val();
            
            const truyen_id = $(this).data('truyen_id');
            var _token = $('input[name="_token"]').val();
            
            if(truyennoibat==0){
                var thongbao = 'Thay ?????i truy???n m???i th??nh c??ng';
            }else if(truyennoibat==1){
                var thongbao = 'Thay ?????i truy???n n???i b???t th??nh c??ng';
            }else{
                var thongbao = 'Thay ?????i truy???n xem nhi???u th??nh c??ng';
            }
            $.ajax({
                url:"{{url('/truyennoibat')}}",
                method:"POST",
                data:{truyennoibat:truyennoibat, truyen_id:truyen_id, _token:_token},
                success:function(data)
                    {
                        // $('#thongbao').html('<span class="text text-alert">'+thongbao+'</span>');
                        alert(thongbao);
                    }
            });
        })
    </script>

    <script type="text/javascript">
        $('.topview').change(function(){
            const topview = $(this).val();
            
            const truyen_id = $(this).data('truyen_id');
            var _token = $('input[name="_token"]').val();
            
            if(topview==0){
                var thongbao = 'Thay ?????i topview ng??y th??nh c??ng';
            }else if(topview==1){
                var thongbao = 'Thay ?????i topview tu???n th??nh c??ng';
            }else{
                var thongbao = 'Thay ?????i topview th??ng th??nh c??ng';
            }
            $.ajax({
                url:"{{url('/topview')}}",
                method:"POST",
                data:{topview:topview, truyen_id:truyen_id, _token:_token},
                success:function(data)
                    {
                        // $('#thongbao').html('<span class="text text-alert">'+thongbao+'</span>');
                        alert(thongbao);
                    }
            });
        })
    </script>

    <script type="text/javascript" src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#myTable').DataTable();
        } );
    </script>
    <script type="text/javascript">
        $(document).ready( function () {
            $('#tableView').DataTable();
        } );
    </script>
</body>
</html>
