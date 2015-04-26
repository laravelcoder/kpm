<?php namespace Davzie\LaravelBootstrap\News;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\News\News;
use Davzie\LaravelBootstrap\Departments\Departments;

class NewsRepository extends EloquentBaseRepository implements NewsInterface
{

    /**
     * Construct Shit
     * @param News $model
     */
    public function __construct(News $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     *
     */
    public function getAll()
    {
    	$lang  = $this->lang_model->defaultLang();
    	$items = $this->model->where('lang_id', '=', $lang->id)->paginate(\Config::get('app.limit'));

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo ? $item->photo->hashname : '');
        }

        return $items;
    }

}
