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
		$fullname = Input::get('name');
		list($firstN, $lastN) = explode(" ", $fullname);
		$username_id = User::where('first_name', '=', $firstN)->where('last_name', '=', $lastN)->first()->id;
		if (empty($username_id)){
			return Redirect::to('home')->with('error', 'That user does not exist.');
		}
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
			$new->tag = $tag;
			$new->save();
		}
		return Redirect::to('home');
	}
	public function tags($tag_name)
	{
		$tags = Tag::where('tag','=',$tag_name)->get();
		return View::make('tag')->with('tags', $tags)->with('tag_name',$tag_name);
	}
}
