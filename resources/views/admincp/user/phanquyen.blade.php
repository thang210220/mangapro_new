@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Cấp quyền cho vai trò của user : {{$user->name}}</div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form action="{{url('/insert_permission',[$user->id])}}" method="post">
                        @csrf
                        <div class="form-group">
                            @if(isset($name_roles))
                            <h3><b>Vai trò hiện tại: {{$name_roles}}</b></h3>
                            @endif
                        </div>
                        <div style="margin-top:10px" class="form-group">
                            @foreach($permission as $key => $per)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="permission[]" value="{{$per->id}}" id="{{$per->id}}"
                                    @foreach($get_permission_via_role as $key => $get)
                                        @if($get->id == $per->id)
                                            checked
                                        @endif
                                    @endforeach
                                >
                                <label class="form-check-label" for="{{$per->id}}">
                                    {{$per->name}}
                                </label>
                            </div>
                            @endforeach
                        </div>
                        <div class="form-group">
                            <input style="margin-top:10px" type="submit" name="insertroles" value="Cấp quyền cho user" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Thêm quyền</div>
                <div class="card-body">
                    <form action="{{url('insert-permission')}}" method="post">
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" value="{{old('permission')}}" name="permission" aria-describedby="emailHelp" placeholder="Tên quyền ...">
                        </div>
                        <div class="form-group">
                            <input style="margin-top:10px" type="submit" name="insertpers" value="Thêm quyền" class="btn btn-danger">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
