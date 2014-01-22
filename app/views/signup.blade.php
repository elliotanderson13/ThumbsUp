@extends('template')
@section('content')
<div class="row" style="margin-top:20px">
    <div class="col-xs-12 col-sm-8 col-md-6 col-sm-offset-2 col-md-offset-3">
		{{Form::open(array(
				'url'=>'register',
				'class'=>'pure-form pure-form-aligned',
				'role'=>'form'
			))}}
			<fieldset>
				<h2>Register</h2>
				<hr class="colorgraph">
				<div class="form-group">
					<input type="text" class="form-control input-lg" placeholder="First Name" name="first_name">
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-lg" placeholder="Last Name" name="last_name" />
				</div>
				<div class="form-group">
					<input type="text" class="form-control input-lg" placeholder="Username" name="username" />
				</div>
				<div class="form-group">
                    <input type="email" name="email" id="email" class="form-control input-lg" placeholder="Email Address">
				</div>
				<div class="form-group">
                    <input type="password" name="password" id="password" class="form-control input-lg" placeholder="Password">
				</div>
				<div class="form-group">
                    <input type="password" name="cpassword" id="password" class="form-control input-lg" placeholder="Confirm Password">
				</div>
				<hr class="colorgraph">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6">
                        <input type="submit" class="btn btn-lg btn-success btn-block" value="Submit">
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6">
						<a href="{{url('login')}}" class="btn btn-lg btn-primary btn-block">Login</a>
					</div>
				</div>
			</fieldset>
		</form>
	</div>
</div>
<!--<div class="posts">
	<h1 class="content-subhead">Register</h1>
	<section class="post">
			{{Form::open(array(
				'url'=>'register',
				'class'=>'pure-form pure-form-aligned'
			))}}
			<fieldset>
				<fieldset class="pure-group">

					<input type="text" class="pure-input-2-4" placeholder="First Name" name="first_name" />
					<input type="text" class="pure-input-2-4" placeholder="Last Name" name="last_name" />
					<input type="text" class="pure-input-2-4" placeholder="Username" name="username" />
					<input type="email" class="pure-input-2-4" placeholder="Email" name="email" />
					<input type="password" class="pure-input-2-4" placeholder="Password" name="password" />
					 <input type="password" class="pure-input-2-4" placeholder="Confirm Password" name="cpassword" />
				</fieldset>
				<input type="submit" class="pure-button pure-input-1-4 pure-button-primary" value="Create Account" style="width:186px;font-size:10pt" />
			</fieldset>
		</form>
	</section>
</div>->
@stop