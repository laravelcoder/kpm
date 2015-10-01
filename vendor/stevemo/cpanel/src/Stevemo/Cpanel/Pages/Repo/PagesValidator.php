<?php  namespace Stevemo\Cpanel\Pages\Repo;

use Stevemo\Cpanel\Services\Validation\AbstractValidator;

class PagesValidator extends AbstractValidator {

	protected $id;
	/**
	 * Validation rules
	 *
	 * @var Array
	 */
	protected $rules = array(
		'title'     => array('required'),
		'slug'      => array('required', 'regex:~^[a-z0-9\-]+$~', 'unique:pages,slug'),
		'parent_id' => array('regex:~^\d+$~'),
		'body'      => array('required'),
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
		'parent_id.regex' => 'Неправильно заповнене поле Батьківська сторінка',
		'body.required'   => 'Введіть контент сторінки',
		'is_active.regex' => 'Недопустиме значення поля Активна',
	);

	/**
	 * exclude id for checking slug
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
