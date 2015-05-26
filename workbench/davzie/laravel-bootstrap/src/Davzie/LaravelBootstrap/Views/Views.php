<?php namespace Davzie\LaravelBootstrap\Views;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Views extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'views';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('new_id', 'ip');

    /**
     *
     */
    protected $common_fields = array();

    /**
     * Validation rules
     */
    protected $validationRules = [
    ];

    /**
     * Validation messages
     */
    protected $messages = [
    ];

}
