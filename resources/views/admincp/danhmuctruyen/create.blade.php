@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm danh mục truyện</div>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="card-body">
                    <form method="post" action="{{ route('danhmuc.store')}}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên danh mục</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('tendanhmuc')}}" onkeyup="ChangeToSlug();" name="tendanhmuc" id="slug" aria-describedby="emailHelp" placeholder="Tên danh mục ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug danh mục</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('slug_danhmuc')}}" name="slug_danhmuc" id="convert_slug" aria-describedby="emailHelp" placeholder="Tên danh mục ...">
                        </div>
                        
                        <button style="margin-top:10px" type="submit" name="themdanhmuc" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
