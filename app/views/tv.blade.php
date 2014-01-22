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
.navbar-nav > li{
    display: none;
}
</style>

<a href="{{ url('home')}}" class="tvback">&larr;&nbsp;Back</a>
<div class="page-header">
    <h1 id="timeline">TV Mode</h1>
</div>
<ul class="timeline">
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
                <small class="text-muted"><a href="{{url('like/'.$post->id)}}"><i class="glyphicon glyphicon-thumbs-up"></i></a>&nbsp;{{$post->likes}}</small>
                <?php $comments = Comment::where('post_id', '=', $post->id)->get(); ?>
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
<div id="chaunz"></div>
<script type="text/javascript">
var scrollY = 0;
var distance = 1;
var speed = 35;
function autoScrollTo(el) {
    var currentY = window.pageYOffset;
    var targetY = document.getElementById(el).offsetTop;
    var bodyHeight = document.body.offsetHeight;
    var yPos = currentY + window.innerHeight;
    var animator = setTimeout('autoScrollTo(\''+el+'\')',speed);
    if(yPos > bodyHeight){
        clearTimeout(animator);
    } else {
        if(currentY < targetY-distance){
            scrollY = currentY+distance;
            window.scroll(0, scrollY);
        } else {
            clearTimeout(animator);
            resetScroller(el);
        }
    }
}
function resetScroller(el){
    var currentY = window.pageYOffset;
    var targetY = document.getElementById(el).offsetTop;
    var animator = setTimeout('resetScroller(\''+el+'\')',speed);
    if(currentY > targetY){
        scrollY = currentY-distance;
        window.scroll(0, scrollY);
    } else {
        clearTimeout(animator);
        autoScrollTo(el);
    }
}
autoScrollTo("chaunz");
</script>
@stop