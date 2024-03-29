@extends('layouts.master')

@section('content')
<!-- page start-->
<div class="row">
    <div class="col-lg-12">
        <!-- START DEFAULT DATATABLE -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Master User</h3>
                <a class="btn btn-info" href="{{ url('user/create') }}" style="margin: 0cm 0px 0cm 10px;">Add User</a>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                </ul>
            </div>
            <div class="panel-body">
                <table class="table table-hover" id="berita">
                    <thead>
                        <tr>
                            <th width="7%">No</th>
                            <th width="20%">Nama</th>
                            <th width="30%">Email</th>
                            <th align="center" width="15%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1;?>
                    @foreach($user as $value)
                        <tr style="cursor:pointer">
                            <td align="center"><?php echo $no; ?></td>
                            <td>{!! $value->name !!}</td>
                            <td>{!! $value->email !!}</td>
                            <td style="text-align:center;">
                                <a href="{{ route('user.edit', ['data'=>Crypt::encrypt($value->id)]) }}" class="btn btn-warning btn-xs"><i class="fa fa-pencil"></i></a>

                                <button class="btn btn-danger btn-xs" id="btn_delete" data-file="{{$value->id}}"><i class="fa fa-trash-o"></i></button>
                                {{ Form::open(['url'=>route('user.destroy', ['data'=>Crypt::encrypt($value->id)]), 'method'=>'delete', 'id' => $value->id, 'style' => 'display: none;']) }}
                                {{ csrf_field() }}
                                {{ Form::close() }}
                              </td>
                           <?php $no++;?>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- END DEFAULT DATATABLE -->
    </div>
</div>
<!-- page end-->
@stop

@section('script')
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
    }
  );});
</script>
@stop
