@extends('layouts.front')

@section('asset')
<link rel="stylesheet" href="{!! asset('backend/js/sw/dist/sweetalert.css') !!}">
@endsection

@section('content')
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Details Building</h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="col-sm-4" style="overflow-x: auto">
                    <div class="form-group">
                        <span>Location</span>
                        <span> : </span>
                        <span>{{ $building->location }}</span>
                    </div>
                    <div class="form-group">
                        <span>Name</span>
                        <span> : </span>
                        <span>{{ $building->name }}</span>
                    </div>
                    <div class="form-group">
                        <span>Fakultas</span>
                        <span> : </span>
                        <span>{{ $building->fakultas }}</span>
                    </div>
                </div>
                <div class="col-sm-8" style="overflow-x: auto">
                    <table class="table table-hover data-table" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Name</th>
                                <th width="15%">Status</th>
                                <th width="15%">Coordinate</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($building->rAp as $value)
                            <tr>
                                <td>{!! $no++ !!}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->status }}</td>
                                <td>
                                    @if ($value->coordinate)
                                    {{ $value->coordinate->getLng() }}, {{ $value->coordinate->getLat() }}
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->
    </div>
</div>
<!-- page end-->
@endsection

@section('script')
<script type="text/javascript" src="{!!asset('backend/js/sw/dist/sweetalert.min.js') !!}"></script>
@endsection
