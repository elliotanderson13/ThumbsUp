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
}
