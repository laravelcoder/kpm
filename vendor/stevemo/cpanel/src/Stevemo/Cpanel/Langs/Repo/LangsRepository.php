<?php namespace Stevemo\Cpanel\Langs\Repo;

use Illuminate\Events\Dispatcher;
use Illuminate\Config\Repository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Stevemo\Cpanel\Langs\Repo\LangsValidator;

/**
 *
 */
class LangsRepository implements CpanelLangsInterface {

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
	protected $fields = array('name', 'code', 'id', 'is_default');

	/**
	 *
	 */
	public function __construct(\Langs $model, Repository $config, LangsValidator $validator)
	{
		$this->model = $model;
		$this->config = $config;
		$this->validator = $validator;
	}

	/**
	 *
	 */
	public function findById($id)
	{
		return $this->model->where('name', '!=', 'Default')->find($id);
	}

	/**
	 *
	 */
	public function findAll()
	{
		return $this->model->where('name', '!=', 'Default')->get();
	}

	/**
	 *
	 */
	public function create(array $data)
	{
		if (!$this->validator->with($data)->passes()) {
			return false;
		}

		foreach ($data as $key => $value) {
			if (in_array($key, $this->fields)) {
				$this->model->$key = $value;
			}
		}

		if ($this->model->is_default == 1) {
			\Langs::where('name', '!=', 'Default')->update(array('is_default' => 0));
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

		if ($lang = $this->findById($id)) {
			$lang->name       = $data['name'];
			$lang->code       = $data['code'];
			$lang->is_default = $data['is_default'];

			if ($lang->is_default == 1) {
				\Langs::where('name', '!=', 'Default')->update(array('is_default' => 0));
			}

			$lang->save();
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
