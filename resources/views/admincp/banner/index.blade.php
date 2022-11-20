@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($banner);
                @endphp
                <div class="card-header">Danh sách banner: {{$count}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table table-striped table-dark" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Tên banner</th>
                                <th scope="col">Ảnh</th>
                                <th scope="col">Slug banner</th>
                                <th scope="col">Tóm tắt truyện</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($banner as $key => $ban)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $ban->tenbanner }}</td>
                                <td><img src="{{asset('public/uploads/truyen/'.$ban->banner_image)}}" height="200" width="300"></td>
                                <td>{{ $ban->slug_banner }}</td>
                                <td>{{ $ban->banner_tomtat }}</td>
                                <td>
                                    <a href="{{route('banner.edit',[$ban->id])}}" class="btn btn-primary" style="width: 110px; margin-bottom: 10px;">Edit</a>
                                    <form action="{{route('banner.destroy',[$ban->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 110px; margin-bottom: 10px;">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
