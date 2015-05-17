<?php namespace Davzie\LaravelBootstrap\Controllers;
use Illuminate\Support\MessageBag;
use View, Redirect, Input, App, ReflectionClass, Request, Config, Response;
use Davzie\LaravelBootstrap\Core\Exceptions\EntityNotFoundException;

abstract class LangsBaseController extends ObjectBaseController {

	/**
	 *
	 */
	public function __construct()
	{
		parent::__construct();

		if (!$lang = $this->lang_model->defaultLang()) {
			throw new Exception("Відсутня мова за замовчуванням", 1);
		}

		\View::share('hidden_lang', $this->lang_model->getHidden());
		\View::share('default_lang', $this->lang_model->defaultLang());
	}

	/**
	 * add new item with lang
	 */
	public function getNew($lang_code = null, $id = null)
	{
		// get default lang code, if not isset
		if (!$lang_code) {
			if (!$lang_code = $this->lang_model->defaultCode()) {
				return \App::abort(404);
			}
		}

		// if record isset, then redirect to edit
		// else if record was deleted, then trigger 404
		$class = get_class($this);
		$item = null;
		if ($item = $this->model->findById($id, $lang_code)) {
			return Redirect::action("{$class}@getEdit", array('id' => $id, 'lang_code' => $lang_code));
		} elseif ($id && !$item = $this->model->findById($id)) {
			return \App::abort(404);
		}
		// get language by code
		if (!$lang = $this->lang_model->getByCode($lang_code)) {
			return \App::abort(404);
		}

		// prepare empty model instance
		$default = $this->model->getDefault($id);

		// get all langs, exclude base lang
		$langs = $this->lang_model->getList();

		// path to upload files
		$path = $this->model->getPaths($item);

		return View::make('laravel-bootstrap::'.$this->view_key.'.new')
					->with('lang_id', $lang->id)
					->with('langs', $langs)
					->with('id', $id)
					->with('path', $path)
					->with('default', $default);
	}

	/**
	 * edit item with lang
	 */
	public function getEdit($id, $lang_code = null)
	{
		// get default lang code, if not isset
		if (!$lang_code) {
			if (!$lang_code = $this->lang_model->defaultCode()) {
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
		$langs = $this->lang_model->getList();

		// path to upload files
		$path = $this->model->getPaths($item->getAttributes());

		return View::make('laravel-bootstrap::'.$this->view_key.'.edit')
					->with('item', $item)
					->with('path', $path)
					->with('langs', $langs);
	}

	/**
	 * The new object method, very generic, just allows mass assignable stuff to be filled and saved
	 * @return Redirect
	 */
	public function postNew($lang_code = null, $id = null)
	{
		$record = $this->model->getNew(Input::all(), (bool)$id);

		// get language by lang code
		if (!$lang_code) {
			$lang_code = $this->lang_model->defaultCode();
		}

		$lang = $this->lang_model->getByCode($lang_code);

		// validate inputs
		$valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

		if(!$valid) {
			return Redirect::back()->withErrors($record->getErrors())->withInput();
		}

		if (!empty($this->model->findById($id, $lang_code))) {
			$class = get_class($this);
			return Redirect::action("{$class}@getEdit", array('id' => $id, 'lang_code' => $lang_code));
		}

		// saving data
		$record = $this->model->getNew(Input::all());
		$record->lang_id = $lang->id;
		$record->save();

		$this->model->createHidden($record->id, Input::all());
		$this->model->updateCommon($record->id, Input::all());
		$this->model->saveRelations($record->id);

		if (Input::has('_stay') && Input::get('_stay')) {
			return Redirect::to($this->edit_url.$record->id)->with('success' , new MessageBag(array('Запис додано')));
		}

		// Redirect that shit man! You did good! Validated and saved, man mum would be proud!
		return Redirect::to($this->object_url)->with('success' , new MessageBag(array('Запис додано')));
	}

	/**
	 * The method to handle the posted data
	 * @param  integer $id The ID of the object
	 * @return Redirect
	 */
	public function postEdit($id, $lang_code = null)
	{
		if (!$lang_code) {
			$lang_code = $this->lang_model->defaultCode();
		}

		$lang = $this->lang_model->getByCode($lang_code);
		$record = $this->model->getNew(Input::all()+ ['id' => $id], true);
		$record->fill(Input::all() + ['id' => $id]);

		$data = $record->getAttributes();

		$valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

		if(!$valid) {
			return Redirect::to($this->edit_url.$id)->with('errors' , $record->getErrors())->withInput();
		}

		$this->model->update($id, $lang->id, $data);
		$this->model->updateCommon($id, Input::all());
		$this->model->updateRelations($id);

		// Redirect that shit man! You did good! Validated and saved, man mum would be proud!
		return Redirect::to($this->object_url)->with('success' , new MessageBag(array('Зміни збережено')));

	}
}