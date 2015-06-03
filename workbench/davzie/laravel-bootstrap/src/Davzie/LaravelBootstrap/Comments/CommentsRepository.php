<?php namespace Davzie\LaravelBootstrap\Comments;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Comments\Comments;
use Davzie\LaravelBootstrap\Departments\Departments;

class CommentsRepository extends EloquentBaseRepository implements CommentsInterface
{

    /**
     * Construct Shit
     * @param Comments $model
     */
    public function __construct(Comments $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

}
