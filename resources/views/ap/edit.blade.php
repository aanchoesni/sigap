@extends('layouts.master')

@section('content')
{!! Form::model($ap, ['route' => ['ap.update', $ap->id], 'method'=>'patch', 'id' => 'ap', 'class' => 'form-horizontal']) !!}
{!! csrf_field() !!}
<!-- page start-->
<div class="row">
	<div class="col-md-9">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title"><strong>Edit</strong> Access Point</h3>
	        </div>
	        <div class="panel-body">
	            <div class="row">
	                <div class="col-md-12">
						<div class="form-group @if ($errors->has('building_id')) has-error @endif">
	                        <label class="col-md-2 control-label">Gedung</label>
	                        <div class="col-md-10">
	                          {{ Form::select('building_id', $building, old('building_id'), array('class' => 'form-control')) }}
	                          @if ($errors->has('building_id'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('building_id')}}</label>
	                          @endif
	                        </div>
                        </div>
	                    <div class="form-group @if ($errors->has('name')) has-error @endif">
	                        <label class="col-md-2 control-label">Name Access Point</label>
	                        <div class="col-md-10">
	                          {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
	                          @if ($errors->has('name'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('name')}}</label>
	                          @endif
	                        </div>
                        </div>
	                    {{-- <div class="form-group @if ($errors->has('ip')) has-error @endif">
	                        <label class="col-md-2 control-label">IP Address Access Point</label>
	                        <div class="col-md-10">
	                          {{ Form::text('ip', old('ip'), array('class' => 'form-control')) }}
	                          @if ($errors->has('ip'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('ip')}}</label>
	                          @endif
	                        </div>
                        </div> --}}
                        <div class="form-group @if ($errors->has('lat')) has-error @endif">
	                        <label class="col-md-2 control-label">latitude</label>
	                        <div class="col-md-10">
                              {{ Form::text('lat', $ap->coordinate->getLng(), array('class' => 'form-control', 'id'=>'lat', 'readonly')) }}
	                          @if ($errors->has('lat'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('lat')}}</label>
	                          @endif
	                        </div>
                        </div>
	                    <div class="form-group @if ($errors->has('lng')) has-error @endif">
	                        <label class="col-md-2 control-label">longitude</label>
	                        <div class="col-md-10">
                              {{ Form::text('lng', $ap->coordinate->getLat(), array('class' => 'form-control', 'id'=>'lng', 'readonly')) }}
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