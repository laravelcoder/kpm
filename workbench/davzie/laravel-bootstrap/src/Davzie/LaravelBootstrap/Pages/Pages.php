<?php namespace Davzie\LaravelBootstrap\Pages;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Pages extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'pages';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('lang_id', 'parent_id', 'title', 'body', 'is_active', 'slug', 'time_add', 'id', 'is_visible');

    /**
     *
     */
    protected $common_fields = array('slug', 'is_active', 'parent_id');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title' => 'required',
        'body'  => 'required',
        'slug'  => 'required|regex:/^[a-z0-9\-]+$/|unique:pages,slug,<id>,id',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required'  => 'Поле Назва обовязкове для заповнення',
        'body.required'   => 'Поле Контент обовязкове для заповнення',
        'slug.required'   => 'Поле Аліас обовязкове для заповнення',
        'slug.regex'      => 'Введено недопустимі символи в полі Аліас(допустимі a-z0-9\-)',
        'slug.unique'     => 'Введене значення поля Аліас вже існує, введіть інше значення',
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (!$this->exists) {
            $this->time_add = time();
        }

        if (empty($this->parent_id)) {
            $this->parent_id = null;
        }
    }

    /**
     *
     */
    public function sub()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\Pages\Pages', 'parent_id', 'id')->where('lang_id', $this->lang_id)->where('is_active', 1)->where('is_visible', 1);
    }

}
