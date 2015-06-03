<?php namespace Davzie\LaravelBootstrap\PollsVotes;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class PollsVotes extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'polls_votes';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('polls_answer_id', 'ip');

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
