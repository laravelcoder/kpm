<?php namespace Davzie\LaravelBootstrap\Views;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Views\Views;
use Davzie\LaravelBootstrap\Departments\Departments;

class ViewsRepository extends EloquentBaseRepository implements ViewsInterface
{

    /**
     * Construct Shit
     * @param Views $model
     */
    public function __construct(Views $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

}
