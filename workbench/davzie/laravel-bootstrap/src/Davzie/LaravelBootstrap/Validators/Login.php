<?php namespace Davzie\LaravelBootstrap\Validators;
use Davzie\LaravelBootstrap\Abstracts\ValidatorBase;

class Login extends ValidatorBase
{

    protected $rules = array(
        'email'         =>  'required|email',
        'password'      =>  'required'
    );

    protected $messages = array(
		'email.email'       => 'Введіть правильну email-адресу',
		'email.required'    => 'Введіть email-адресу',
		'password.required' => 'Введіть пароль',
    );

}
