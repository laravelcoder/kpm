<?php namespace Davzie\LaravelBootstrap\Links;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Links\Links;
use Davzie\LaravelBootstrap\Departments\Departments;
use App;

class LinksRepository extends EloquentBaseRepository implements LinksInterface
{

    /**
     * Construct Shit
     * @param Links $model
     */
    public function __construct(Links $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     * get all links
     */
    public function getAll()
    {
        // get lang
    	$lang       = $this->lang_model->defaultLang();
        // get hidden lang
        $hidden     = $this->lang_model->getHidden();
        $exists_ids = $this->model->where('lang_id', $lang->id)->lists('id');

        if (empty($exists_ids)) {
            return $this->model->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        } else {
            return $this->model->where('lang_id', $lang->id)->orWhereNotIn('id', $exists_ids)->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        }
    }

    /**
     * get paginated list (front)
     */
    public function frontList()
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->get();

        return $items;
    }

}
