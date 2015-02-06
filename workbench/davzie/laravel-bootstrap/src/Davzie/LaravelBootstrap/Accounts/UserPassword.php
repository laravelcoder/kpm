<?php namespace Davzie\LaravelBootstrap\Accounts;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class UserPassword extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'users';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('password');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'password'    => array('confirmed', 'min:5', 'required'),
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'password.required'  => 'Поле Пароль обовязкове для заповнення',
        'password.confirmed'  => 'Введено неправильне підтвердження пароля',
        'password.min'        => 'Мінімальна довжина пароля 5 символів',
    ];

    /**
     * Set the password, lets automatically hash it
     * @param string $value The password (unhashed)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = \Hash::make( $value );
    }

}
