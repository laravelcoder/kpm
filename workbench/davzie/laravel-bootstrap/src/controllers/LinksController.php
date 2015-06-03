<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Links\LinksInterface;

class LinksController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'links';

    /**
     * Construct Shit
     */
    public function __construct(LinksInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
