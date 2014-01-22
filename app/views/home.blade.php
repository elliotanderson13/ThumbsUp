@extends('template')
@section('content')

<div class="page-header">
    <h1 id="timeline">Wall</h1>
</div>
<ul class="timeline">
    <li>
        <div class="timeline-badge"><img class="post-avatar" alt="" height="48" width="48" src="img/{{Sentry::getUser()->id}}/image01.jpg" style="position:relative;left:13px;"/></div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">Thank Someone!</h4>
                <p><small class="text-muted">What do you want to say?</small> </p>
            </div>
            <div class="timeline-body" style="padding-left:20px;padding-right:20px;padding-bottom:20px;">
                {{Form::open(array(
                'url'=>'thumb',
                'class'=>'',
                'role'=>'form'
                ))}}
                <fieldset>
                    <div class="form-group">
                        @if(Session::has('error'))
                        <input type="text" id="name-search" onBlur="javascript:unfocus()" name="name" placeholder="Name" autocomplete="off" style="border:1px solid red;" class="form-control" />
                        @else
                        <input type="text" id="name-search" onBlur="javascript:unfocus()" name="name" placeholder="Name" autocomplete="off" class="form-control" />
                        @endif
                        <div class="suggestions">
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea id="post" name="post" placeholder="Comment" class="form-control" style="width: 100%;resize: none; "></textarea>
                    </div>
                    <div class="form-group">
                        <input type="text" name="tags" placeholder="Tags Separated by Commas" style="width: 100%" class="form-control"/>
                    </div>
                    <hr class="colorgraph">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                        <input type="submit" class="btn btn-success btn-block" value="Post" />
                        </div>
                    </div>
                </fieldset>
                {{Form::close()}}
            </div>
            <div class="timeline-footer primary">
            </div>
        </div>
    </li>
    <?php $counta=1; ?>
    @foreach($posts as $post)
    @if($counta%2==0)
    <li>
    @else
    <li class="timeline-inverted">
    @endif
    <?php $counta++; ?>
        <div class="timeline-badge"><img class="post-avatar" alt="{{User::find($post->user_id)->first_name}}" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg" style="position:relative;left:13px;"/></div>
        <div class="timeline-panel">
            <div class="timeline-heading">
                <h4 class="timeline-title">{{User::find($post->to_id)->first_name.' '.User::find($post->to_id)->last_name}}, Thank You!</h4>
                <p><small class="text-muted"><i class="glyphicon glyphicon-check"></i> From <a href='{{url("profile/".User::find($post->user_id)->username)}}' class="post-author">{{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}</a> 
                with values
                @foreach(Tag::where('thumb_id', '=', $post->id)->get() as $tag)
                <a class="post-category post-category-design" href="tag/{{$tag->tag}}">{{$tag->tag}}</a>
                @endforeach</small></p>
            </div>
            <div class="timeline-body">
                <p>{{$post->content}}</p>
            </div>
            <div class="timeline-footer primary">
                <a><i class="glyphicon glyphicon-thumbs-up"></i></a>
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
                    <img class="post-avatar" alt="{{User::find($comment->user_id)->first_name}}" height="24" width="24" src="img/{{$comment->user_id}}/image01.jpg" style="float: left;margin-right:10px;vertical-align:middle">
                    <small><a href='{{url("profile/".User::find($comment->user_id)->username)}}'>{{User::find($comment->user_id)->first_name.' '.User::find($comment->user_id)->last_name}}</a> {{$comment->content}}</small>
                </div>
                @endforeach
            </div>
        </div>
    </li>
    @endforeach
</ul>

@stop