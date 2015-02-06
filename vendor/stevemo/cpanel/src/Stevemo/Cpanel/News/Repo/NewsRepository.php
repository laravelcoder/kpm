<?php namespace Stevemo\Cpanel\News\Repo;

use Illuminate\Events\Dispatcher;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Stevemo\Cpanel\News\Repo\NewsValidator;

/**
 *
 */
class NewsRepository implements CpanelNewsInterface {

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
	public function __construct(\News $model, Repository $config, NewsValidator $validator)
	{
		$this->model = $model;
		$this->config = $config;
		$this->validator = $validator;
	}

	/**
	 *
	 */
	public function findById($id, $lang_code)
	{
		return $this->model->find($id)->lang()->where('code', '=', $code)->first();
	}

	/**
	 *
	 */
	public function findAll($lang_code)
	{
		return $this->model->all()->lang()->where('code', '=', $code)->first();
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
	public function create(array $data)
	{
		if (!$this->validator->with($data)->passes()) {
			return false;
		}

		if ($this->model->save()) {
			return true;
		}

		return false;
	}

	/**
	 *
	 */
	public function update(array $data, $id)
	{
		if (!$this->validator->with($data)->passes()) {
			return false;
		}

		if ($new = $this->findById($id)) {
			// TODO
			// $lang->name       = $data['name'];
			// $lang->code       = $data['code'];
			// $lang->is_default = $data['is_default'];

			$new->save();
			return true;
		}

		return false;
	}

	/**
	 *
	 */
	public function delete($id)
	{
		if ($lang = $this->findById($id)) {
			$lang->delete();
			return true;
		}

		return false;
	}

	/**
	 *
	 */
	public function getValidationErrors()
	{
		return $this->validator->errors();
	}
}
