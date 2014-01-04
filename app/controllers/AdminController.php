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
			return Redirect::action("AdminController@home");
		}
		return Redirect::back();
	}
	public function home()
	{
		$users = User::where('id', '>', '0')->get();
		return View::make('Admin.home')
		->with('users', $users);	
	}
	public function remove($user_id)
	{
		$user = User::find($user_id);
		return View::make('Admin.remove')
		->with('user', $user);
	}
	public function confirmRemove($user_id)
	{
		$user = User::find($user_id);
		return 'put delete stuff here';
	}
}
