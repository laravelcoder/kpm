<?php namespace Davzie\LaravelBootstrap\Adverts;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Adverts extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'adverts';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('title', 'is_active', 'lang_id', 'time_created', 'id', 'time_start', 'time_end', 'body', 'descr', 'photo_storage_id', 'meta_descr', 'meta_keywords');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title'      => 'required',
        'body'       => 'required',
        'descr'      => 'required',
        'time_start' => 'required',
        'time_end'   => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required'      => 'Поле Назва обовязкове для заповнення',
        'body.required'       => 'Поле Контент обовязкове для заповнення',
        'descr.required'      => 'Поле Опис обовязкове для заповнення',
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
        // $this->slug = Str::slug( $this->title , '-' );
        if ($this->exists == false) {
            $this->attributes['time_created'] = time();
        }

        if (!isset($attributes['photo_storage_id']) || empty($attributes['photo_storage_id'])) {
            $this->photo_storage_id = NULL;
        }
    }

    /**
     *
     */
    public function setTimeStartAttribute($value)
    {
        $this->attributes['time_start'] = strtotime($value);
    }

    /**
     *
     */
    public function getTimeStartAttribute()
    {
        return date('d.m.Y, H:i',$this->attributes['time_start']);
    }

    /**
     *
     */
    public function setTimeEndAttribute($value)
    {
        $this->attributes['time_end'] = strtotime($value);
    }

    /**
     *
     */
    public function getTimeEndAttribute()
    {
        return date('d.m.Y, H:i',$this->attributes['time_end']);
    }

    /**
     *
     */
    public function photo()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\Storage\Storage', 'photo_storage_id', 'id');
    }

}
