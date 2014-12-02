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

	/**
	 *
	 */
	public function users($id)
	{
		$user = new User();
		// $data = array(
		// 	'name' => 'test1',
		// 	'login' => 'lol',
		// 	'password' => 'lol2',
		// 	'is_active' => 1
		// );

		// $user->insert($data);
		// echo "Inserted success!";
		$user = $user->find($id);

		if (empty($user)) {
			App::abort(404);
		}

		return View::make('user', array('user' => $user));
	}

	/**
	 *
	 */
	public function index()
	{
		return View::make('index');
	}

}
