@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Thêm banner truyện</div>

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
                    <form method="post" action="{{ route('banner.store')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên banner</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('tenbanner')}}" onkeyup="ChangeToSlug();" name="tenbanner" id="slug" aria-describedby="emailHelp" placeholder="Tên banner ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug danh mục</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{old('slug_banner')}}" name="slug_banner" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug banner ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Ảnh</label><br>
                            <input style="margin-top:10px" type="file" class="form-control-file" name="banner_image">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Tóm tắt truyện</label>
                            <textarea style="margin-top:10px; resize: none;" name="banner_tomtat" class="form-control" rows="5"></textarea>
                        </div>
                        <button style="margin-top:10px" type="submit" name="thembanner" class="btn btn-primary">Thêm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
