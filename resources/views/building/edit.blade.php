@extends('layouts.master')

@section('content')
{!! Form::model($building, ['route' => ['building.update', $building->id], 'method'=>'patch', 'id' => 'building', 'class' => 'form-horizontal']) !!}
{!! csrf_field() !!}
<!-- page start-->
<div class="row">
	<div class="col-md-9">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title"><strong>Edit</strong> Building</h3>
	        </div>
	        <div class="panel-body">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="form-group @if ($errors->has('fakultas')) has-error @endif">
	                        <label class="col-md-2 control-label">Fakultas</label>
	                        <div class="col-md-10">
	                          {{ Form::select('fakultas', ['FIP'=>'FIP', 'FMIPA'=>'FMIPA','FBS'=>'FBS', 'FISH'=>'FISH', 'FT'=>'FT', 'FIO'=>'FIO', 'FE'=>'FE', 'PASCA'=>'PASCA', 'UNIT'=>'UNIT'], old('fakultas'), array('class' => 'form-control')) }}
	                          @if ($errors->has('fakultas'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('fakultas')}}</label>
	                          @endif
	                        </div>
                        </div>
	                    <div class="form-group @if ($errors->has('name')) has-error @endif">
	                        <label class="col-md-2 control-label">Name Building</label>
	                        <div class="col-md-10">
	                          {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
	                          @if ($errors->has('name'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('name')}}</label>
	                          @endif
	                        </div>
                        </div>
	                    <div class="form-group @if ($errors->has('coordinate')) has-error @endif">
	                        <label class="col-md-2 control-label">Building Coordinate</label>
	                        <div class="col-md-10">
	                          {{ Form::text('coordinate', old('coordinate'), array('class' => 'form-control', 'rows'=>'5', 'style'=>'resize:none;')) }}
	                          @if ($errors->has('coordinate'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('coordinate')}}</label>
	                          @endif
	                        </div>
                        </div>
                        <div class="form-group @if ($errors->has('lat')) has-error @endif">
	                        <label class="col-md-2 control-label">latitude</label>
	                        <div class="col-md-10">
                              {{ Form::text('lat', $building->coordinate->getLng(), array('class' => 'form-control', 'id'=>'lat', 'readonly')) }}
	                          @if ($errors->has('lat'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('lat')}}</label>
	                          @endif
	                        </div>
                        </div>
	                    <div class="form-group @if ($errors->has('lng')) has-error @endif">
	                        <label class="col-md-2 control-label">longitude</label>
	                        <div class="col-md-10">
                              {{ Form::text('lng', $building->coordinate->getLat(), array('class' => 'form-control', 'id'=>'lng', 'readonly')) }}
	                          @if ($errors->has('lng'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('lng')}}</label>
	                          @endif
	                        </div>
                        </div>
                        <div style="width: 100%; height: 350px;">
                            <script>
                                function dragend(event) {
                                    document.getElementById('lat').value = event.latLng.lat();
                                    document.getElementById('lng').value = event.latLng.lng();
                                }
                            </script>
                            {!! Mapper::render() !!}
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="col-md-9">
	    <div class="panel panel-default">
	        <div class="panel-footer">
              <a href="{{ url('building') }}" class="btn btn-default pull-right">Batal</a>
	            <button class="btn btn-info pull-right">Simpan</button>
	        </div>
	    </div>
	</div>
</div>
{!! Form::close() !!}
<!-- page end-->
@stop