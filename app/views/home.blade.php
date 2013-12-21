@extends('template')
@section('content')
<div id="main">
        <div class="content">
            <!-- A wrapper for all the blog posts -->
            <div class="posts">
                <h1 class="content-subhead">Desktop Mode</h1>
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
                <!-- A single blog post -->
                <section class="post">
                    @foreach($posts as $post)
                    <header class="post-header">
                        <img class="post-avatar" alt="tilo Mitra&#x27;s avatar" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg">
                        <h2 class="post-title">Post By {{User::find($post->user_id)->first_name.' '.User::find($post->user_id)->last_name}}
                        </h2>
                    </header>
                    <div class="post-description">
                        <p> 
                        {{$post->content}}
                        </p>
                    </div>
                    @endforeach
                    <header class="post-header">
                        <img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" src="img/{{$post->user_id}}/image01.jpg">

                        <h2 class="post-title">Thumbs Up to [NAME]</h2>

                        <p class="post-meta">
                            From <a href="#" class="post-author">[NAME]</a> with values <a class="post-category post-category-design" href="#">Smart</a> <a class="post-category post-category-pure" href="#">Caring</a>
                        </p>
                    </header>

                    <div class="post-description">
                        <p>
                            Great job on that project we just did. Thanks so much for not telling my boss that i stole a wad from her desk. I look foward to working for you soon.
                        </p>
                    </div>
                </section>
            </div>
        </div>
    </div>
@stop