<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Comments\CommentsInterface;

class CommentsController extends ObjectBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'comments';

    /**
     * Construct Shit
     */
    public function __construct(CommentsInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
