<?php $posts = Post::where('id', '>', '0')->orderBy('id', 'desc')->get(); ?>
<table id="sorted-table" class="table table-striped main-table">
	<thead>
		<tr>
			<th><b>From</b></th>
			<th><b>To</b></th>
			<th><b>Content</b></th>
			<th><b>Created At</b></th>
		</tr>
	</thead>
	<tbody>
		@foreach($posts as $post)
		<?php 
		$from = User::where('id', $post->user_id)->first();
		$fromname = $from->first_name.' '.$from->last_name;
		$to = User::where('id', $post->to_id)->first();
		$toname = $to->first_name.' '.$to->last_name;
		$comments = Comment::where('post_id', '=', $post->id)->first();
		?>
		<tr>
			<td>{{$fromname}}</td>
			<td>{{$toname}}</td>
			<td>{{$post->content}}</td>
			<td>{{$post->created_at}}</td>
		</tr>
		@endforeach
	</tbody>
</table>