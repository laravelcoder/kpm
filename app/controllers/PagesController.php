<?php

use Davzie\LaravelBootstrap\Pages\PagesInterface;

class PagesController extends BaseController {

	/**
	 *
	 */
	public function __construct(PagesInterface $model)
	{
		parent::__construct();
		$this->model = $model;
	}

	/**
	 * view page by slug
	 */
	public function getView($slug)
	{
		if (!$item = $this->model->getBySlug($slug)) {
			return App::abort(404);
		}

		return View::make('pages.view')
					->with('item', $item);
	}

	/**
	 * get contact page
	 */
	public function getContact() {}

	/**
	 * post contact page (store feedback)
	 */
	public function postContact() {}

}
