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
    protected $fillable = array('name', 'surname', 'last_name', 'department_id', 'graduate', 'about');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'name'           => 'required',
        'surname'        => 'required',
        'last_name'      => 'required',
        'department_id'  => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
        'name.required'          => 'Поле Ім`я обовязкове для заповнення',
        'surname.required'       => 'Поле Прізвище обовязкове для заповнення',
        'last_name.required'     => 'Поле По-батькові обовязкове для заповнення',
        'department_id.required' => 'Поле Кафедра обовязкове для заповнення'
    ];

    /**
     *
     */
    public function department()
    {
        return $this->belongsTo('Davzie\LaravelBootstrap\Departments\Departments', 'department_id', 'id');
    }

    /**
     *
     */
    public function subjects()
    {
        return $this->hasMany('Davzie\LaravelBootstrap\Subjects\Subjects', 'subject_id', 'id');
    }

}
