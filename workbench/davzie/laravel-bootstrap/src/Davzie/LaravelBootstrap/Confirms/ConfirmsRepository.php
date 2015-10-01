<?php namespace Davzie\LaravelBootstrap\Confirms;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Confirms\Confirms;

class ConfirmsRepository extends EloquentBaseRepository implements ConfirmsInterface
{

    /**
     * Construct Shit
     * @param Confirms $model
     */
    public function __construct(Confirms $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     * get confirmation by unique code
     *
     * @param string $code
     * @return Eloquent
     */
    public function getByCode($code)
    {
    	return $this->model->where('code', $code)->first();
    }

    /**
     * delete confirmation by code
     *
     * @param string $code
     */
    public function deleteByCode($code)
    {
    	return $this->model->where('code', $code)->delete();
    }
}
