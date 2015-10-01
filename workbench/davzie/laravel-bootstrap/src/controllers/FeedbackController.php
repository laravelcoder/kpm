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
        } elseif ($type == 'checked') {
            $items = $this->model->getChecked();
        } else {
            $items = $this->model->getAll();
        }
            \View::share('items', $items);

        return \View::make('laravel-bootstrap::'.$this->view_key.'.index')
                        ->with('type', $type);
    }

    /**
     *
     */
    public function getView($id)
    {
        if (!$item = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        $item->is_checked = 1;
        $item->save();

        return parent::getView($id);
    }
}
