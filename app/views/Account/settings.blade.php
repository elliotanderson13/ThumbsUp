@extends('template')
@section('content')
<?php
$user = Sentry::getUser();
$user_id = $user->id;
?>
<div class="posts">
	<h1 class="content-subhead">Account Settings</h1>
	<section class="post">
	@if(Session::has('message'))
		<p class="alert">{{Session::get('message')}}</p>
	@endif
	{{Form::open(array(
		'url'=>'edit',
		'class'=>'pure-form'
	))}}
		<header class="post-header">
			<img class="post-avatar" height="48" width="48" style="float: left; margin-right: 20px;" src="img/{{$user_id}}/image01.jpg">
			<h2 class="post-title">{{User::find($user_id)->first_name.' '.User::find($user_id)->last_name}}</h2>
			<p class="post-meta">
				<input type="text" name="title" placeholder="Title" value="{{User::find($user_id)->title}}" />
			</p>
		</header>
		<div class="post-description">
			<p>
				<textarea name="description" placeholder="Description" style="width: 100%; resize: none;">{{User::find($user_id)->description}}</textarea>
			</p>
		</div>
		{{Form::submit('Update', array('class'=>'pure-button pure-button-primary'))}}
		{{Form::close()}}
		<br/ >
		{{Form::open(array(
			'url'=>'pic',
			'enctype'=>'multipart/form-data'
		))}}
		<header class="post-header">
		<h2 class="post-title">Upload/Change Profile Picture</h2>
		</header>
		<input type="file" name="pic"><br />
		<input type="submit" value="Upload" class="pure-button pure-button-primary" />
		{{Form::close()}}
@stop
