@extends('template')
@section('content')

<style type="text/css">
      .pure-menu-selected {
        border: 1px solid rgb(221, 221, 221);
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom: 1px solid white;
        
      }
      .pure-menu-selected:hover {
        background-color: white;
      }
      .pure-menu-norm {
        border: 1px solid white;
        border-top-left-radius: 5px;
        border-top-right-radius: 5px;
        border-bottom: 1px solid rgb(221, 221, 221);
      }
      .pure-menu ul li:hover{
        border-radius: 5px;
      }
      #f {
        display: none;
      }
      .quan a{
        opacity: 0.6;
      }
      .sallgood{
        opacity: 1;
      }
      .quan a:hover{
        opacity: 1;
        text-decoration: none;
      }
      .ui-state-focus{
        border:none;
         background-color: #000;
      }
      .ui-state-hover,
.ui-widget-content .ui-state-hover,
.ui-widget-header .ui-state-hover,
.ui-state-focus,
.ui-widget-content .ui-state-focus,
.ui-widget-header .ui-state-focus {
    background: #ddd;
    font-weight: normal;
    cursor: pointer;
    border: 1px solid #ddd;
    border-radius: 0px;
}
.ui-state-hover .ui-icon,
.ui-state-focus .ui-icon {
    background-image: none;
}
.content-subhead a{
    color: #aaa;
}
#dm{
    text-decoration: underline;
}
#tm{
    text-decoration: none;
}
</style>
<script type="text/javascript">

function a(b){
    var d = ["f", "e", "h", "g"];
    if (b=="c") {
        d = ["e", "f", "g", "h"];
    }
    document.getElementById(d[0]).style.display="none";
    document.getElementById(d[1]).style.display="block";
    document.getElementById(d[2]).className = "pure-menu-selected";
    document.getElementById(d[3]).className = "pure-menu-norm";
    document.getElementById()
}
function t(w){
    if (w=="t") {
        document.getElementById("menu").style.display = "none";
        document.getElementById("chaunz").style.display = "none";
        //document.getElementById("sp").style.zoom = "200%";
        document.getElementById("tm").style.textDecoration = "underline";
        document.getElementById("dm").style.textDecoration = "none";
    }
    else {
        document.getElementById("menu").style.display = "block";
        document.getElementById("chaunz").style.display = "block";
        //document.getElementById("sp").style.zoom = "100%";
        document.getElementById("dm").style.textDecoration = "underline";
        document.getElementById("tm").style.textDecoration = "none";
    }
}

</script>

            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <h1 class="content-subhead"><a href="javascript:t('d')" id="dm">Desktop Mode</a> <a id="tm" href="javascript:t('t')">TV Mode</a></h1>
                <div id="chaunz">
                <div class="pure-menu pure-menu-open pure-menu-horizontal">
                <ul>
                <li class="pure-menu-selected" id="h"><a href="javascript:a('b')">Thank Someone</a></li>
                 <li class="pure-menu-norm" id="g"><a href="javascript:a('c')">Say Something</a></li>  
                 </ul>
                 </div>
                 <div id="e">
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

                <div id="f">
                    {{Form::open(array(
                    'url'=>'thumb',
                    'class'=>'pure-form pure-form-stacked'
                ))}}
                <fieldset>
                    <script type="text/javascript">
                    $(document).ready(function(){
                    
                    $( "#nameO" ).autocomplete({
                    source: [
                        <?php 
                            $users = DB::table('users')->get();
                            $quan = 0;
                            foreach ($users as $user)
                            {
                                if ($quan != 0) {
                                    echo ",\n";
                                }
                                else {
                                    $quan = 1;
                                }
                                echo "{value: '".$user->first_name." ".$user->last_name."', image: 'img/".$user->id."/image01.jpg'}";
                            }
                        ?>
                    ]
                    }).data("ui-autocomplete")._renderItem = function(ul, item){
                        var inner_html = '<a style=""><div style=""><img style="float:left;margin-left:5px" class="post-avatar" src="'+item.image+'" width="30" height="30"><span style="font-size:10pt;line-height:30px;vertical-align:middle;float-left;padding-left:5px;">'+item.value+'</span></div></a>';
                        return $( "<li></li>" ).data( "item.autocomplete", item ).append(inner_html).appendTo( ul );
                    }
                    });
                    </script>
                    <label for="name">Give Somebody A Thumbs Up</label>
                    @if(Session::has('error'))
                    <input name="name" placeholder="Person's Username" style="border:1px solid red;" />
                    @else
                    <input type="text" id="nameO" name="name" placeholder="Person's Username" />
                    @endif
                    <textarea id="post" name="post" placeholder="Your Comment" style="width: 100%;resize: none; "></textarea>
                    <input type="text" name="tags" placeholder="Tags Separated by Commas" style="width: 100%" />
                    <input type="submit" class="pure-button pure-button-primary" value="Post" />
                </fieldset>
                {{Form::close()}}
                </div>
            </div>
                <!-- A single blog post -->
                <section class="post" id="sp">

                    @foreach($posts as $post)
                    @if($post->type == 'Post')
                    <header class="post-header">
                        <img class="post-avatar" alt="tilo Mitra&#x27;s avatar" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg" style="float: left;margin-right:20px;">
                        <h2 class="post-title">Post By {{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}
                        </h2>
                    </header>
                    <div class="post-description">
                        <p> 
                        {{$post->content}}
                        </p>
                    </div>
                    @else 

                    <header class="post-header">
                        <img style="float:left;position:relative;top:28px;left:-12px;z-index:999" class="post-avatar" width="20" height="20" src="img/{{$post->user_id}}/image01.jpg"><img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="img/{{User::find($post->to_id)->id}}/image01.jpg" style="float:left; margin-right: -17px;position:relative;left:-37px" >

                        <h2 class="post-title">Thumbs Up to {{User::find($post->to_id)->first_name.' '.User::find($post->to_id)->last_name}}</h2>

                        <p class="post-meta">
                            From <a href="#" class="post-author">{{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}</a> 
                            with values
                            @foreach(Tag::where('thumb_id', '=', $post->id)->get() as $tag)
                             <a class="post-category post-category-design" href="tag/{{$tag->tag}}">{{$tag->tag}}</a> 
                             @endforeach
                        </p>
                    </header>

                    <div class="post-description" style="padding-left: 83px;">
                        <p>
                            {{$post->content}}
                        </p>
                    </div>
                    
                    @endif
                    @endforeach
                 
                </section>
            </div>
        </div>
    </div>
@stop