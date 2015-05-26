<?php namespace Davzie\LaravelBootstrap\Pages;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Pages\Pages;
use App;

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
     * get paginate list in default lang
     */
    public function getAll()
    {
    	$lang       = $this->lang_model->defaultLang();
        $hidden     = $this->lang_model->getHidden();
        $exists_ids = $this->model->where('lang_id', $lang->id)->lists('id');

        if (empty($exists_ids)) {
            return  $this->model->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        } else {
            return $this->model->where('lang_id', $lang->id)->orWhereNotIn('id', $exists_ids)->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        }
    }

    /**
     * get items with parent_id
     */
    public function getItems($id = null)
    {
        $lang       = $this->lang_model->defaultLang();
        $hidden     = $this->lang_model->getHidden();
        $exists_ids = $this->model->where('lang_id', $lang->id)->where('parent_id', $id)->lists('id');

        if (empty($exists_ids)) {
            return  $this->model->where('lang_id', $hidden->id)->where('parent_id', $id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        } else {
            return $this->model->where('lang_id', $lang->id)->where('parent_id', $id)->orWhere(function ($query) use ($hidden, $exists_ids) {
                $query->where('lang_id', $hidden->lang_id)->whereNotIn('id', $exists_ids);
            })->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        }
    }

    /**
     * get list of pages for selecting parent page
     *
     * @param mixed $excluded
     * @return mixed
     */
    public function getList(array $excluded = [])
    {
        $lang     = $this->lang_model->defaultLang();
        $children = $this->getChild($excluded);
        $pages    = [];

        if (empty($excluded) && empty($children)) {
            $result = $this->model->where('lang_id', '=', $lang->id)->select('id', 'title')->get();
        } else {
            $ids = array_merge($excluded, $children);
            $result = $this->model->where('lang_id', '=', $lang->id)->whereNotIn('id', $ids)->select('id', 'title')->get();
        }

        foreach ($result as $page) {
            $pages[$page->id] = $page->title;
        }

        return $pages;
    }

    /**
     *
     */
    public function getChild(array $ids)
    {
        if (empty($ids)) {
            return [];
        }

        $children = $this->model->whereIn('parent_id', $ids)->groupBy('id')->lists('id');

        return $children + $this->getChild($children);
    }

    /**
     * get one item by slug (front)
     */
    public function getBySlug($slug)
    {
        $lang = $this->lang_model->getByCode(App::getLocale());
        $item = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->where('slug', $slug)->first();

        return $item;
    }

}
