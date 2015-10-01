<?php namespace Davzie\LaravelBootstrap\Roles;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Roles extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'roles';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('name', 'key', 'permissions');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'name'   => 'required',
        'key'    => 'required|regex:/^[a-z0-9]+$/',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'name.required' => 'Поле Назва обовязкове для заповнення',
        'key.required'  => 'Поле Ключ обовязкове для заповнення',
        'key.regex'     => 'Допустимі значення поля Ключ a-z0-9'
    ];

}
