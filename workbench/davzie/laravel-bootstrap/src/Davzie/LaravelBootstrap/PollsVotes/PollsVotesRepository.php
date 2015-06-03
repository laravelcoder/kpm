<?php namespace Davzie\LaravelBootstrap\PollsVotes;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\PollsVotes\PollsVotes;
use Davzie\LaravelBootstrap\Departments\Departments;

class PollsVotesRepository extends EloquentBaseRepository implements PollsVotesInterface
{

    /**
     * Construct Shit
     * @param PollsVotes $model
     */
    public function __construct(PollsVotes $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

}
