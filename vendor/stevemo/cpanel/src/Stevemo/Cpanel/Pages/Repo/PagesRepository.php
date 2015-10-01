<?php namespace Stevemo\Cpanel\Pages\Repo;

use Illuminate\Events\Dispatcher;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Stevemo\Cpanel\Pages\Repo\PagesValidator;

/**
 *
 */
class PagesRepository implements CpanelPagesInterface {

	/**
	 *
	 */
	protected $model;

	/**
	 *
	 */
	protected $config;

	/**
	 *
	 */
	protected $validator;

	/**
	 *
	 */
	protected $fields = array();

	/**
	 *
	 */
	public function __construct(\Pages $model, Repository $config, PagesValidator $validator)
	{
		$this->model = $model;
		$this->config = $config;
		$this->validator = $validator;
	}

	/**
	 *
	 */
	public function findById($id, $lang_code = null)
	{
		if ($lang_code) {
			return \Langs::where('code', '=', $lang_code)->first()->pages()->find($id);
		} else {
			return \Pages::find($id);
		}
	}

	/**
	 *
	 */
	public function findByIdWithLangId($id, $lang_id)
	{
		return \Langs::find($lang_id)->pages()->find($id);
	}

	/**
	 *
	 */
	public function findForParent($exlude_id, $lang_id)
	{
		$result   = array();
		$result[] = '---';

		if (!$exlude_id) {
			$pages  = \Langs::find($lang_id)->pages()->get();
		} else {
			$pages  = \Langs::find($lang_id)->pages()->where('id', '!=', $exlude_id)->get();
		}

		foreach ($pages as $page) {
			$result[$page->id] = $page->title;
		}

		return $result;
	}

	/**
	 *
	 */
	public function findAll($lang_code = 'uk')
	{
		return \Langs::where('code', '=', $lang_code)->first()->pages()->paginate(\Config::get('app.pagination', 10));
	}

	/**
	 *
	 */
	public function findBySlug($slug)
	{
		return false;
	}

	/**
	 *
	 */
	public function create(array $data, $id = null)
	{
		if (!$this->validator->setId($id)->with($data)->passes()) {
			return false;
		}

		if ($id) {
			$this->model->id = $id;
		}

		if ($data['parent_id'] == 0) {
			$data['parent_id'] = null;
		}

		$this->model->lang_id = $data['lang_id'];
		$this->model->parent_id = $data['parent_id'];
		$this->model->title = $data['title'];
		$this->model->slug = $data['slug'];
		$this->model->body = $data['body'];
		$this->model->is_active = $data['is_active'];
		$this->model->time_add = time();

		if ($this->model->save()) {
			$this->updateCommonFields($data, $this->model->id);
			$this->createHiddenRecord($this->model->toArray(), $this->model->id);
			return true;
		}

		return false;
	}

	/**
	 *
	 */
	public function update(array $data, $id)
	{
		if (!$this->validator->setId($id)->with($data)->passes()) {
			return false;
		}

		if ($this->model = $this->findByIdWithLangId($id, $data['lang_id'])) {
			$updated['title'] = $data['title'];
			$updated['slug'] = $data['slug'];
			$updated['body'] = $data['body'];
			$updated['is_active'] = $data['is_active'];

			if (\DB::table('pages')->where('id', $id)
					->where('lang_id', $data['lang_id'])
					->update($updated)) {
				$this->updateCommonFields($data, $id);
			}

			return true;
		}

		return false;
	}

	/**
	 *
	 */
	public function delete($id)
	{
		if ($page = $this->findById($id)) {
			$page->delete();
			return true;
		}

		return false;
	}

	/**
	 * create record with hidden language id
	 */
	public function createHiddenRecord($data, $id)
	{
		$hiddenLangId = \Langs::hiddenId();

		if (!$rubric = $this->findByIdWithLangId($id, $hiddenLangId)) {
			$data['id'] = $id;
			$data['lang_id'] = $hiddenLangId;

			\DB::table('pages')->insert($data);
		}
	}

	/**
	 * update fields, common for all languages
	 */
	public function updateCommonFields($data, $id)
	{
		$updated['slug'] = $data['slug'];
		$updated['is_active'] = $data['is_active'];

		\DB::table('pages')->where('id', $id)->update($updated);
	}

	/**
	 *
	 */
	public function getValidationErrors()
	{
		return $this->validator->errors();
	}
}
