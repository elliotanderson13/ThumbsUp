@extends('template')
@section('content')
<div class="posts">
			<h1 class="content-subhead">Profile</h1>
			<section class="post">
				<header class="post-header">
					<img class="post-avatar" alt="Tilo Mitra&#x27;s avatar" height="48" width="48" style="float:left;margin-right:20px" src="img/{{$user_id}}/image01.jpg">
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
			{{HTML::link('profile/edit', 'Edit Profile', array('class'=>'pure-button pure-button-primary'))}}

		</div>
	</div>
</div>
@stop