<?php

use Davzie\LaravelBootstrap\News\NewsInterface;

class NewsController extends BaseController {

	/**
	 *
	 */
	public function __construct(NewsInterface $model)
	{
		parent::__construct();
		$this->model = $model;
	}

	/**
	 * get news list
	 */
	public function getIndex()
	{
		$news = $this->model->frontList();

		return View::make('news.index')
					->with('items', $news);
	}

	/**
	 * view new by slug
	 */
	public function getView($slug)
	{
		if (!$item = $this->model->getBySlug($slug)) {
			return App::abort(404);
		}

		$this->model->changeViews($item->id);

		return View::make('news.view')
					->with('item', $item);
	}

}
