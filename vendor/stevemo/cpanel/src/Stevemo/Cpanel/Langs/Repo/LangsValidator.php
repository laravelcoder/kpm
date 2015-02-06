<?php  namespace Stevemo\Cpanel\Langs\Repo;

use Stevemo\Cpanel\Services\Validation\AbstractValidator;

class LangsValidator extends AbstractValidator {

	/**
	 * Validation rules
	 *
	 * @var Array
	 */
	protected $rules = array(
		'name'       => array('required'),
		'code'       => array('required', 'regex:~^[a-z]{2}$~'),
		'is_default' => array('alpha_num', 'regex:~(0|1)~'),
	);

	/**
	 *
	 */
	protected $messages = array(
		'required' => 'Поле :attribute є обовязковим для заповнення',
		'code.regex' => 'Неправильно заповене поле Код',
		'is_default.regex' => 'Неправильно заповене поле Мова за замочуванням'
	);

}
