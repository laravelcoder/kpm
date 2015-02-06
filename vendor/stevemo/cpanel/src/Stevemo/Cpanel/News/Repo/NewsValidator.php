<?php  namespace Stevemo\Cpanel\News\Repo;

use Stevemo\Cpanel\Services\Validation\AbstractValidator;

class NewsValidator extends AbstractValidator {

	/**
	 * Validation rules
	 *
	 * @var Array
	 */
	protected $rules = array(
		'title'     => 'required',
		'slug'      => 'required|regex:~^[a-z0-9\-]+$~',
		'descr'     => 'required',
		'body'      => 'required',
		'is_active' => 'regex:~^(0|1)$~'
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
		'descr.required'  => 'Поле Короткий опис обовязкове для заповнення',
		'body.required'   => 'Поле Текст обовязкове для заповнення',
		'is_active.regex' => 'Недопустиме значення поля Активна',
	);

}
