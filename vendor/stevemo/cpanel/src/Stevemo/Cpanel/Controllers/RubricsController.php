<?php namespace Stevemo\Cpanel\Controllers;

use View, Redirect, Input, Lang, Config;
use Stevemo\Cpanel\Rubrics\Repo\CpanelRubricsInterface;
use Stevemo\Cpanel\Permission\Repo\PermissionInterface;

/**
 *
 */
class RubricsController extends BaseController {
	/**
	 * @var \Stevemo\Cpanel\Rubrics\Repo\CpanelRubricsInterface
	 */
	protected $rubrics;

	/**
	 * @var \Stevemo\Cpanel\Permission\Repo\PermissionInterface
	 */
	protected $permissions;

	/**
	 * @param \Stevemo\Cpanel\Rubrics\Repo\CpanelRubricsInterface     $rubrics
	 * @param \Stevemo\Cpanel\Rubrics\Form\RubricsFormInterface       $form
	 * @param \Stevemo\Cpanel\Permission\Repo\PermissionInterface $permissions
	 */
	public function __construct(
		CpanelRubricsInterface $rubrics,
		PermissionInterface $permissions
	)
	{
		$this->rubrics = $rubrics;
		$this->permissions = $permissions;
	}

	/**
	 *
	 */
	/**
	 * Display list of rubrics
	 */
	public function index()
	{
		$rubrics = $this->rubrics->findAll();

		return View::make('cpanel::rubrics.index', compact('rubrics'));
	}

	/**
	 * view rubrics
	 */
	public function view($id, $lang_code = null)
	{
		if (!$lang_code) {
			if (!$lang_code = \Langs::defaultLangCode()) {
				return \App::abort(404);
			}
		}

		if (!$rubric = $this->rubrics->findById($id, $lang_code)) {
			return \App::abort(404);
		}

		return View::make('cpanel::rubrics.view', compact('rubric'));
	}

	/**
	 * add rubrics
	 *
	 * Display add rubrics form
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
		if ($rubric = $this->rubrics->findById($id, $lang_code)) {
			return Redirect::route('cpanel.rubrics.edit', array('id' => $id, 'lang_code' => $lang_code));
		} elseif ($id && !$rubric = $this->rubrics->findById($id)) {
			return \App::abort(404);
		}

		// get language by code
		if (!$lang = \Langs::getByCode($lang_code)) {
			return \App::abort(404);
		}

		// get record with hidden lang
		if (!$default = $this->rubrics->findByIdWithLangId($id, \Langs::hiddenId())) {
			$default = new \Rubrics();
		}

		// get all langs, exclude hidden
		$langs = \Langs::allWithoutDefault();

		return View::make('cpanel::rubrics.add')
					->with('lang_id', $lang->id)
					->with('langs', $langs)
					->with('id', $id)
					->with('default', $default);
	}

	/**
	 * edit rubrics
	 *
	 * Display edit rubrics form
	 */
	public function edit($id, $lang_code = null)
	{
		// steps, like in add method
		if (!$lang_code) {
			if (!$lang_code = \Langs::defaultLangCode()) {
				return \App::abort(404);
			}
		}

		if (!$rubric = $this->rubrics->findById($id, $lang_code)) {
			if (!$rubric = $this->rubrics->findById($id)) {
				return \App::abort(404);
			} else {
				return Redirect::route('cpanel.rubrics.add', array('id' => $id, 'lang_code' => $lang_code));
			}
		}

		$langs = \Langs::allWithoutDefault();

		return View::make('cpanel::rubrics.edit')
					->with('rubric', $rubric)
					->with('langs', $langs);
	}

	/**
	 * create rubrics
	 */
	public function create($id = null)
	{
		// create new record (POST-method)
		if ($this->rubrics->create(Input::all(), $id)) {
			return Redirect::route('cpanel.rubrics.index');
		}

		return Redirect::back()
					->withInput()
					->withErrors($this->rubrics->getValidationErrors());
	}

	/**
	 * update new
	 */
	public function update($id)
	{
		// update isset record (PUT-method)
		if ($this->rubrics->update(Input::all(), $id)) {
			return Redirect::route('cpanel.rubrics.index');
		}

		return Redirect::back()
					->withInput()
					->withErrors($this->rubrics->getValidationErrors());
	}

	/**
	 * delete rubrics
	 */
	public function delete($id)
	{
		// delete record by id
		$this->rubrics->delete($id);

		return Redirect::route('cpanel.rubrics.index');
	}
}
