<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\PollsAnswers\PollsAnswersInterface;
use View, App, Input;

class PollsAnswersController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'polls-answers';

    /**
     * Construct Shit
     */
    public function __construct(PollsAnswersInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     *
     */
    public function getIndex($id = null)
    {
        if (!$poll = $this->model->getPoll($id)) {
            return App::abort(404);
        }

        View::share('poll', $poll);

        return View::make('laravel-bootstrap::'.$this->view_key.'.index');
    }

    /**
     *
     */
    public function getNew($lang_code = null, $id = null)
    {
        $poll_id = Input::get('poll_id', false);

        if (!$poll_id) {
            return App::abort(404);
        }

        if (!$poll = $this->model->getPoll($poll_id)) {
            return App::abort(404);
        }

        View::share('poll', $poll);

        return parent::getNew($lang_code, $id);
    }

    /**
     * sort menu items
     */
    public function postSort()
    {
        //
        $this->model->saveItems(Input::get('sort', []));

        return ['success' => 1];
    }
}
