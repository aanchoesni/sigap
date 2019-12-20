@extends('layouts.master')

@section('content')
{!! Form::open(array('url' => route('user.store'), 'method' => 'POST', 'id' => 'user', 'class' => 'form-horizontal')) !!}
{!! csrf_field() !!}
<!-- page start-->
<div class="row">
	<div class="col-md-9">
	    <div class="panel panel-default">
	        <div class="panel-heading">
	            <h3 class="panel-title"><strong>Add</strong> User</h3>
	        </div>
	        <div class="panel-body">
	            <div class="row">
	                <div class="col-md-12">
	                    <div class="form-group @if ($errors->has('name')) has-error @endif">
	                        <label class="col-md-2 control-label">Name</label>
	                        <div class="col-md-10">
	                          {{ Form::text('name', old('name'), array('class' => 'form-control')) }}
	                          @if ($errors->has('name'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('name')}}</label>
	                          @endif
	                        </div>
	                    </div>
	                    <div class="form-group @if ($errors->has('email')) has-error @endif">
	                        <label class="col-md-2 control-label">Email</label>
	                        <div class="col-md-10">
	                          {{ Form::email('email', old('email'), array('class' => 'form-control')) }}
	                          @if ($errors->has('email'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('email')}}</label>
	                          @endif
	                        </div>
	                    </div>
	                    <div class="form-group @if ($errors->has('password')) has-error @endif">
	                        <label class="col-md-2 control-label">Password</label>
	                        <div class="col-md-10">
                            {{ Form::password('password', array('class' => 'form-control')) }}
	                          {{-- {{ Form::password('password', old('password'), array('class' => 'form-control')) }} --}}
	                          @if ($errors->has('password'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('password')}}</label>
	                          @endif
	                        </div>
	                    </div>
	                    <div class="form-group @if ($errors->has('password_confirmation')) has-error @endif">
	                        <label class="col-md-2 control-label">Ulangi Password</label>
	                        <div class="col-md-10">
                            {{ Form::password('password_confirmation', array('class' => 'form-control')) }}
	                          {{-- {{ Form::password('password_confirmation', old('password_confirmation'), array('class' => 'form-control')) }} --}}
	                          @if ($errors->has('password_confirmation'))
	                          <label id="login-error" class="error" for="login">{{$errors->first('password_confirmation')}}</label>
	                          @endif
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>
	<div class="col-md-9">
	    <div class="panel panel-default">
	        <div class="panel-footer">
              <a href="{{ url('user') }}" class="btn btn-default pull-right">Batal</a>
	            <button class="btn btn-info pull-right">Simpan</button>
	        </div>
	    </div>
	</div>
</div>
{!! Form::close() !!}
<!-- page end-->
@stop
