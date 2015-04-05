<?php namespace Davzie\LaravelBootstrap\Settings;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Settings extends EloquentBaseModel
{
    public $timestamps = false;

    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'settings';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('label', 'key', 'value');

    protected $validationRules = [
        'label' => 'required',
        'key'   => 'required',
        'value' => 'required'
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'label.required' => 'Поле Назва обовязкове для заповнення',
        'key.required'   => 'Поле Ключ обовязкове для заповнення',
        'value.required' => 'Поле Значення обовязкове для заповнення',
    ];

}
