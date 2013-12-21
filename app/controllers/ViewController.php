<?php
class ViewController extends BaseController
{
	public function handlePost()
	{
		$rules = array(
			'post'=>'required|min:5'
		);
		$validator = Validator::make(Input::all(), $rules);
		if ($validator->passes()){
			$post = new Post;
			$user = Sentry::getUser();
			$post->user_id = $user->id;
			$post->content = Input::get('post');
			$post->save();
			return Redirect::to('home');
		} else {
			return Redirect::to('home')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();

		}

	}
}