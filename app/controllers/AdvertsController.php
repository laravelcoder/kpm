<?php

use Davzie\LaravelBootstrap\Adverts\AdvertsInterface;

class AdvertsController extends \BaseController {

	/**
	 *
	 */
	public function __construct(AdvertsInterface $model)
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

		return View::make('adverts.index')
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
		//
		if (!$item = $this->model->frontView($id)) {
			return App::abort(404);
		}

		return View::make('adverts.view')
					->with('item', $item);
	}


}
