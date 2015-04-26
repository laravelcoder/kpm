<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\News\NewsInterface;

class NewsController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'news';

    /**
     * Construct Shit
     */
    public function __construct( NewsInterface $news )
    {
        $this->model = $news;
        parent::__construct();
    }

}