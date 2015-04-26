<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Pages\PagesInterface;

class PagesController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'pages';

    /**
     * Construct Shit
     */
    public function __construct( PagesInterface $pages )
    {
        $this->model = $pages;
        parent::__construct();
    }

}