<?php namespace Davzie\LaravelBootstrap\PollsAnswers;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;
use Request;

class PollsAnswers extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'polls_answers';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('id', 'lang_id', 'poll_id', 'title', 'is_active');

    /**
     *
     */
    protected $common_fields = array('poll_id', 'is_active');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title'      => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required'      => 'Поле Назва обовязкове для заповнення',
    ];

    /**
     *
     */
    public function votes()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\PollsVotes\PollsVotes', 'polls_answer_id', 'id');
    }

    /**
     *
     */
    public function voted()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\PollsVotes\PollsVotes', 'polls_answer_id', 'id')->where('ip', Request::ip());
    }

    /**
     *
     */
    public function poll()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\Polls\Polls');
    }

}
