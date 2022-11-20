<div class="container" >
    <nav class="navbar navbar-expand-lg navbar-light" style="background: #FF9900">
        <style>
            .navbar-collapse {margin-left: 10px;}
            .navbar-collapse ul li:hover {background: #FFCC66;}
        </style>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="margin-left: 150px">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home')}}"><b>Admin</b></a>
                </li>
                @role('master')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý User</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('user.create')}}">
                            Thêm user
                        </a>
                        <a class="dropdown-item" href="{{ route('user.index')}}">
                            Danh sách user
                        </a>
                    </div>
                </li>
                @endrole
                @hasanyrole('master|admin')
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý Danh mục</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('danhmuc.create')}}">
                            Thêm danh mục
                        </a>
                        <a class="dropdown-item" href="{{ route('danhmuc.index')}}">
                            Danh sách danh mục
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý Thể loại</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('theloai.create')}}">
                            Thêm thể loại
                        </a>
                        <a class="dropdown-item" href="{{ route('theloai.index')}}">
                            Danh sách thể loại
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý Banner</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('banner.create')}}">
                            Thêm Banner
                        </a>
                        <a class="dropdown-item" href="{{ route('banner.index')}}">
                            Danh sách Banner
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý Truyện</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('truyen.create')}}">
                            Thêm truyện
                        </a>
                        <a class="dropdown-item" href="{{ route('truyen.index')}}">
                            Danh sách truyện
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý Chapter</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('chapter.create')}}">
                            Thêm Chapter
                        </a>
                        <a class="dropdown-item" href="{{ route('chapter.index')}}">
                            Danh sách Chapter
                        </a>
                    </div>
                </li>
                <li class="nav-item dropdown">
                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        <b>Quản lý Lượt xem</b>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('thongke.index')}}">
                            Thống kê lượt xem
                        </a>
                    </div>
                </li>
                @endhasanyrole
            </ul>
            <!-- <form autocomplete="off" action="{{url('tim-kiem2')}}" class="form-inline my-2 my-lg-0" style="margin-left: 180px" method="GET">
                @csrf
                <table>
                    <tr>
                        <td>
                            <input class="form-control mr-sm-2" type="search" id="keywords2" name="tukhoa2" placeholder="Tìm kiếm" aria-label="Search" style="background: white">
                            
                        </td>
                        <td>
                            <button class="btn btn-success my-2 my-sm-0" type="submit">Tìm kiếm</button>
                        </td>
                    </tr>
                    <tr>
                        <style>
                            .scroll-search2 {width: 405px; height: 400px; overflow-y: scroll;}
                            .dropdown-menu{margin-top: 40px;}
                            ul.dropdown-menu li{padding: 5px 15px;}
                            ul.dropdown-menu li a{color: black; text-decoration: none}
                            ul.dropdown-menu li a:hover { color: blue;}
                        </style>
                        <div id="search_ajax"></div>
                    </tr>
                </table>
            </form> -->
        </div>
    </nav>
</div>
