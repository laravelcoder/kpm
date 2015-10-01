<?php namespace Widgets;

use Davzie\LaravelBootstrap\News\NewsInterface;

/**
 * latest news widget
 */
class LatestNews
{
	/**
	 * model
	 */
	public $model;

	/**
	 * news limit
	 */
	public $limit = 4;

	/**
	 *
	 */
	public function __construct(NewsInterface $model)
	{
		$this->model = $model;
	}

	/**
	 * @param View $view
	 */
    public function compose($view)
    {
        $view->with('latest_news', $this->model->frontList($this->limit));
    }
}
