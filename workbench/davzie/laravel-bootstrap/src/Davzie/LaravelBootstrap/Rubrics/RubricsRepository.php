<?php namespace Davzie\LaravelBootstrap\Rubrics;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Rubrics\Rubrics;
use App;

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
     * get all rubrics for admin side
     */
    public function getAll()
    {
    	$lang       = $this->lang_model->defaultLang();
        $hidden     = $this->lang_model->getHidden();
        $exists_ids = $this->model->where('lang_id', $lang->id)->lists('id');

        if (empty($exists_ids)) {
            return $this->model->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        } else {
            return $this->model->where('lang_id', $lang->id)->orWhereNotIn('id', $exists_ids)->where('lang_id', $hidden->id)->orderBy('id', 'DESC')->groupBy('id')->paginate(\Config::get('app.limit'));
        }
    }

    /**
     * get front rubrics list
     */
    public function frontList()
    {
        $lang = $this->lang_model->getByCode(App::getLocale());
        return $this->model->where('lang_id', '=', $lang->id)->where('is_active', 1)->get();
    }

    /**
     * get rubrics list for html select
     */
    public function getList()
    {
        $lang = $this->lang_model->defaultLang();
        $rubrics = $this->model->where('lang_id', '=', $lang->id)->get();
        $list = [];

        foreach ($rubrics as $rubric) {
            $list[$rubric->id] = $rubric->title;
        }

        return $list;
    }

}
