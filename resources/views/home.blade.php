@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Quản lý</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @hasanyrole('master|admin')
                        <div class="row">
                            <center>
                                <h1>
                                Welcome back
                                @role('master')
                                    master!
                                @else
                                    !
                                @endrole
                                </h1>
                            </center>
                        </div>
                        <!-- <div class="row">
                            <img style="width: 100%; height: 430px" src="{{asset('public/uploads/truyen/welcome.gif')}}">
                        </div> -->
                    @else
                        Bạn không đủ quyền hạn!
                    @endhasanyrole
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
