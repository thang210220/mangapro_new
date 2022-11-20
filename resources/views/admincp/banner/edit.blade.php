@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Cập nhật banner truyện</div>

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
                    <form method="post" action="{{ route('banner.update',[$banner->id])}}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Tên banner</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{ $banner->tenbanner}}" onkeyup="ChangeToSlug();" name="tenbanner" id="slug" aria-describedby="emailHelp" placeholder="Tên banner ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Slug banner</label>
                            <input style="margin-top:10px" type="text" class="form-control" value="{{ $banner->slug_banner}}" name="slug_banner" id="convert_slug" aria-describedby="emailHelp" placeholder="Slug banner ...">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Ảnh</label><br>
                            <input style="margin-top:10px" type="file" class="form-control-file" name="banner_image">
                            <img src="{{asset('public/uploads/truyen/'.$banner->banner_image)}}" height="250" width="500">
                        </div>
                        <div class="form-group">
                            <label style="margin-top:10px" for="exampleInputEmail1">Tóm tắt truyện</label>
                            <textarea style="margin-top:10px; resize: none;" name="banner_tomtat" class="form-control" rows="5">{{$banner->banner_tomtat}}</textarea>
                        </div>
                        <button style="margin-top:10px" type="submit" name="thembanner" class="btn btn-primary">Cập nhật</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
