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
        $lang       = $this->lang_model->defaultLang();
        $hidden     = $this->lang_model->getHidden();
        $exists_ids = $this->model->where('lang_id', $lang->id)->lists('id');

        if (empty($exists_ids)) {
            $items  = $this->model->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        } else {
            $items = $this->model->where('lang_id', $lang->id)->orWhereNotIn('id', $exists_ids)->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        }

        foreach ($items as &$item) {
    		$item->thumbs = $this->storage_model->getThumbs($item->photo);
    	}

    	return $items;
    }

}
