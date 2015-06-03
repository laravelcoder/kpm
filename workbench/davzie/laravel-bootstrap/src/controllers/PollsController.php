<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Polls\PollsInterface;

class PollsController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'polls';

    /**
     * Construct Shit
     */
    public function __construct(PollsInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
