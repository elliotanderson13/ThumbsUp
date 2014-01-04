@extends('template')
@section('content')
<div class="posts">
	<h1 class="content-subhead">Log In</h1>
	<section class="post">
	@if(Session::has('message'))
		<p class="alert">{{ Session::get('message')}}</p>
	@endif
			{{Form::open(array(
				'url'=>'login',
				'class'=>'pure-form pure-form-aligned'
			))}}
			<fieldset>
				<fieldset class="pure-group">
					<input type="text" class="pure-input-2-4" placeholder="Username" name="username" />
					<input type="password" class="pure-input-2-4" placeholder="Password" name="password" />
					
				</fieldset>
				<input type="submit" class="pure-button pure-button-input-1-4 pure-button-primary" value="Log In" style="font-size:10pt;width:186px" />
			</fieldset>
		</form>
	</section>
</div>
@stop