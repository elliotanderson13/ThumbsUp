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
		$first_name = Input::get('first_name');
		$last_name = Input::get('last_name');
		$title = Input::get('title');
		$description = Input::get('description');
		$picture = Input::file('pic');
		$color = Input::get('color');
		if (is_object($picture)) {
			$picture->move("img/$user_id", 'image01.jpg');
		}
		if ($first_name != "") {
			$edit->first_name = $first_name;
		}
		if ($last_name != "") {
			$edit->last_name = $last_name;
		}
		if ($title != "") {
			$edit->title = $title;
		}
		if ($description != "") {
			$edit->description = $description;
		}
		$edit->color = $color;
		$edit->save();
		$username = $user->username;
		return Redirect::to("wall");
	}
}

