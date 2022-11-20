@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                @php
                    $count = count($user);
                @endphp
                <div class="card-header">Danh sách User: {{$count}}</div>
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
                                <th scope="col">Tên User</th>
                                <th scope="col">Email</th>
                                <th scope="col">Password</th>
                                <th scope="col">Vai trò (Role)</th>
                                <th scope="col">Quyền (Permission)</th>
                                <th scope="col">Quản lý</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $key => $u)
                            <tr>
                                <th scope="row">{{ $key }}</th>
                                <th scope="row">{{ $u->name }}</th>
                                <th scope="row">{{ $u->email }}</th>
                                <th scope="row">{{ $u->password }}</th>
                                <th scope="row">
                                    @foreach($u->roles as $key => $role)
                                        {{ $role->name }}
                                    @endforeach
                                </th>
                                <th scope="row">
                                    @foreach($role->permissions as $key => $permission)
                                        <span class="badge text-bg-primary">{{ $permission->name }}</span>
                                    @endforeach
                                </th>
                                <th scope="row">
                                    <a href="{{url('phan-vaitro/'.$u->id)}}" class="btn btn-success" style="width: 110px; margin-bottom: 10px;">Phân vai trò</a>
                                    <a href="{{url('phan-quyen/'.$u->id)}}" class="btn btn-info" style="width: 110px; margin-bottom: 10px;">Phân quyền</a>
                                    <a href="{{route('user.edit',[$u->id])}}" class="btn btn-primary" style="width: 110px; margin-bottom: 10px;">Edit</a>
                                    <form action="{{route('user.destroy',[$u->id])}}" method="post">
                                        @method ('DELETE')
                                        @csrf
                                        <button onclick="return confirm('Bạn có muốn xóa không?');" class="btn btn-danger" style="width: 110px; margin-bottom: 10px;">Xóa</button>
                                    </form>
                                </th>
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
