<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Roles\RolesInterface;
use Davzie\LaravelBootstrap\Access;
use Illuminate\Support\MessageBag;
use Davzie\LaravelBootstrap\Accounts\UserRepository;

class RolesController extends ObjectBaseController {

	/**
	 * The place to find the views / URL keys for this controller
	 * @var string
	 */
	protected $view_key = 'roles';

	/**
	 * Construct Shit
	 */
	public function __construct(RolesInterface $model)
	{
		$this->model = $model;
		parent::__construct();
	}

	/**
	 *
	 */
	public function getPermissions($id = null)
	{
		if (!$id) {
			return \App::abort(404);
		}

		if (!$item = $this->model->requireById($id)) {
			return \App::abort(404);
		}

		$permissions = [];
		if (!empty($item->permissions)) {
			$permissions = json_decode($item->permissions, true);
		}

		$defPems = Access::get();

		foreach ($defPems as $module => $perm) {
			foreach ($perm['rules'] as $key => $rule) {
				if (isset($permissions[$module])) {
					if (isset($permissions[$module][$key])) {
						//
						$defPems[$module]['rules'][$key]['enabled'] = $permissions[$module][$key];
					}
				}
			}
		}
		//
		return \View::make('laravel-bootstrap::'.$this->view_key.'.permissions')
					->with('item' , $item)
					->with('defPems' , $defPems)
					->with('permissions', $permissions);
	}

	/**
	 *
	 */
	public function postPermissions($id)
	{
		if (!$id) {
			return \App::abort(404);
		}

		if (!$item = $this->model->requireById($id)) {
			return \App::abort(404);
		}

		if ($this->model->savePerms($id, \Input::all())) {
			UserRepository::reloadPermssions(\Auth::user()->id);
			return \Redirect::to($this->object_url)->with('success' , new MessageBag(array('Права оновлено')));
		}

		return \Redirect::back()->with('error' , new MessageBag(array('Помилка при збереженні')));
	}

}
