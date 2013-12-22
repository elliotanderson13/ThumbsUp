@extends('template')
@section('content')
<div class="posts">
	<h1 class="content-subhead">Desktop Mode</h1>
	<h1>{{$tag_name}}</h1>
		@foreach($tags as $tag)
			<?php
				$thumb_id = $tag->thumb_id;
				$post = Post::where('id','=', $thumb_id)->first();
			?>
			<header class="post-header">
                        <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src='{{url("img/$post->user_id/image01.jpg")}}' style="float:left; margin-right: 20px;">

                        <h2 class="post-title">Thumbs Up to {{User::find($post->to_id)->first_name.' '.User::find($post->to_id)->last_name}}</h2>

                        <p class="post-meta">
                            From <a href="#" class="post-author">{{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}</a> 
                            with values
                        </p>
                    </header>

                    <div class="post-description" style="padding-left: 90px;">
                        <p>
                            {{$post->content}}
                        </p>
                    </div>
		@endforeach
@stop