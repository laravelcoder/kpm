<?php namespace Stevemo\Cpanel\Controllers;

use View, Redirect, Input, Lang, Config;
use Stevemo\Cpanel\News\Repo\CpanelNewsInterface;
use Stevemo\Cpanel\Permission\Repo\PermissionInterface;
use Stevemo\Cpanel\News\Repo\NewsNotFoundException;

class NewsController extends BaseController {

	/**
	 * @var \Stevemo\Cpanel\News\Repo\CpanelNewsInterface
	 */
	protected $news;

	/**
	 * @var \Stevemo\Cpanel\Permission\Repo\PermissionInterface
	 */
	protected $permissions;

	/**
	 * @param \Stevemo\Cpanel\News\Repo\CpanelNewsInterface     $news
	 * @param \Stevemo\Cpanel\News\Form\NewsFormInterface       $form
	 * @param \Stevemo\Cpanel\Permission\Repo\PermissionInterface $permissions
	 */
	public function __construct(
		CpanelNewsInterface $news,
		PermissionInterface $permissions
	)
	{
		$this->news = $news;
		$this->permissions = $permissions;
	}

	/**
	 * Display list of news
	 */
	public function index()
	{
		return View::make('cpanel::news.index');
	}

	/**
	 * view news
	 */
	public function view($id, $lang_code = null)
	{
		return View::make('cpanel::news.view');
	}

	/**
	 * add news
	 *
	 * Display add news form
	 */
	public function add($lang_code = null)
	{
		return View::make('cpanel::news.add');
	}

	/**
	 * edit news
	 *
	 * Display edit news form
	 */
	public function edit($id, $lang_code = null)
	{
		return View::make('cpanel::news.edit');
	}

	/**
	 * create news
	 */
	public function create($lang_code = null)
	{}

	/**
	 * update new
	 */
	public function update($id, $lang_code = null)
	{}

	/**
	 * delete news
	 */
	public function delete($id)
	{}


}
