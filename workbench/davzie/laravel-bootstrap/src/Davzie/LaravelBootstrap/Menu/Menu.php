<?php namespace Davzie\LaravelBootstrap\Menu;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Menu extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'menu';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('parent_id', 'title', 'link', 'order', 'lang_id', 'id');

    /**
     *
     */
    protected $common_fields = array('parent_id', 'link', 'order');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'title' => 'required',
        'link'  => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'title.required' => 'Поле Назва обовязкове для заповнення',
        'link.required'  => 'Поле Посилання обовязкове для заповнення',
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (empty($this->parent_id)) {
            $this->parent_id = null;
        }
    }

    /**
     *
     */
    public function items()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\Menu\Menu', 'parent_id', 'id')->where('lang_id', $this->lang_id)->orderBy('order');
    }

}
