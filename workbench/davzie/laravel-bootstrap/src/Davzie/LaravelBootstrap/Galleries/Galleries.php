<?php namespace Davzie\LaravelBootstrap\Galleries;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Galleries extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'galleries';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('id', 'lang_id', 'photo_storage_id', 'title', 'descr', 'is_active');

    /**
     *
     */
    protected $common_fields = array('is_active', 'photo_storage_id');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title' => 'required'
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required' => 'Поля назва обовязкове для заповнення'
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

    /**
     *
     */
    public function photos()
    {
        return $this->belongsToMany('Davzie\LaravelBootstrap\Storage\Storage', 'galleries_photos', 'gallery_id', 'photo_storage_id');
    }

}
