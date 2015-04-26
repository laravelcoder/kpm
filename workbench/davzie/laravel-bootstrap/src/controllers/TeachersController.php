<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Teachers\TeachersInterface;

class TeachersController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'teachers';

    /**
     * Construct Shit
     */
    public function __construct(TeachersInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
