@extends('template')
@section('content')
<div class="posts">
                <h1 class="content-subhead">Desktop Mode</h1>
                {{Form::open(array(
                    'url'=>'thumb',
                    'class'=>'pure-form pure-form-stacked'
                ))}}
                <fieldset>

                    <label for="name">Give Somebody A Thumbs Up</label>
                    <input type="text" id="name" name="name" placeholder="Person's Username" />
                    <textarea id="post" name="post" placeholder="Your Comment" style="width: 100%;resize: none; "></textarea>
                    <input type="text" name="tags" placeholder="Tags Separated by Commas" style="width: 100%" />
                    <input type="submit" class="pure-button pure-button-primary" value="Post" />
                </fieldset>
                {{Form::close()}}
                <!-- A single blog post -->
                
                </section>
                @foreach($posts as $post)
                <header class="post-header">
                        <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg" style="float:left; margin-right: 20px;">

                        <h2 class="post-title">Thumbs Up to {{User::find($post->to_id)->first_name.' '.User::find($post->to_id)->last_name}}</h2>

                        <p class="post-meta">
                            From <a href="#" class="post-author">{{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}</a> 
                            with values
                            @foreach(Tag::where('thumb_id', '=', $post->id)->get() as $tag)
                             <a class="post-category post-category-design" href="tag/{{$tag->tag}}">{{$tag->tag}}</a> 
                             @endforeach
                        </p>
                    </header>

                    <div class="post-description" style="padding-left: 90px;">
                        <p>
                            {{$post->content}}
                        </p>
                    </div>
                @endforeach
            </div
        </div>
    </div>
@stop

@stop