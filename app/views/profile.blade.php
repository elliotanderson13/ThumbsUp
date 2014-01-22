@extends('template')
@section('content')
<?php
$profile_user = User::find($user_id);
?>
<div class="page-header">
    <h1 id="timeline">Profile</h1>
</div>
<ul class="timeline">
    <li class="">
        <div class="timeline-badge"><img class="post-avatar" alt="" height="48" width="48" src="../img/{{$user_id}}/image01.jpg" style="position:relative;left:13px;" /></div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">{{$profile_user->first_name.' '.$profile_user->last_name}}</h4>
                <p><small class="text-muted">{{$profile_user->title}}</small> </p>
            </div>
            <div class="timeline-body" style="">
                <p>
                    {{$profile_user->description}}
                </p>
            </div>
            <div class="timeline-footer primary">
            </div>
        </div>
    </li>
    <?php $counta = 1; ?>
    @foreach($posts as $post)
    @if($post->user_id==$user_id||$post->to_id==$user_id)
    @if($counta%2==0)
    <li>
    @else
    <li class="timeline-inverted">
    @endif
    <?php $counta++; ?>
        <div class="timeline-badge"><img class="post-avatar" alt="{{User::find($post->user_id)->first_name}}" height="48" width="48" src="../img/{{$post->user_id}}/image01.jpg" style="position:relative;left:13px;"/></div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">{{User::find($post->to_id)->first_name.' '.User::find($post->to_id)->last_name}}, Thank You!</h4>
                <p><small class="text-muted"><i class="glyphicon glyphicon-check"></i> From <a href='{{url("profile/".User::find($post->user_id)->username)}}' class="post-author">{{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}</a> 
                with values
                @foreach(Tag::where('thumb_id', '=', $post->id)->get() as $tag)
                <a class="post-category post-category-design" href="{{$tag->tag}}">{{$tag->tag}}</a>
                @endforeach</small></p>
            </div>
            <div class="timeline-body">
                <p>{{$post->content}}</p>
            </div>
            <div class="timeline-footer primary">
                <small class="text-muted"><a href="{{url('like/'.$post->id)}}"><i class="glyphicon glyphicon-thumbs-up"></i></a>&nbsp;{{$post->likes}}</small>
                <?php $comments = Comment::where('post_id', '=', $post->id)->get(); ?>
                {{Form::open(array(
                "url"=>"comment/$post->id", "class"=>"pure-form pure-form-inline pull-right form-inline", "role"=>"form"
                ))}}
                <fieldset>
                    <div class="form-group">{{form::text('content', null, array('placeholder'=>'Comment', 'class'=>'form-control input-sm', 'style'=>'margin-top:-5px'))}}</div>

                    {{Form::submit('Comment', array('class'=>'btn btn-sm btn-primary', 'style'=>'margin-top:-5px'))}}
                </fieldset>
                {{Form::close()}}
                @foreach($comments as $comment)
                <?php $username = User::find($post->user_id)->username;?>
                <div style="height:20px;margin-top:20px;margin-left:-15px;">
                    <img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src="../img/{{$comment->user_id}}/image01.jpg" style="float: left;margin-right:10px;vertical-align:middle">
                    <small><a href='{{url("profile/".User::find($comment->user_id)->username)}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
                </div>
                @endforeach
            </div>
        </div>
    </li>
    @endif
    @endforeach
</ul>
		<!--<div class="posts">
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
                        <!--@else
                        <!--<small>You liked this!&nbsp;&nbsp;&nbsp; {{$counter.' like(s)'}}</small>-->
                        <!--@endif
                        <?php
                            $comments = Comment::where('post_id', '=', $post->id)->get();
                        ?>
                        
                        @foreach($comments as $comment)
                        <?php $username = User::find($post->user_id)->username;?>
                        <header class="post-header">
                            <div>
                                <!--<img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src="img/{{$comment->user_id}}/image01.jpg" style="float: left;margin-right:10px;vertical-align:middle">
                                --><!--<small><a href='{{url("profile/$comment->user_id")}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
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
</div>-->
@stop