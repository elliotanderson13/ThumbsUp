@extends('template')
@section('content')
<?php
$counter=0;
?>
<style type="text/css">
#menu{
    display: none;
}
.posts > .post{
    width: 100%;
}
.tvback{
    position: fixed;
    left: 15px;
    top: 62px;
    text-decoration: none;
    color: rgb(0, 51, 123);
    opacity: 0.2;
    transition: color 0.2s, opacity 0.2s;
    -webkit-transition: color .02s, opacity 0.2s; /* Safari */
}
.tvback:hover{
    opacity: 1;
    text-decoration: none;
}
</style>
<a href="{{ url('home')}}" class="tvback">&larr;&nbsp;Back</a>
<div class="posts">
                <h1 class="content-subhead">TV Mode</h1>
                <!--<div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                <li class="pure-menu-selected" id="h"><a href="javascript:a('b')">Thank Someone</a></li>
                 <li class="pure-menu-norm" id="g"><a href="javascript:a('c')">Say Something</a></li>  
                 </ul>
                 </div>
                 <div id="f">
                  {{Form::open(array(
                    'url'=>'post',
                    'class'=>'pure-form pure-form-stacked'
                ))}}
                <fieldset>
                    <label for="post">Post</label>
                    <textarea id="post" name="post" placeholder="Post Something" style="width: 100%;resize: none; "></textarea>
                    <input type="submit" class="pure-button pure-button-primary" value="Post" />
                </fieldset>
                {{Form::close()}}
                </div>
                <div id="e">
                    {{Form::open(array(
                    'url'=>'thumb',
                    'class'=>'pure-form pure-form-stacked'
                ))}}
                <fieldset>

                    <label for="name">Give Somebody A Thumbs Up</label>
                    @if(Session::has('error'))
                    <input type="text" id="name" name="name" placeholder="Person's Username" style="border:1px solid red;" class="name" />
                    @else
                    <input type="text" id="name" name="name" placeholder="Person's Username" class="name" />
                    @endif
                    <textarea id="post" name="post" placeholder="Your Comment" style="width: 100%;resize: none; "></textarea>
                    <input type="text" name="tags" placeholder="Tags Separated by Commas" style="width: 100%" />
                    <input type="submit" class="pure-button pure-button-primary" value="Post" />
                </fieldset>
                {{Form::close()}}
                </div>-->
                <!-- A single blog post -->
                <section class="post">

                    @foreach($posts as $post)
                    @if($post->type == 'Post')
                    <header class="post-header">
                        <img class="post-avatar" alt="{{User::find($post->user_id)->first_name}}" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg" style="float: left;margin-right:20px;">
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
                        <img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src="img/{{$comment->user_id}}/image01.jpg" style="float: left;margin-right:20px;">
                        <small><a href='{{url("profile/$username")}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
                        </header>

                        @endforeach
                        <!-- {{Form::open(array(
                        "url"=>"comment/$post->id", "class"=>"pure-form pure-form-inline"
                        ))}}
                        <fieldset>
                        {{form::text('content', null, array('placeholder'=>'Comment'))}}
                        {{Form::submit('Comment', array('class'=>'pure-button pure-button-primary'))}}
                        </fieldset>
                        {{Form::close()}}-->
                        @endif
                        </div>
                    </div>
                    @else 

                    <header class="post-header">
                        <img class="post-avatar" alt="{{User::find($post->user_id)->first_name}}" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg" style="float:left; margin-right: 20px;">

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
                        <?php
                            $comments = Comment::where('post_id', '=', $post->id)->get();
                            $fc = Comment::where('post_id', '=', $post->id)->first();
                        ?>
                        @if(!empty($fc->id))
                        <div class="subsection">
                        @if(empty($like->id))
                        <!--<small><a href='{{url("like/$post->id")}}'>Like</a></small>-->
                        @else
                        <!--<small>You liked this!&nbsp;&nbsp;&nbsp; {{$counter.' like(s)'}}</small>-->
                        @endif
                        
                        
                        @foreach($comments as $comment)
                        <?php $username = User::find($post->user_id)->username;?>
                        <header class="post-header">
                            <div>
                                <!--<img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src="img/{{$comment->user_id}}/image01.jpg" style="float: left;margin-right:10px;vertical-align:middle">
                                --><small><a href='{{url("profile/$comment->user_id")}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
                            </div>
                        </header>

                        @endforeach
                        <!--{{Form::open(array(
                        "url"=>"comment/$post->id", "class"=>"pure-form pure-form-inline"
                        ))}}
                        <fieldset>
                        {{form::text('content', null, array('placeholder'=>'Comment'))}}
                        {{Form::submit('Comment', array('class'=>'pure-button pure-button-primary'))}}
                        </fieldset>
                        {{Form::close()}}-->
                        </div>
                        @endif
                    </div>
                    @endif

                    @endforeach
                 
                </section>
            </div>
@stop