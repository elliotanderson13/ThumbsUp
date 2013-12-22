@extends('template')
@section('content')
<div class="posts">
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
</div>
@stop