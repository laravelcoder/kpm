<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Adverts\AdvertsInterface;

class AdvertsController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'adverts';

    /**
     * Construct Shit
     */
    public function __construct(AdvertsInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
