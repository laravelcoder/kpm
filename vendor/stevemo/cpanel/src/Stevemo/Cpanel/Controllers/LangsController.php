<?php namespace Stevemo\Cpanel\Controllers;

use View, Redirect, Input, Lang, Config;
use Stevemo\Cpanel\Langs\Repo\CpanelLangsInterface;
use Stevemo\Cpanel\Permission\Repo\PermissionInterface;
use Stevemo\Cpanel\Langs\Repo\LangsNotFoundException;

class LangsController extends BaseController {

	/**
	 * @var \Stevemo\Cpanel\Langs\Repo\CpanelLangsInterface
	 */
	protected $langs;

	/**
	 * @var \Stevemo\Cpanel\Langs\Form\LangsFormInterface
	 */
	protected $form;

	/**
	 * @var \Stevemo\Cpanel\Permission\Repo\PermissionInterface
	 */
	protected $permissions;

	/**
	 * @param \Stevemo\Cpanel\Langs\Repo\CpanelLangsInterface     $langs
	 * @param \Stevemo\Cpanel\Langs\Form\LangsFormInterface       $form
	 * @param \Stevemo\Cpanel\Permission\Repo\PermissionInterface $permissions
	 */
	public function __construct(
		CpanelLangsInterface $langs,
		PermissionInterface $permissions
	)
	{
		$this->langs = $langs;
		$this->permissions = $permissions;
	}

	/**
	 * Display list of langs
	 */
	public function index()
	{
		$langs = $this->langs->findAll();

		return View::make('cpanel::langs.index')
			->with('langs', $langs);
	}

	/**
	 * view langs
	 */
	public function view($id)
	{
		if (!$lang = $this->langs->findById($id)) {
			\App::abort('404');
		}

		return View::make('cpanel::langs.view')
			->with('lang', $lang);
	}

	/**
	 * add langs
	 *
	 * Display add langs form
	 */
	public function add()
	{
		return View::make('cpanel::langs.add');
	}

	/**
	 * edit langs
	 *
	 * Display edit langs form
	 */
	public function edit($id)
	{
		if (!$lang = $this->langs->findById($id)) {
			\App::abort('404');
		}

		return View::make('cpanel::langs.edit')
			->with('lang', $lang);
	}

	/**
	 * create langs
	 */
	public function create()
	{
		if ($this->langs->create(Input::all())) {
			return Redirect::route('cpanel.langs.index');
		}

		return Redirect::back()
					->withInput()
					->withErrors($this->langs->getValidationErrors());
	}

	/**
	 * update new
	 */
	public function update($id)
	{
		if ($this->langs->update(Input::all(), $id)) {
			return Redirect::route('cpanel.langs.index');
		}

		return Redirect::back()
					->withInput()
					->withErrors($this->langs->getValidationErrors());
	}

	/**
	 * delete langs
	 */
	public function delete($id)
	{
		if ($lang = $this->langs->findById($id)) {
			$this->langs->delete($id);
		}

		return Redirect::route('cpanel.langs.index');
	}

}
