<?php namespace Davzie\LaravelBootstrap\Feedback;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Feedback\Feedback;
use Config;

class FeedbackRepository extends EloquentBaseRepository implements FeedbackInterface
{

    /**
     * Construct Shit
     * @param Feedback $model
     */
    public function __construct(Feedback $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     *
     */
    public function getChecked()
    {
    	return $this->model->getChecked()->paginate(Config::get('app.limit'));
    }

    /**
     *
     */
    public function getUnchecked()
    {
    	return $this->model->getUnchecked()->paginate(Config::get('app.limit'));
    }

}
