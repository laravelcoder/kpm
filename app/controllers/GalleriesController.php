<?php

use Davzie\LaravelBootstrap\Galleries\GalleriesInterface;

class GalleriesController extends \BaseController {

	/**
	 *
	 */
	public function __construct(GalleriesInterface $model)
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

		return View::make('galleries.index')
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

		return View::make('galleries.view')
					->with('item', $item);
	}
}
