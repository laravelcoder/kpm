<?php namespace Davzie\LaravelBootstrap\Controllers;
use Illuminate\Support\MessageBag;
use View, Redirect, Input, App, ReflectionClass, Request, Config, Response;
use Davzie\LaravelBootstrap\Core\Exceptions\EntityNotFoundException;

abstract class LangsBaseController extends ObjectBaseController {

	/**
	 * add new item with lang
	 */
	public function getNew($lang = null, $id = null)
	{
		// get default lang code, if not isset
		if (!$lang) {
			if (!$lang = \Langs::baseCode()) {
				return \App::abort(404);
			}
		}

		// if record isset, then redirect to edit
		// else if record was deleted, then trigger 404
		if ($item = $this->model->findById($id, $lang_code)) {
			return Redirect::route('cpanel.pages.edit', array('id' => $id, 'lang_code' => $lang_code));
		} elseif ($id && !$item = $this->model->findById($id)) {
			return \App::abort(404);
		}
		// get language by code
		if (!$lang = \Langs::getByCode($lang_code)) {
			return \App::abort(404);
		}
		// get record with hidden lang
		if (!$default = $this->model->findByIdWithLangId($id, \Langs::hiddenId())) {
			$default = new \Pages();
		}
		$ps = $this->model->findForParent($default->id, $lang->id);
		// get all langs, exclude hidden
		$langs = \Langs::allWithoutDefault();
		return View::make('cpanel::pages.add')
					->with('lang_id', $lang->id)
					->with('langs', $langs)
					->with('id', $id)
					->with('pages', $ps)
					->with('default', $default);
	}

	/**
	 * edit item with lang
	 */
	public function getEdit($id, $lang = null)
	{}
}