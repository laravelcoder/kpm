<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Feedback\FeedbackInterface;

class FeedbackController extends ObjectBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'feedback';

    /**
     * Construct Shit
     */
    public function __construct(FeedbackInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     *
     */
    public function getIndex($type = 'all')
    {
        parent::getIndex();

        if ($type == 'unchecked') {
            $items = $this->model->getUnchecked();
            \View::share('items', $items);
        } elseif ($type == 'checked') {
            $items = $this->model->getChecked();
            \View::share('items', $items);
        }

        return \View::make('laravel-bootstrap::'.$this->view_key.'.index')
                        ->with('type', $type);
    }
}
