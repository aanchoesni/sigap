@extends('layouts.master')

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
                <h3 class="panel-title">Access Point</h3>
                <a class="btn btn-info" href="{{ url('ap/create') }}" style="margin: 0cm 0px 0cm 10px;"><i class="fa fa-plus"></i> Add</a>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="col-sm-12" style="overflow-x: auto">
                    <table class="table table-hover data-table" width="100%">
                        <thead>
                            <tr>
                                <th width="5%">No</th>
                                <th width="15%">Name</th>
                                <th width="15%">Building</th>
                                <th width="15%">Fakultas</th>
                                <th width="30%">Coordinate</th>
                                <th align="center" width="15%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $no = 1;
                            @endphp
                            @foreach ($ap as $value)
                            <tr>
                                <td>{!! $no++ !!}</td>
                                <td>{{ $value->name }}</td>
                                <td>{{ $value->rBuilding->name }}</td>
                                <td>{{ $value->rBuilding->fakultas }}</td>
                                <td>
                                    {{ $value->coordinate->getLng() }}, {{ $value->coordinate->getLat() }}
                                </td>
                                <td>
                                    <a href="{{ route('ap.edit', ['data'=>Crypt::encrypt($value->id)]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>

                                    <button class="btn btn-danger btn-xs" id="btn_delete" data-file="{{$value->id}}"><i class="fa fa-trash-o"></i></button>
                                    {{ Form::open(['url'=>route('ap.destroy', ['data'=>Crypt::encrypt($value->id)]), 'method'=>'delete', 'id' => $value->id, 'style' => 'display: none;']) }}
                                    {{ csrf_field() }}
                                    {{ Form::close() }}
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
{{-- @include('sweet::alert') --}}
<script>

    $('button#btn_delete').on('click', function(e){
        e.preventDefault();
        var data = $(this).attr('data-file');

        swal({
            title             : "Apakah Anda Yakin?",
            text              : "Anda akan menghapus data ini!",
            type              : "warning",
            showCancelButton  : true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText : "Yes",
            cancelButtonText  : "No",
            closeOnConfirm    : false,
            closeOnCancel     : false
        },
        function(isConfirm){
            if(isConfirm){
                swal("Terhapus","Data berhasil dihapus", "success");
                setTimeout(function() {
                $("#"+data).submit();
                }, 1000); // 1 second delay
            }
            else{
                swal("Dibatalkan","Data batal dihapus", "error");
            }
        });
    });
</script>
@endsection
