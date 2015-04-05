<?php namespace Stevemo\Cpanel\Rubrics\Repo;

use Illuminate\Events\Dispatcher;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Stevemo\Cpanel\Rubrics\Repo\RubricsValidator;

/**
 *
 */
class RubricsRepository implements CpanelRubricsInterface {

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
	public function __construct(\Rubrics $model, Repository $config, RubricsValidator $validator)
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
			return \Langs::where('code', '=', $lang_code)->first()->rubrics()->find($id);
		} else {
			return \Rubrics::find($id);
		}
	}

	/**
	 *
	 */
	public function findByIdWithLangId($id, $lang_id)
	{
		return \Langs::find($lang_id)->rubrics()->find($id);
	}

	/**
	 *
	 */
	public function findAll($lang_code = 'uk')
	{
		return \Langs::where('code', '=', $lang_code)->first()->rubrics()->paginate(\Config::get('app.pagination', 10));
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

		$this->model->lang_id = $data['lang_id'];
		$this->model->title = $data['title'];
		$this->model->slug = $data['slug'];
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
			$updated['is_active'] = $data['is_active'];

			if (\DB::table('rubrics')->where('id', $id)
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
		if ($rubric = $this->findById($id)) {
			$rubric->delete();
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

			\DB::table('rubrics')->insert($data);
		}
	}

	/**
	 * update fields, common for all languages
	 */
	public function updateCommonFields($data, $id)
	{
		$updated['slug'] = $data['slug'];
		$updated['is_active'] = $data['is_active'];

		\DB::table('rubrics')->where('id', $id)->update($updated);
	}

	/**
	 *
	 */
	public function getValidationErrors()
	{
		return $this->validator->errors();
	}
}
