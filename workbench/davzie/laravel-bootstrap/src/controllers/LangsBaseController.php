<?php namespace Davzie\LaravelBootstrap\Controllers;
use Illuminate\Support\MessageBag;
use View, Redirect, Input, App, ReflectionClass, Request, Config, Response;
use Davzie\LaravelBootstrap\Core\Exceptions\EntityNotFoundException;

abstract class LangsBaseController extends ObjectBaseController {

	/**
	 * add new item with lang
	 */
	public function getNew($lang_code = null, $id = null)
	{
		// get default lang code, if not isset
		if (!$lang_code) {
			if (!$lang_code = $this->lang_model->baseCode()) {
				return \App::abort(404);
			}
		}

		// if record isset, then redirect to edit
		// else if record was deleted, then trigger 404
		$class = get_class($this);
		if ($item = $this->model->findById($id, $lang_code)) {
			return Redirect::action("{$class}@getEdit", array('id' => $id, 'lang_code' => $lang_code));
		} elseif ($id && !$item = $this->model->findById($id)) {
			return \App::abort(404);
		}
		// get language by code
		if (!$lang = $this->lang_model->getByCode($lang_code)) {
			return \App::abort(404);
		}
		// get record with base lang
		// Its not correct. CHECK!!!
		if (!$default = $this->model->findByIdWithLangId($id, \Langs::hiddenId())) {
			$default = new \Pages();
		}

		// get all langs, exclude base lang
		$langs = $this->lang_model->list();

		return View::make('laravel-bootstrap::'.$this->view_key.'.new')
					->with('lang_id', $lang->id)
					->with('langs', $langs)
					->with('id', $id)
					->with('default', $default);
	}

	/**
	 * edit item with lang
	 */
	public function getEdit($id, $lang_code = null)
	{
		// get default lang code, if not isset
		if (!$lang_code) {
			if (!$lang_code = $this->lang_model->baseCode()) {
				return \App::abort(404);
			}
		}

		// current class name
		$class = get_class($this);

		if (!$item = $this->model->findById($id, $lang_code)) {
			if (!$item = $this->model->findById($id)) {
				return \App::abort(404);
			} else {
				return Redirect::action("{$class}@getNew", array('lang_code' => $lang_code, 'id' => $id));
			}
		}

		// get all langs, exclude base lang
		$langs = $this->lang_model->list();

		return View::make('laravel-bootstrap::'.$this->view_key.'.edit')
					->with('item', $item)
					->with('langs', $langs);
	}
}