@extends('template')
@section('content')
<?php $counter=0; ?>
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
                            @foreach(Tag::where('thumb_id', '=', $post->id)->get() as $tag)
                             <a class="post-category post-category-design" href="{{$tag->tag}}">{{$tag->tag}}</a> 
                             @endforeach
                        </p>
                    </header>

                    <div class="post-description" style="padding-left: 90px;">
                        <p>
                            {{$post->content}}
                        </p>
                        <?php
                            $like = Like::where('post_id', '=', $post->id)->where('user_id', '=', Sentry::getUser()->id)->first();
                        ?>
                        <div class="subsection">
                        @if(empty($like->id))
                        <!--<small><a href='{{url("like/$post->id")}}'>Like</a></small>-->
                        @else
                        <!--<small>You liked this!&nbsp;&nbsp;&nbsp; {{$counter.' like(s)'}}</small>-->
                        @endif
                        <?php
                            $comments = Comment::where('post_id', '=', $post->id)->get();
                        ?>
                        
                        @foreach($comments as $comment)
                        <?php $username = User::find($post->user_id)->username;?>
                        <header class="post-header">
                            <div>
                                <!--<img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src="img/{{$comment->user_id}}/image01.jpg" style="float: left;margin-right:10px;vertical-align:middle">
                                --><small><a href='{{url("profile/$comment->user_id")}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
                            </div>
                        </header>

                        @endforeach
                                            {{Form::open(array(
                        "url"=>"comment/$post->id", "class"=>"pure-form pure-form-inline"
                        ))}}
                        <fieldset>
                        {{form::text('content', null, array('placeholder'=>'Comment'))}}
                        {{Form::submit('Comment', array('class'=>'pure-button pure-button-primary'))}}
                        </fieldset>
                        {{Form::close()}}
                        </div>
                    </div>
		@endforeach
@stop