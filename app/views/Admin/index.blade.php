<!DOCTYPE html>
<html lang="en">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Admin Panel</title>
		{{HTML::style('css/bootstrap.css')}}
		{{HTML::style('css/admin.css')}}
		<style type="text/css">
		* {
			margin: 0;
			padding: 0;

		}
		.header{
			width: 100%;
			height: 100%;
			background:  url('{{url("img/bg.jpg")}}') no-repeat center center fixed; 
			background-size: cover;
		}
		input[type=password]
		{
			color: rgb(77, 179, 214);
			padding: 24px;
			font-size: 20px;
			border-bottom-left-radius: 0;
			-webkit-border-bottom-left-radius: 0;
			-moz-border-radius-bottomleft: 0;
			border-bottom-right-radius: 0;
			-webkit-border-bottom-right-radius: 0;
			-moz-border-radius-bottomright: 0;
		}
		input[type=submit]
		{
			border-top-left-radius: 0;
			-webkit-border-top-left-radius: 0;
			-moz-border-radius-topleft: 0;
			border-top-right-radius: 0;
			-webkit-border-top-right-radius: 0;
			-moz-border-radius-topleft: 0;
		}

		</style>
	</head>
	<body>
		<div id="top" class="header">
			<div class="vert-text">
				<h2 style="color:#000;text-shadow: -1px 1px 2px rgba(255, 255, 255, 1);">Admin Panel</h2>
				<form action="{{action('AdminController@handleForm')}}" method="POST">
				<center>
				<input type="password" name="password" placeholder="Admin Password" class="form-control" style="width: 300px;" />
				<input type="submit" class="btn btn-info" style="width:300px;" />
				</center>
				</form>
			</div>
		</div>
	</body>
</html>