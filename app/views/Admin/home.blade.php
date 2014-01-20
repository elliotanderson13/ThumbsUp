<!DOCTYPE html>
<?php $posts = Post::where('id', '>', '0')->orderBy('id', 'desc')->get(); ?>
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
							<th>From</th>
							<th>To</th>
							<th>Content</th>
							<th>Created At</th>
							<th>Options</th>
						</tr>
					</thead>
					<tbody>

						@foreach($posts as $post)
						<?php 
						$from = User::where('id', $post->user_id)->first();
						$fromname = $from->first_name.' '.$from->last_name;
						$to = User::where('id', $post->to_id)->first();
						$toname = $to->first_name.' '.$to->last_name;
						?>
						<tr>
							<td>{{$fromname}}</td>
							<td>{{$toname}}</td>
							<td>{{$post->content}}</td>
							<td>{{$post->created_at}}</td>
							<td><a href='{{ url("/remove/$post->id")}}' class="btn btn-danger">Delete</a></td>
						</tr>
						@endforeach
					</tbody>
				</table>
				<?php $data = "sdf"; ?>
				<a href='{{ url("export")}}' class="btn btn-primary">Export</a>
			</div>
		</div>
	</body>
</html>