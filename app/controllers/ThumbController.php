<?php 
class ThumbController extends BaseController
{
	public function index()
	{
		$posts = Post::where('type', '=', 'Thumb')->get();
		return View::make('thumb', compact('posts'));
	}
	public function handle()
	{	
		$user = Sentry::getUser();
		$user_id  = $user->id;
		$username = Input::get('name');
		$username_id = User::where('username', '=', $username)->first();
		if (empty($username_id)){
			return Redirect::to('home')->with('error', 'That user does not exist.');
		}
		$username_id = $username_id->id;
		$content = Input::get('post');
		$post = new Post;
		$post->user_id = $user_id;
		$post->to_id = $username_id;
		$post->content = $content;
		$post->type = 'Thumb';
		$post->save();
		$post_id = Post::orderBy('id', 'desc')->first()->id;
		$tags = Input::get('tags');
		$tags = explode(',', $tags);
		foreach($tags as $tag)
		{
			$new = new Tag;
			$new->thumb_id = $post_id;
			$tag = trim($tag);
			$new->tag = $tag;
			$new->save();
		}
		return Redirect::to('home');
	}
	public function tags($tag_name)
	{
		$tags = Tag::where('tag','=',$tag_name)->orderBy('id', 'desc')->get();
		return View::make('tag')->with('tags', $tags)->with('tag_name',$tag_name);
	}
}
