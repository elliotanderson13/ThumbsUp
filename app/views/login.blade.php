@extends('template')
@section('content')
<!--<script type="text/javascript">
var c = document.cookie;
c = c.split("=");
for (var i = c.length - 1; i >= 0; i) {
	if (c[i]=="credentials") {break;};
};
alert(c[i+1])
c = window.atob(c[i+1]);
alert(c);
c = c.split(";");
document.getElementById("u").value = c[0];
document.getElementById("p").value = c[0];

</script>-->
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
					<input type="text" class="pure-input-2-4" placeholder="Username" name="username" id="u"/>
					<input type="password" class="pure-input-2-4" placeholder="Password" name="password" id="p"/>
					
				</fieldset>
				<form class="pure-form">
					<script type="text/javascript">
					function r(){
						if (document.getElementById("c").checked) {
							var d = window.btoa(document.getElementById("u").value+";"+document.getElementById("p").value);
							alert(d);
							document.cookie='credentials='+d;
						};
					}
					</script>
				    <fieldset>
				        <label for="c">Keep me logged in
				        </label>
				        <input type="checkbox" id="c">
				    </fieldset>
				</form>
				<input type="submit" class="pure-button pure-button-input-1-4 pure-button-primary" value="Log In" style="font-size:10pt;width:186px" />
			</fieldset>
		</form>
	</section>
</div>
@stop