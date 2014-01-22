@extends('template')
@section('content')
<title>Log In</title>
<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		{{Form::open(array(
				'url'=>'login',
				'class'=>'pure-form pure-form-aligned',
				'role'=>'form'
			))}}
			<fieldset>
				<h2>Please Sign In</h2>
				<hr class="colorgraph">
				<div class="form-group">
                    <input type="text" name="username" id="email" class="form-control input-lg" placeholder="Username">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
				</div>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Sign In">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="{{url('register')}}" class="btn btn-lg btn-primary btn-block">Register</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!--<div class="posts">
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
</div>-->
@stop