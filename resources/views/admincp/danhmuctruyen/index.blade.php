@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($danhmuctruyen);
                @endphp
                <div class="card-header">Danh sách danh mục: {{$count}}</div>
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
                                <th scope="col">Tên danh mục</th>
                                <th scope="col">Slug danh mục</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($danhmuctruyen as $key => $danhmuc)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <td>{{ $danhmuc->tendanhmuc }}</td>
                                <td>{{ $danhmuc->slug_danhmuc }}</td>
                                <td>
                                    <a href="{{route('danhmuc.edit',[$danhmuc->id])}}" class="btn btn-primary" style="width: 110px; margin-bottom: 10px;">Edit</a>
                                    <form action="{{route('danhmuc.destroy',[$danhmuc->id])}}" method="post">
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
