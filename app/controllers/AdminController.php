<?php
class AdminController extends BaseController
{
	public function index()
	{
		return View::make('Admin.index');
	}
	public function handleForm()
	{
		$password = Input::get('password');
		if ($password == "bostonheartdiag")
		{
			$posts = Post::where('id', '>', '0')->orderBy('id', 'desc')->get();
			return Redirect::action("AdminController@home", compact('posts'));
		}
		return Redirect::back();
	}
	public function home()
	{
		$users = User::where('id', '>', '0')->get();
		return View::make('Admin.home')
		->with('users', $users);	
	}
	public function remove($post_id)
	{
		$post = Post::find($post_id);
		return View::make('Admin.remove')
		->with('post', $post);
	}
	public function confirmRemove($post_id)
	{
		$post = Post::find($post_id);
		$tags = Tag::where('thumb_id', $post_id)->get();
		$comments = Comment::where('post_id', $post_id)->get();
		if (!isset($post->id)) {
			$posts = Post::where('id', '>', '0')->orderBy('id', 'desc')->get();
			return Redirect::action("AdminController@home", compact('posts'));
		}
		foreach ($tags as $tag) {
			$tag->delete();
		}
		foreach ($comments as $comment) {
			$comment->delete();
		}
		$post->delete();
		$posts = Post::where('id', '>', '0')->orderBy('id', 'desc')->get();
		return Redirect::action("AdminController@home", compact('posts'));
	}
}
