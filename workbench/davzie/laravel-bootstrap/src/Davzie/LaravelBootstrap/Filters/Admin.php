<?php namespace Davzie\LaravelBootstrap\Filters;
use Auth, Redirect, Config;
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

		if (!$this->checkExists()) {
			return  \Response::make(\View::make('laravel-bootstrap::errors.404'), 404);
		}
		if (!$this->checkAccess()) {
			return  \Response::make(\View::make('laravel-bootstrap::errors.403'), 403);
		}

	}

	/**
	 *
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
	 *
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
