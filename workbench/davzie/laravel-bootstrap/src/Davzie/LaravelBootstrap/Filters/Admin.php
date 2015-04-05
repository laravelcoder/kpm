<?php namespace Davzie\LaravelBootstrap\Filters;
use Auth, Redirect, Config, Session;
use Davzie\LaravelBootstrap\Access;

class Admin {

	/**
	 * If the user is not logged in then we need to get them outta here.
	 * @return mixed
	 */
	public function filter()
	{
		if (Auth::guest()) {
			return \View::make('laravel-bootstrap::login');

			// return Redirect::guest( Config::get('laravel-bootstrap::app.access_url').'/login');
		}

		// check action exsists
		if (!$this->checkExists()) {
			return  \Response::make(\View::make('laravel-bootstrap::errors.404'), 404);
		}

		// check access to this page
		if (!$this->checkAccess()) {

			// redirect to dashboard, if access denied after login
			if (Session::has('_login')) {
				Session::forget('_login');
				return \Redirect::to('/admin/')->with('success', new MessageBag(array('Вхід в систему здійснено успішно')));
			}

			return  \Response::make(\View::make('laravel-bootstrap::errors.403'), 403);
		}

	}

	/**
	 * check method does not exists
	 */
	public function checkExists()
	{
		$route = \Route::currentRouteAction();
		list($ctrl, $action) = explode('@', $route);

		if ($action == 'missingMethod') {
			return false;
		}

		return true;
	}

	/**
	 * check access to the page
	 */
	public function checkAccess()
	{
		$route = \Route::currentRouteAction();

		list($ctrl, $action) = explode('@', $route);
		$ctrl = explode('\\', $ctrl);
		$ctrl = end($ctrl);
		$ctrl = preg_replace('~Controller~', '', $ctrl);

		$action = preg_replace('~^get~', '', $action);
		$action = preg_replace('~^post~', '', $action);
		$action = preg_replace('~^put~', '', $action);
		$action = preg_replace('~^delete~', '', $action);
		$action = lcfirst($action);

		return Access::check($ctrl, $action);
	}
}
