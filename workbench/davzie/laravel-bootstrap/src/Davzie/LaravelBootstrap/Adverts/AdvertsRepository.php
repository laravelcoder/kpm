<?php namespace Davzie\LaravelBootstrap\Adverts;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Adverts\Adverts;
use Davzie\LaravelBootstrap\Departments\Departments;

class AdvertsRepository extends EloquentBaseRepository implements AdvertsInterface
{

    /**
     * Construct Shit
     * @param Adverts $model
     */
    public function __construct(Adverts $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     * Get everything (active only)
     * @return Eloquent
     */
    public function getAll()
    {
        $lang = $this->lang_model->defaultLang();
        $items = $this->model->where('lang_id', '=', $lang->id)->paginate(\Config::get('app.limit'));

        foreach ($items as &$item) {
    		$item->thumbs = $this->storage_model->getThumbs($item->photo);
    	}

    	return $items;
    }

}
