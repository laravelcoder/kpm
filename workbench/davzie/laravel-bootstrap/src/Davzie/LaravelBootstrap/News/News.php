<?php namespace Davzie\LaravelBootstrap\News;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class News extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'news';

    // protected $primaryKey = ['id', 'lang_id'];

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('title', 'slug', 'is_active', 'lang_id', 'time_created', 'time_publish', 'id', 'body', 'descr', 'meta_descr', 'meta_keywords', 'photo_storage_id');

    /**
     *
     */
    protected $common_fields = array('slug', 'is_active', 'time_publish', 'photo_storage_id');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title'        => 'required',
        'descr'        => 'required',
        'body'         => 'required',
        'time_publish' => 'required',
        'slug'         => 'required|regex:/^[a-z0-9\-]+$/|unique:rubrics,slug,<id>,id',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required' => 'Поле Назва обовязкове для заповнення',
        'descr.required' => 'Поле Короткий опис обовязкове для заповнення',
        'body.required' => 'Поле Контент обовязкове для заповнення',
        'time_publish.required' => 'Поле Час публікації обовязкове для заповнення',
        'slug.required'  => 'Поле Аліас обовязкове для заповнення',
        'slug.regex'     => 'Введено недопустимі символи в полі Аліас(допустимі a-z0-9\-)',
        'slug.unique'    => 'Введене значення поля Аліас вже існує, введіть інше значення'
    ];

    /**
     *
     */
    public function setTimePublishAttribute($value)
    {
        $this->attributes['time_publish'] = strtotime($value);
    }

    /**
     *
     */
    public function setTimeCreatedAttribute($value)
    {
        if ($this->exists == true) {
            unset($this->attributes['time_created']);
        } else {
            $this->attributes['time_created'] = $value;
        }
    }

    /**
     *
     */
    public function getTimePublishAttribute()
    {
        return date('d-m-Y, H:i:s',$this->attributes['time_publish']);
    }

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if ($this->exists != false) {
            $this->time_created = time();
        }

        if (!isset($attributes['photo_storage_id']) || empty($attributes['photo_storage_id'])) {
            $this->photo_storage_id = NULL;
        }

        return $this;
    }

    /**
     *
     */
    public function langs()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\Langs\Langs', 'lang_id', 'id');
    }

    /**
     *
     */
    public function photo()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\Storage\Storage', 'photo_storage_id', 'id');
    }

}
