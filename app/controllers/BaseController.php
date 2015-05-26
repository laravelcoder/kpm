<?php

class BaseController extends Controller {

	/**
	 * lang code
	 */
	public $lang_code = null;

	/**
	 * langs model instance
	 */
	public $lang_model = null;

	/**
	 * model
	 */
	public $model = null;

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

	/**
	 *
	 */
	public function __construct()
	{
		$this->lang_code = App::getLocale();
	}

}
