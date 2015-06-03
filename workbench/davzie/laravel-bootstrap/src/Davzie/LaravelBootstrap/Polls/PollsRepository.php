<?php namespace Davzie\LaravelBootstrap\Polls;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Polls\Polls;
use Davzie\LaravelBootstrap\Departments\Departments;
use App;

class PollsRepository extends EloquentBaseRepository implements PollsInterface
{

    /**
     * Construct Shit
     * @param Polls $model
     */
    public function __construct(Polls $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     *
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
     * get paginated list (front)
     */
    public function frontList()
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->where('time_start', '<=', time())->where('time_end', '>=', time())->get();

        return $items;
    }

}
