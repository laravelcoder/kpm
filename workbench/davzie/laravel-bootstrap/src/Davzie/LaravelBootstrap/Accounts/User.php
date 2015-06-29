<?php namespace Davzie\LaravelBootstrap\Accounts;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;
use Illuminate\Auth\UserInterface as LaravelUserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Hash;

class User extends EloquentBaseModel implements LaravelUserInterface, RemindableInterface
{
    public $timestamps = false;
    // The Tables
    protected $table    = 'users';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password');

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('first_name', 'last_name', 'email', 'password', 'is_active');

    protected $validationRules = [
        'first_name'    => array('required'),
        'last_name'   => array('required'),
        'email'       => array('required', 'email', 'unique:users,email,<id>,id'),
        'password'    => array('required', 'confirmed', 'min:5'),
        'is_active'   => array('regex:/(0|1)$/'),
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'first_name.required' => 'Поле Імя обовязкове для заповнення',
        'last_name.required'  => 'Поле Прізвище обовязкове для заповнення',
        'password.required'  => 'Поле Пароль обовязкове для заповнення',
        'email.required'      => 'Поле Емейл обовязкове для заповнення',
        'email.email'         => 'Введене неправильний email',
        'password.confirmed'  => 'Введено неправильне підтвердження пароля',
        'password.min'        => 'Мінімальна довжина пароля 5 символів',
        'is_active.regex'     => 'Неправильно заповнене поле Активний',
    ];

    /**
     * Get the unique identifier for the user.
     *
     * @return mixed
     */
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Get the full name of the user
     * @return string
     */
    public function getFullNameAttribute(){
        return $this->first_name.' '.$this->last_name;
    }

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->password;
    }

    /**
     * Get the e-mail address where password reminders are sent.
     *
     * @return string
     */
    public function getReminderEmail()
    {
        return $this->email;
    }

    /**
     * Set the password, lets automatically hash it
     * @param string $value The password (unhashed)
     */
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make( $value );
    }

    public function getRememberToken()
    {
        return $this->remember_token;
    }

    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    /**
     * roles relationship
     */
    public function roles()
    {
        return $this->belongsToMany('Davzie\LaravelBootstrap\Roles\Roles', 'users_has_roles', 'user_id', 'role_id');
    }

}