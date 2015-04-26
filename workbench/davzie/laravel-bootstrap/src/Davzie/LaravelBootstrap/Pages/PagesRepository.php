<?php namespace Davzie\LaravelBootstrap\Pages;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Pages\Pages;

class PagesRepository extends EloquentBaseRepository implements PagesInterface
{

    /**
     * Construct Shit
     * @param Pages $model
     */
    public function __construct(Pages $model)
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
