<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Langs\LangsInterface;
use Illuminate\Support\MessageBag;
use Redirect;

class LangsController extends ObjectBaseController {

	/**
	 * The place to find the views / URL keys for this controller
	 * @var string
	 */
	protected $view_key = 'langs';

	/**
	 * Construct Shit
	 */
	public function __construct(LangsInterface $langs)
	{
		$this->model = $langs;
		parent::__construct();
	}

	/**
	 *
	 */
	public function postNew()
	{
		$is_default = \Input::get('is_default');

		if ($is_default == 1) {
			\DB::table('langs')->update(array('is_default' => 0));
		}

		return parent::postNew();
	}

	/**
	 *
	 */
	public function postEdit($id)
	{
		$is_default = \Input::get('is_default');

		if ($is_default == 1) {
			\DB::table('langs')->update(array('is_default' => 0));
		}

		return parent::postEdit($id);
	}

	/**
	 *
	 */
	public function getChangeDefault()
	{
		$lang_code = \Input::get('lang');

		if (!$lang = $this->model->getByCode($lang_code)) {
			return Redirect::back()->with('errors' , new MessageBag(array('Вибраної мови не існує')));
		}

		$this->model->changeDefault($lang);

		return Redirect::back()->with('success' , new MessageBag(array('Мову за замовчуванням змінено')));
	}

}
