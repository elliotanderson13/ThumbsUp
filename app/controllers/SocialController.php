<?php
class SocialController extends BaseController
{
	public function like($post_id)
	{
		$post = Post::find($post_id);
		$post->likes++;
		$post->save();
		return Redirect::back();
	}
	public function comment($post_id)
	{
		$content = trim(Input::get('content'));
		if (empty($content))
		{
			return Redirect::back();
		}
		$user = Sentry::getUser();
		$comment = new Comment;
		$comment->content = Input::get('content');
		$comment->user_id = $user->id;
		$comment->post_id = $post_id;
		$comment->save();
		return Redirect::back();
	}
}