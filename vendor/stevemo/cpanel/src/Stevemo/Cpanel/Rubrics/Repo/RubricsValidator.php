<?php  namespace Stevemo\Cpanel\Rubrics\Repo;

use Stevemo\Cpanel\Services\Validation\AbstractValidator;

class RubricsValidator extends AbstractValidator {

	protected $id;
	/**
	 * Validation rules
	 *
	 * @var Array
	 */
	protected $rules = array(
		'title'     => array('required'),
		'slug'      => array('required', 'regex:~^[a-z0-9\-]+$~', 'unique:rubrics,slug'),
		'is_active' => array('regex:~^(0|1)$~'),
	);

	/**
	 * Error validation messages
	 *
	 * @var Array
	 */
	protected $messages = array(
		'title.required'  => 'Поле Назва обовязкове для заповнення',
		'slug.required'   => 'Поле Аліас обовязкове для заповнення',
		'slug.regex'      => 'Введено недопустимі символи в полі Аліас(допустимі a-z0-9\-)',
		'slug.unique'     => 'Введене значення поля Аліас вже існує, введіть інше значення',
		'is_active.regex' => 'Недопустиме значення поля Активна',
	);

	/**
	 *
	 */
	public function setId($id = null)
	{
		if ($id) {
			$unique = end($this->rules['slug']);
			$unique .= ','.$id. ',id';
			$this->rules['slug'][2] = $unique;
		}

		return $this;
	}

}
