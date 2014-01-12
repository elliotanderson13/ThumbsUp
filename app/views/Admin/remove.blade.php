<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Admin Panel Home</title>
		{{HTML::style('css/bootstrap.css')}}
		{{HTML::style('css/admin.css')}}
	</head>
	<body><br /><br />
		<div class="container">
			<div class="center-container">
				<center>
				<h2>Are you sure you want to delete this post?</h2>
				<a href='{{action("AdminController@home")}}' class="btn btn-info">Back</a>
				<a href='{{url("admin/confirm/$post->id")}}' class="btn btn-danger">Delete</a>

			</div>
		</div>
	</body>
</html>