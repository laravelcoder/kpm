<?php namespace Davzie\LaravelBootstrap\Links;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Links extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'links';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('id', 'lang_id', 'title', 'link', 'is_active');

    /**
     *
     */
    protected $common_fields = array('link', 'is_active');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title' => 'required',
        'link'  => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required' => 'Поле Назва обовязкове для заповнення',
        'link.required'  => 'Поле Посилання обовязкове для заповнення',
    ];

}
