<?php namespace Davzie\LaravelBootstrap\Rubrics;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Rubrics extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'rubrics';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('title', 'slug', 'is_active', 'lang_id', 'time_add', 'id');

    /**
     *
     */
    protected $common_fields = array('slug', 'is_active');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title' => 'required',
        'slug'  => 'required|regex:/^[a-z0-9\-]+$/|unique:rubrics,slug,<id>,id',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required' => 'Поле Назва обовязкове для заповнення',
        'slug.required' => 'Поле Аліас обовязкове для заповнення',
        'slug.regex'    => 'Введено недопустимі символи в полі Аліас(допустимі a-z0-9\-)',
        'slug.unique'   => 'Введене значення поля Аліас вже існує, введіть інше значення'
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);
        if ($this->exists != false) {
            $this->time_add = time();
        }

        return $this;
    }

    /**
     *
     */
    public function news()
    {
        return $this->belongsToMany('Davzie\LaravelBootstrap\News\News', 'news_has_rubrics', 'rubric_id', 'new_id')->where('news.lang_id', $this->lang_id);
    }

}
