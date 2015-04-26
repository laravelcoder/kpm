<?php namespace Davzie\LaravelBootstrap\Feedback;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Feedback extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'feedback';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('subject', 'email', 'from', 'body', 'time_created', 'is_checked');

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

    /**
     *
     */
    public function getChecked()
    {
        return $this->where('is_checked', '=', 1);
    }

    /**
     *
     */
    public function getUnchecked()
    {
        return $this->where('is_checked', '=', 0);
    }

}
