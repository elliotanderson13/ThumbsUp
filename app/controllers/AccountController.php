<?php
class AccountController extends BaseController
{
	public function settings()
	{
		return View::make('Account.settings');
	}
}