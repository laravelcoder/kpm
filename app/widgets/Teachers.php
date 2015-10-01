<?php namespace Widgets;

use Davzie\LaravelBootstrap\Teachers\TeachersInterface;

/**
 * latest news widget
 */
class Teachers
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
	public function __construct(TeachersInterface $model)
	{
		$this->model = $model;
	}

	/**
	 * @param View $view
	 */
    public function compose($view)
    {
        $view->with('teachers', $this->model->getRandom());
    }
}
