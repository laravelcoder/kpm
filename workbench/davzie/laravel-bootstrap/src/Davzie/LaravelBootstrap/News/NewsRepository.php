<?php namespace Davzie\LaravelBootstrap\News;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\News\News;
use Input, Config;

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
        $this->rubrics_model = \App::make('Davzie\LaravelBootstrap\Rubrics\RubricsInterface');
    }

    /**
     * get all news with pagination
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

    /**
     * save relations with other tables
     */
    public function saveRelations($id)
    {
        $rubrics = Input::get('rubrics', []);

        $this->model->id = $id;
        $this->model->rubrics()->detach();
        $this->model->rubrics()->sync($rubrics);;
    }

    /**
     * update relations with other tables
     */
    public function updateRelations($id)
    {
        $rubrics = Input::get('rubrics', []);

        $this->model->id = $id;
        $this->model->rubrics()->detach();
        $this->model->rubrics()->sync($rubrics);
    }

    /**
     * get rubrics for html select
     */
    public function rubrics()
    {
        return $this->rubrics_model->getList();
    }

}
