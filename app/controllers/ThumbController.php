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
		$fullnamearr = explode(" ", $fullname);
		if (!isset($fullnamearr[1])) {
			return Redirect::to('home')->with('error', 'That user does not exist.');
		}
		$username_id = User::where('first_name', $fullnamearr[0])->where('last_name', $fullnamearr[1])->first();
		if (empty($username_id->id)){
			return Redirect::to('home')->with('error', 'That user does not exist.');
		}
		$content = Input::get('post');
		$email = $username_id->email;
		$name = $fullnamearr[0].' '.$fullnamearr[1];
		$data = array('name'=>$name, 'poster'=>$user->first_name.' '.$user->last_name);
		Mail::send('email', $data, function($message) use($email, $name)
		{
			$message->from('no-reply@withheartfeltthanks.com', 'With Heartfelt Thanks');
		    $message->to($email, $name)->subject('With Heartfelt Thanks');
		});
		$username_id = $username_id->id;
		
		$post = new Post;
		$post->likes = 0;
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
		$tag = Tag::where('tag', '=', $tag_name)->first();
		if (empty($tag->tag))
		{
		    return Redirect::back();
		}
		return View::make('tag')->with('tags', $tags)->with('tag_name',$tag_name);
	}

}
