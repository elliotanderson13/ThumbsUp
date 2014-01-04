<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function showWelcome()
	{
		return View::make('hello');
	}
	public function index()
	{
		$posts = Post::where('id', '>', '0')->orderBy('id', 'desc')->get();
		return View::make('home', compact('posts'));
	}
	public function wall()
	{
		$posts = Post::where('id', '>', '0')->get();
		return View::make('home', compact('posts'));
	}
	public function profile($username)
	{
		$user = User::where('username', '=', $username)->first();
		if (empty($user->id))
		{
			return Redirect::action('HomeController@index');
		}
		$user_id = $user->id;
			return View::make('profile')
			->with('user_id', $user_id);
	}
	public function login()
	{
		return View::make('login');
	}
	public function register()
	{
		return View::make('signup');
	}
	public function handleRegister()
	{
		 $rules = array(
		 	'first_name'=>'required|min:2',
		 	'last_name'=>'required|min:2',
		 	'username'=>'required|unique:users|alpha_num|min:3',
		 	'email'=>'required|email',
		 	'password'=>'required|min:4|max:36',
		 	'c_password'=>'same:password'
		 );
		 $data = Input::all();
		 $validator = Validator::make($data, $rules);
		 if ($validator->passes())
		 {
		 	$user = new User;
		 	$user->first_name = Input::get('first_name');
		 	$user->last_name = Input::get('last_name');
		 	$user->email = Input::get('email');
		 	$user->password = Hash::make(Input::get('password'));
		 	$user->username = Input::get('username');
		 	$user->activated = 1;
		 	$user->save();
		 	$newuser = User::where('id', '>', '0')->orderBy('id', 'desc')->first();
		 	$user_id = $newuser->id;
		 	$public = public_path();
		 	mkdir("$public/img/$user_id");
		 	copy("$public/img/image01.jpg", "$public/img/$user_id/image01.jpg");
		 	return Redirect::to('login')->with('message', 'Thanks for registering');

		 }
		 return Redirect::to('register')->with('message', 'The following errors occurred')->withErrors($validator)->withInput();
	}
	public function handleLogin()
	{
		try
		{
			$credentials = array(
				'username'=>Input::get('username'),
				'password'=>Input::get('password'),
			);
			$user = Sentry::authenticate($credentials, false);
			return Redirect::to('wall');
		}
		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
{
    $message = 'Login field is required.';
    return Redirect::to('login')->with('message', $message);
}
catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
{
    $message = 'Password field is required.';
    return Redirect::to('login')->with('message', $message);

}
catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
{
    $message = 'Wrong password, try again.';
    return Redirect::to('login')->with('message', $message);

}
catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
{
    $message = 'User was not found.';
    return Redirect::to('login')->with('message', $message);

}
catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
{
    $message = 'User is not activated.';
    return Redirect::to('login')->with('message', $message);

}

// The following is only required if throttle is enabled
catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
{
    $message = 'User is suspended.';
    return Redirect::to('login')->with('message', $message);

}
catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
{
    $message = 'User is banned.';
    return Redirect::to('login')->with('message', $message);

}
	}

	public function logout()
	{
		Sentry::logout();
		return Redirect::to('login');
	}
	public function names()
	{
		$name = $_GET['q'];
		$names = User::where('first_name', 'like', '%$name')->where('last_name', 'like', '%name')->get();
		foreach ($names as $name)
		{
			echo $name;
		}
	}



}