@extends('layouts.front')

@section('content')
<div class="panel panel-default">
    <div class="panel-heading">
        <div style="text-align: center; font-size: 32px; font-weight: bold;">Peta Informasi Sebaran Access Point Universitas Negeri Surabaya</div>
        @if (Route::has('login'))
            <div class="top-right pull-right">
                @auth
                    <a href="{{ url('/home') }}" class="btn btn-sm btn-default">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-sm btn-default">Login</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn btn-sm btn-default">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="panel-body">
        <div style="width: 100%; height: 450px;">
            @include('maps')
        </div>
    </div>
</div>
@endsection