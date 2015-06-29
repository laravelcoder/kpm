<?php namespace Davzie\LaravelBootstrap\Langs;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Langs extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'langs';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('name', 'code', 'is_default', 'is_active');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'name' => 'required',
        'code'  => 'required|regex:/^[a-z]+$/',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'name.required' => 'Поле Назва обовязкове для заповнення',
        'code.required' => 'Поле Код обовязкове для заповнення',
        'code.regex'    => 'Неправильне значення поля Код (допустимі символи a-z)',
    ];

}
