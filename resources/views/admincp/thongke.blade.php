@extends('layouts.app')

@section('content')

@include('layouts.nav')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3>Lượt xem chapter</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-dark" id="myTable">
                        <thead>
                            <tr>
                                <th scope="col">Chapter</th>
                                <th scope="col">Tên chapter</th>
                                <th scope="col">Tên truyện</th>
                                <th scope="col">Lượt xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($views_chapter as $key => $v_chap)
                            <tr>
                                <th>{{$v_chap->chap}}</th>
                                <th>{{$v_chap->tieude}}</th>
                                <th>{{$v_chap->truyen->tentruyen }}</th>
                                <th>{{$v_chap->views_chapter}}</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <div class="card-header">
                    <h3>Lượt xem truyện</h3>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-dark" id="tableView">
                        <thead>
                            <tr>
                                <th scope="col">Tên truyện</th>
                                <th scope="col">Lượt xem</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($views_truyen as $key => $v_truyen)
                            <tr>
                                <th>{{$v_truyen->tentruyen}}</th>
                                <th>{{$v_truyen->views_truyen}}</th>
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