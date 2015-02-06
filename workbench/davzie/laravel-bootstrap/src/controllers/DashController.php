<?php namespace Davzie\LaravelBootstrap\Controllers;
use Illuminate\Support\MessageBag;
use Davzie\LaravelBootstrap\Validators\Login;
use View, Auth, Redirect, Validator, Session, Input;
use Davzie\LaravelBootstrap\Accounts\UserRepository;

class DashController extends BaseController {

	/**
	 * Let's whitelist all the methods we want to allow guests to visit!
	 *
	 * @access   protected
	 * @var      array
	 */
	protected $whitelist = array(
		'getLogin',
		'getLogout',
		'postLogin'
	);

	/**
	 * Main users page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getIndex()
	{
		return View::make('laravel-bootstrap::dashboard');
	}

	/**
	 * Log the user out
	 * @return Redirect
	 */
	public function getLogout()
	{
		Auth::logout();
		Session::flush();

		return Redirect::back();
	}

	/**
	 * Login form page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getLogin()
	{

		// If logged in, redirect to admin area
		if (Auth::check())
		{
			return Redirect::to($this->urlSegment);
		}

		return View::make('laravel-bootstrap::login');
	}

	/**
	 * Login form processing.
	 *
	 * @access   public
	 * @return   Redirect
	 */
	public function postLogin()
	{
		$loginValidator = new Login(Input::all());

		// Check if the form validates with success.
		if ($loginValidator->passes())
		{

			$loginDetails = array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
			);

			// Try to log the user in.
			if (Auth::attempt($loginDetails))
			{
				$user = Auth::user();

				if ($user->is_active == 0) {
					Auth::logout();
					return Redirect::back()
							->with('errors', new MessageBag(array('Даний користувач заблокований')))
							->withInput();
				}

				$user->last_login = date('Y-m-d H:i:s');
				$user->save();

				UserRepository::reloadPermssions($user->id);

				// Redirect to the users page.
				return Redirect::back()
						->with('success', new MessageBag(array('Вхід в систему здійснено успішно')));
			}else{
				// Redirect to the login page.
				return Redirect::back()
							->with('errors', new MessageBag(array('Неправильний email або пароль')))
							->withInput();
			}
		}

		// Something went wrong.
		return Redirect::back()
				->withErrors($loginValidator->errors())->withInput();
	}

}
