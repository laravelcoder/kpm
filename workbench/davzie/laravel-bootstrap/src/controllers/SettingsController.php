<?php namespace Davzie\LaravelBootstrap\Controllers;
use Illuminate\Support\MessageBag;
use Davzie\LaravelBootstrap\Settings\SettingsInterface;
use Input, Redirect;

class SettingsController extends ObjectBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'settings';

    /**
     * Construct Shit
     */
    public function __construct( SettingsInterface $settings )
    {
        $this->model = $settings;
        parent::__construct();
    }

}