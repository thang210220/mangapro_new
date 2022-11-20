@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><center><h5>Thêm Ảnh</h5></center></div>
                
                <div class="card-body" style="background: #242526">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <input type="hidden" value="{{$chap_id}}" name="chap_id" class="chap_id">
                    <form action="{{url('/insert-gallery/'.$chap_id)}}" method="post" enctype="multipart/form-data" style="background: #363636">
                        @csrf
                        <div class="row">
                            <div class="col-md-3" align="right"></div>
                            <div class="col-md-6">
                                <input type="file" class="form-control" id="file" name="file[]" accept="image/*" multiple>
                                <span id="error_gallery"></span>
                            </div>
                            <div class="col-md-3" align="left">
                                <input type="submit" name="upload" name="taianh" value="Tải ảnh" class="btn btn-success">
                            </div>
                        </div>
                    </form><br>
                    <form style="background: #363636; padding: 5px 8px;">
                        @csrf
                        <div id="gallery_load">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
