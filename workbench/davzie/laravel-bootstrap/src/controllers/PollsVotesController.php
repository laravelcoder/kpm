<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\PollsVotes\PollsVotesInterface;

class PollsVotesController extends ObjectBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'pollsvotes';

    /**
     * Construct Shit
     */
    public function __construct(PollsVotesInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }
}
