@extends('layouts.master')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">Dashboard</div>

    <div class="panel-body">
        You are logged in Administrator!
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">Peta informasi sebaran access point Universitas Negeri Surabaya</div>

    <div class="panel-body">
        <div style="width: 100%; height: 350px;">
            @include('maps')
        </div>
    </div>
</div>
@endsection
