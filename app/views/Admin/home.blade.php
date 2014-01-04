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
				<table id="sorted-table" class="table table-striped main-table">
					<thead>
						<tr>
							<th>First Name</th>
							<th>Last Name</th>
							<th>Username</th>
							<th>Email</th>
							<th>Job Title</th>
							<th>Description</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>
						@foreach($users as $user)
						<tr>
							<td>{{$user->first_name}}</td>
							<td>{{$user->last_name}}</td>
							<td>{{$user->username}}</td>
							<td>{{$user->email}}</td>
							<td>{{$user->title}}</td>
							<td>{{$user->description}}</td>
							<td><a href='{{url("remove/$user->id")}}' class="btn btn-danger">Delete</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>