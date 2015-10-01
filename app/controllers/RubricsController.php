<?php

use Davzie\LaravelBootstrap\Rubrics\RubricsInterface;

class RubricsController extends BaseController {

	/**
	 *
	 */
	public function __construct(RubricsInterface $model)
	{
		parent::__construct();
		$this->model = $model;
	}

	/**
	 *
	 */
	public function getView($slug)
	{
		if (!$rubric = $this->model->getBySlug($slug)) {
			return App::abort(404);
		}

		return View::make('rubrics.view')
					->with('rubric', $rubric);
	}
}