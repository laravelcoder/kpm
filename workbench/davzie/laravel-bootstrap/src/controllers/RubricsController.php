<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Rubrics\RubricsInterface;

class RubricsController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'rubrics';

    /**
     * Construct Shit
     */
    public function __construct( RubricsInterface $rubrics )
    {
        $this->model = $rubrics;
        parent::__construct();
    }

}