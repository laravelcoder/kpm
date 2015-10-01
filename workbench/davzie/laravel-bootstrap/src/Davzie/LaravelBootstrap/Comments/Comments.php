<?php namespace Davzie\LaravelBootstrap\Comments;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Comments extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'comments';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('id', 'new_id', 'name', 'text', 'time_add', 'is_active');

    /**
     *
     */
    protected $common_fields = array();

    /**
     * Validation rules
     */
    protected $validationRules = [
        'name' => 'required',
        'text' => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'name.required' => 'Поле Ім`я обовязкове для заповнення',
        'text.required' => 'Поле Коментар обовязкове для заповнення',
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (isset($attributes['time_add'])) {
            $this->time_add = strtotime($attributes['time_add']);
        }

        return $this;
    }

    /**
     *
     */
    public function cnew()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\News\News', 'new_id', 'id');
    }

}
