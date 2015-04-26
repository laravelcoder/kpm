<?php namespace Davzie\LaravelBootstrap\Rubrics;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Rubrics\Rubrics;

class RubricsRepository extends EloquentBaseRepository implements RubricsInterface
{

    /**
     * Construct Shit
     * @param Rubrics $model
     */
    public function __construct(Rubrics $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     *
     */
    public function getAll()
    {
    	$lang = $this->lang_model->defaultLang();
    	return $this->model->where('lang_id', '=', $lang->id)->paginate(\Config::get('app.limit'));
    }

}
