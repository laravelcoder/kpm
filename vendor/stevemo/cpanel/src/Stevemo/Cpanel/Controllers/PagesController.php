<?php namespace Stevemo\Cpanel\Controllers;

use View, Redirect, Input, Lang, Config;
use Stevemo\Cpanel\Pages\Repo\CpanelPagesInterface;
use Stevemo\Cpanel\Permission\Repo\PermissionInterface;

/**
 *
 */
class PagesController extends BaseController {
	/**
	 * @var \Stevemo\Cpanel\Pages\Repo\CpanelPagesInterface
	 */
	protected $pages;

	/**
	 * @var \Stevemo\Cpanel\Permission\Repo\PermissionInterface
	 */
	protected $permissions;

	/**
	 * @param \Stevemo\Cpanel\Pages\Repo\CpanelPagesInterface     $pages
	 * @param \Stevemo\Cpanel\Pages\Form\PagesFormInterface       $form
	 * @param \Stevemo\Cpanel\Permission\Repo\PermissionInterface $permissions
	 */
	public function __construct(
		CpanelPagesInterface $pages,
		PermissionInterface $permissions
	)
	{
		$this->pages = $pages;
		$this->permissions = $permissions;
	}

	/**
	 *
	 */
	/**
	 * Display list of pages
	 */
	public function index()
	{
		$pages = $this->pages->findAll();

		return View::make('cpanel::pages.index', compact('pages'));
	}

	/**
	 * view pages
	 */
	public function view($id, $lang_code = null)
	{
		if (!$lang_code) {
			if (!$lang_code = \Langs::defaultLangCode()) {
				return \App::abort(404);
			}
		}

		if (!$rubric = $this->pages->findById($id, $lang_code)) {
			return \App::abort(404);
		}

		return View::make('cpanel::pages.view', compact('rubric'));
	}

	/**
	 * add pages
	 *
	 * Display add pages form
	 */
	public function add($lang_code = null, $id = null)
	{
		// get default lang code, if not isset
		if (!$lang_code) {
			if (!$lang_code = \Langs::defaultLangCode()) {
				return \App::abort(404);
			}
		}

		// if record isset, then redirect to edit
		// else if record was deleted, then trigger 404
		if ($rubric = $this->pages->findById($id, $lang_code)) {
			return Redirect::route('cpanel.pages.edit', array('id' => $id, 'lang_code' => $lang_code));
		} elseif ($id && !$rubric = $this->pages->findById($id)) {
			return \App::abort(404);
		}

		// get language by code
		if (!$lang = \Langs::getByCode($lang_code)) {
			return \App::abort(404);
		}

		// get record with hidden lang
		if (!$default = $this->pages->findByIdWithLangId($id, \Langs::hiddenId())) {
			$default = new \Pages();
		}

		$ps = $this->pages->findForParent($default->id, $lang->id);

		// get all langs, exclude hidden
		$langs = \Langs::allWithoutDefault();

		return View::make('cpanel::pages.add')
					->with('lang_id', $lang->id)
					->with('langs', $langs)
					->with('id', $id)
					->with('pages', $ps)
					->with('default', $default);
	}

	/**
	 * edit pages
	 *
	 * Display edit pages form
	 */
	public function edit($id, $lang_code = null)
	{
		// steps, like in add method
		if (!$lang_code) {
			if (!$lang_code = \Langs::defaultLangCode()) {
				return \App::abort(404);
			}
		}

		if (!$page = $this->pages->findById($id, $lang_code)) {
			if (!$page = $this->pages->findById($id)) {
				return \App::abort(404);
			} else {
				return Redirect::route('cpanel.pages.add', array('id' => $id, 'lang_code' => $lang_code));
			}
		}

		// get language by code
		if (!$lang = \Langs::getByCode($lang_code)) {
			return \App::abort(404);
		}

		$langs = \Langs::allWithoutDefault();
		$ps = $this->pages->findForParent($page->id, $lang->id);

		return View::make('cpanel::pages.edit')
					->with('page', $page)
					->with('pages', $ps)
					->with('langs', $langs);
	}

	/**
	 * create pages
	 */
	public function create($id = null)
	{
		// create new record (POST-method)
		if ($this->pages->create(Input::all(), $id)) {
			return Redirect::route('cpanel.pages.index');
		}

		return Redirect::back()
					->withInput()
					->withErrors($this->pages->getValidationErrors());
	}

	/**
	 * update new
	 */
	public function update($id)
	{
		// update isset record (PUT-method)
		if ($this->pages->update(Input::all(), $id)) {
			return Redirect::route('cpanel.pages.index');
		}

		return Redirect::back()
					->withInput()
					->withErrors($this->pages->getValidationErrors());
	}

	/**
	 * delete pages
	 */
	public function delete($id)
	{
		// delete record by id
		$this->pages->delete($id);

		return Redirect::route('cpanel.pages.index');
	}
}
