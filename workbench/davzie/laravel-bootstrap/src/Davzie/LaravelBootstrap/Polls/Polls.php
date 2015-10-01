<?php namespace Davzie\LaravelBootstrap\Polls;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Polls extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table   = 'polls';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('id', 'lang_id', 'title', 'time_start', 'time_end', 'is_active');

    /**
     *
     */
    protected $common_fields = array('time_start', 'time_end', 'is_active');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title'      => 'required',
        'time_start' => 'required',
        'time_end'   => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required'      => 'Поле Назва обовязкове для заповнення',
        'time_start.required' => 'Поле Дата початку обовязкове для заповнення',
        'time_end.required'   => 'Поле Дата завершення обовязкове для заповнення',
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (isset($attributes['time_start'])) {
            $this->time_start = strtotime($attributes['time_start']);
        }

        if (isset($attributes['time_end'])) {
            $this->time_end   = strtotime($attributes['time_end']);
        }

        return $this;
    }

    /**
     *
     */
    public function answers()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\PollsAnswers\PollsAnswers', 'poll_id', 'id')->where('polls_answers.lang_id', $this->lang_id)->orderBy('order');
    }

    /**
     *
     */
    public function activeAnswers()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\PollsAnswers\PollsAnswers', 'poll_id', 'id')->where('polls_answers.lang_id', $this->lang_id)->where('polls_answers.is_active', 1)->orderBy('order');
    }

    /**
     *
     */
    public function voted()
    {
        foreach ($this->answers as $answer) {
            if ($answer->voted->first()) {
                return true;
            }
        }

        return false;
    }

}
