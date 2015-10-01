<?php

use Davzie\LaravelBootstrap\Teachers\TeachersInterface;

class TeachersController extends \BaseController {

	/**
	 *
	 */
	public function __construct(TeachersInterface $model)
	{
		parent::__construct();
		$this->model = $model;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function getIndex()
	{
		$items = $this->model->frontList();

		return View::make('teachers.index')
					->with('items', $items);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function getView($id)
	{
		if (!$item = $this->model->frontView($id)) {
			return App::abort(404);
		}

		return View::make('teachers.view')
					->with('item', $item);
	}
}
