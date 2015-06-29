<?php namespace Widgets;

use Davzie\LaravelBootstrap\Adverts\AdvertsInterface;

/**
 * latest news widget
 */
class Adverts
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
	public function __construct(AdvertsInterface $model)
	{
		$this->model = $model;
	}

	/**
	 * @param View $view
	 */
    public function compose($view)
    {
        $view->with('latest_adverts', $this->model->frontList($this->limit));
    }
}
