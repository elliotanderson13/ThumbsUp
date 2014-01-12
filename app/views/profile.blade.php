@extends('template')
@section('content')
		<div class="posts">
			<h1 class="content-subhead">Profile</h1>
			<section class="post">
				<header class="post-header">
					<img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" style="float:left;margin-right:20px" src='{{url("img/$user_id/image01.jpg")}}'>
					<h2 class="post-title">{{User::find($user_id)->first_name.' '.User::find($user_id)->last_name}}</h2>
					<p class="post-meta">
						{{User::find($user_id)->title}}
					</p>
				</header>
				<div class="post-description">
					<p>
					{{User::find($user_id)->description}}
					</p>
				</div>
			</section>
			<h1 class="content-subhead">Posts</h1>
			<section class="post">

                    @foreach($posts as $post)
                    @if($post->user_id==$user_id||$post->to_id==$user_id)
                    @if($post->type == 'Post')
                    <header class="post-header">
                        <img class="post-avatar" alt="{{User::find($post->user_id)->first_name}}" height="48" width="48" src='{{url("img/$post->user_id/image01.jpg")}}' style="float: left;margin-right:20px;">
                        <h2 class="post-title">Post By {{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}
                        </h2>
                    </header>
                    <div class="post-description" style="padding-left: 90px;">
                        <p>
                        {{$post->content}}
                        </p>
                        <div class="subsection">
                        <?php
                            $likes = Like::where('post_id', '=', $post->id)->get();
                            $counter = 0;
                            foreach ($likes as $count)
                            {
                                $counter++;
                            }
                            $like = Like::where('post_id', '=', $post->id)->where('user_id', '=', Sentry::getUser()->id)->first();
                        ?>
                        @if(empty($like->id))
                        <small><a href='{{url("like/$post->id")}}'>Like</a></small>
                        @else
                        <small>You liked this!&nbsp;&nbsp;&nbsp; {{$counter.' like(s)'}}</small>
                        <?php
                            $comments = Comment::where('post_id', '=', $post->id)->get();
                        ?>
                        
                        @foreach($comments as $comment)
                        <?php $username = User::find($post->user_id)->username;?>
                        <header class="post-header">
                        <img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src='{{url("img/$comment->user_id/image01.jpg")}}' style="float: left;margin-right:20px;">
                        <small><a href='{{url("profile/$username")}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
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
                        @endif
                        </div>
                    </div>
                    @else 

                    <header class="post-header">
                        <img class="post-avatar" alt="{{User::find($post->user_id)->first_name}}" height="48" width="48" src='{{url("img/$post->user_id/image01.jpg")}}' style="float:left; margin-right: 20px;">

                        <h2 class="post-title">{{User::find($post->to_id)->first_name.' '.User::find($post->to_id)->last_name}}, Thank You!</h2>

                        <span class="post-meta" style="padding-lefp:200px;">
                            &nbsp;&nbsp;From <a href='{{url("profile/$post->user_id")}}' class="post-author">{{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}</a> 
                            with values
                            @foreach(Tag::where('thumb_id', '=', $post->id)->get() as $tag)
                             <a class="post-category post-category-design" href="tag/{{$tag->tag}}">{{$tag->tag}}</a> 
                             @endforeach
                        </span>
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
                    @endif
                    @endif
                    @endforeach
                 
                </section>

		</div>
	</div>
</div>
@stop