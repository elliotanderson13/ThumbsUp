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
			$post->user_id = Sentry::getUser();
			$post->content = Input::get('post');
			$post->save();
			return Redirect::to('home');
		} else {
			return Redirect::to('home')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();

		}

	}
}