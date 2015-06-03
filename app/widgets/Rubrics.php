<?php namespace Widgets;

use Davzie\LaravelBootstrap\Rubrics\RubricsInterface;

/**
 * latest news widget
 */
class Rubrics
{
	/**
	 * model
	 */
	public $model;

	/**
	 *
	 */
	public function __construct(RubricsInterface $model)
	{
		$this->model = $model;
	}

	/**
	 * @param View $view
	 */
    public function compose($view)
    {
        $view->with('rubrics', $this->model->frontList());
    }
}
