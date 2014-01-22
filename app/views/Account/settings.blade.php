@extends('template')
@section('content')
<?php
$user = Sentry::getUser();
$user_id = $user->id;
?>
<div class="page-header">
    <h1 id="timeline">Profile</h1>
</div>
@if(Session::has('message'))
<p class="alert">{{Session::get('message')}}</p>
@endif
{{Form::open(array(
	'url'=>'edit',
	'class'=>'pure-form',
	'enctype'=>'multipart/form-data'
))}}
<fieldset>
	<div class="well wello">
		<div class="form-group">
			<label for="first_name">First Name: </label>
		    <input type="text" name="first_name" id="email" class="form-control" placeholder="{{$user->first_name}}">
		</div>
		<div class="form-group">
			<label for="last_name">Last Name: </label>
		    <input type="text" name="last_name" id="password" class="form-control" placeholder="{{$user->last_name}}">
		</div>
		<div class="form-group">
			<label for="title">Title: </label>
		    <input type="text" name="title" id="password" class="form-control" placeholder="{{$user->title}}">
		</div>
		<div class="form-group">
			<label for="description">Description: </label>
		    <textarea type="text" name="description" id="password" class="form-control" placeholder="{{$user->description}}"></textarea>
		</div>
		<div class="form-group">
			<label for="pic">Picture: </label><br>
			<input type="file" title="Choose" name="pic">
		</div>
		<div class="form-group">
			<label>Background:</label>
			<input type="button" color="#003e74" class="btn btn-primary color">
			<input type="button" color="#225f96" class="btn btn-info color">
			<input type="button" color="#843549" class="btn btn-danger color">
			<input type="button" color="#e57200" class="btn btn-warning color">
			<input type="button" color="#6c953c" class="btn btn-success color">
			<input type="hidden" class="color-hidden" name="color" value="{{$user->color}}">
		</div>
		<div class="row">	
			<div class="col-xs-6 col-sm-6 col-md-6">
		        <input type="submit" class="btn btn-success btn-block" value="Update">
			</div>
			<div class="col-xs-6 col-sm-6 col-md-6">
				<a href="{{url('settings')}}" class="btn btn-primary btn-block">Reload</a>
			</div>
		</div>
	</div>
</fieldset>
{{Form::close()}}
<script type="text/javascript">
$('.color').click(function(){
	$('.color-hidden').val($(this).attr('color'));
})
</script>
@stop
