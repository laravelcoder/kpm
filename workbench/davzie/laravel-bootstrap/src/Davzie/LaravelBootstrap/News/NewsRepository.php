<?php namespace Davzie\LaravelBootstrap\News;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\News\News;
use Input, Config, App;
use Request;

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

    /**
     * get paginated list (front)
     */
    public function frontList()
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->where('time_publish', '<=', time())->paginate(\Config::get('app.limit'));

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo);
        }

        return $items;
    }

    /**
     * get one item by slug (front)
     */
    public function getBySlug($slug)
    {
        $lang = $this->lang_model->getByCode(App::getLocale());
        $item = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->where('time_publish', '<=', time())->where('slug', $slug)->first();

        if (!$item) {
            return false;
        }

        $item->thumbs = $this->storage_model->getThumbs($item->photo);

        return $item;
    }

    /**
     *
     */
    public function changeViews($id)
    {
        $ip = Request::ip();

        if (!$item = $this->model->find($id)) {
            return false;
        }

        if (!$view = $item->views()->where('ip', $ip)->first()) {
            $item->views()->insert(['ip' => $ip, 'new_id' => $id]);
        }
    }

}
