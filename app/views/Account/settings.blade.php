@extends('template')
@section('content')
<div class="posts">
	<h1 class="content-subhead">Account Settings</h1>
	<section class="post">
	@if(Session::has('message'))
		<p class="alert">{{Session::get('message')}}</p>
	@endif
		{{Form::open(array(
			'url'=>'pic',
			'enctype'=>'multipart/form-data'
		))}}
		<input type="file" name="pic">
		<input type="submit" value="Upload" />
		{{Form::close()}}
@stop
