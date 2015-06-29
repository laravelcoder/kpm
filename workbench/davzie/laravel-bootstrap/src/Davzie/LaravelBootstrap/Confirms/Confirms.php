<?php namespace Davzie\LaravelBootstrap\Confirms;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Confirms extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'confirms';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('email', 'code', 'roles', 'id');

    /**
     *
     */
    protected $common_fields = array();

    /**
     * Validation rules
     */
    protected $validationRules = [
        'email' => 'required|email|unique:confirms,email|unique:users,email',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'email.required' => 'Поле email обовязкове для заповнення',
        'email.email' => 'Поле email має бути правильною ел. адресою',
        'email.unique' => 'Ця електронна адреса вже використовується',
    ];

    /**
     * Fill the model up like we usually do but also allow us to fill some custom stuff
     * @param  array $array The array of data, this is usually Input::all();
     * @return void
     */
    public function fill(array $attributes)
    {
        parent::fill($attributes);

        if (!$this->roles) {
            $this->roles = [];
        }

        $this->roles = serialize($this->roles);

        return $this;
    }

}
