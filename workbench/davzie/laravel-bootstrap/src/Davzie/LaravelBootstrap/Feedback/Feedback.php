<?php namespace Davzie\LaravelBootstrap\Feedback;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class Feedback extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'feedback';

    /**
     * These are the mass-assignable keys
     * @var array
     */
    protected $fillable = array('subject', 'email', 'from', 'body', 'time_created', 'is_checked');

    /**
     * Validation rules
     */
    protected $validationRules = [
        'subject' => 'required',
        'email'   => 'required|email',
        'from'    => 'required',
        'body'    => 'required',
    ];

    /**
     * Validation messages
     */
    protected $messages = [
    ];

    public function __construct()
    {
        parent::__construct();
        $this->messages['subject.required'] = _('Поле Тема обовязкове для заповнення');
        $this->messages['email.required'] = _('Поле Емейл обовязкове для заповнення');
        $this->messages['email.email'] = _('Поле Емейл має бути валідном email-адресою');
        $this->messages['from.required'] = _('Поле Імя обовязкове для заповнення');
        $this->messages['body.required'] = _('Поле Повідомлення обовязкове для заповнення');
    }

    /**
     *
     */
    public function getChecked()
    {
        return $this->where('is_checked', '=', 1);
    }

    /**
     *
     */
    public function getUnchecked()
    {
        return $this->where('is_checked', '=', 0);
    }

}
