<?php namespace Davzie\LaravelBootstrap\Teachers;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Teachers extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'teachers';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('name', 'surname', 'second_name', 'photo_storage_id', 'about', 'birthdate', 'is_active', 'id', 'lang_id');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'name'           => 'required',
        'surname'        => 'required',
        'second_name'      => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'name.required'          => 'Поле Ім`я обовязкове для заповнення',
        'surname.required'       => 'Поле Прізвище обовязкове для заповнення',
        'second_name.required'     => 'Поле По-батькові обовязкове для заповнення',
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (!isset($attributes['photo_storage_id']) || empty($attributes['photo_storage_id'])) {
            $this->photo_storage_id = NULL;
        }

        return $this;
    }

    /**
     *
     */
    public function setBirthdateAttribute($value)
    {
        $this->attributes['birthdate'] = strtotime($value);
    }

    /**
     *
     */
    public function getBirthdateAttribute()
    {
        return date('d.m.Y',$this->attributes['birthdate']);
    }

    /**
     *
     */
    public function photo()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\Storage\Storage', 'photo_storage_id', 'id');
    }
}
