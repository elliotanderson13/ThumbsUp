<?php
class AccountController extends BaseController
{
	public function settings()
	{
		return View::make('Account.settings');
	}
	public function handlePic()
	{
		$user = Sentry::getUser();
		$user_id = $user->id;
		Input::file('pic')->move("img/$user_id", 'image01.jpg');
		return Redirect::to('home');
	}
	public function editProfile()
	{
		$user = Sentry::getUser();
		$user_id = $user->id;
		return View::make('edit', compact('user_id'));
	}
	public function handleEdit()
	{
		$user = Sentry::getUser();
		$user_id = $user->id;
		$edit = User::find($user_id);
		$edit->title = Input::get('title');
		$edit->description = Input::get('description');
		$edit->save();
		return Redirect::to('profile');
	}
}

