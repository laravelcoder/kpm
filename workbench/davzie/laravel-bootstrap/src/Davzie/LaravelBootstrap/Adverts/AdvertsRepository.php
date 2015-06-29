<?php namespace Davzie\LaravelBootstrap\Adverts;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Adverts\Adverts;
use Davzie\LaravelBootstrap\Departments\Departments;
use App, Input;

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

    /**
     * get adverts list
     *
     * @param int $limit
     */
    public function frontList($limit = null)
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->where('time_start', '<=', time())->where('time_end', '>=', time());
        $s     = Input::get('s', false);

        if ($s) {
            $s = htmlspecialchars($s);
            $s = "%{$s}%";
            $items = $items->where(function ($query) use ($s) {
                $query->where('title', 'LIKE', $s)
                      ->orWhere('descr', 'LIKE', $s)
                      ->orWhere('body', 'LIKE', $s);
            });
        }

        $items = $items->orderBy('time_end')->paginate($limit ? $limit : \Config::get('app.limit'));

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo);
        }

        return $items;
    }

    /**
     * get adverts by id
     */
    public function frontView($id)
    {
        $lang = $this->lang_model->getByCode(App::getLocale());
        $item = $this->model->where('id', $id)->where('lang_id', $lang->id)->where('is_active', 1)->where('time_start', '<=', time())->where('time_end', '>=', time())->first();

        $item->thumbs = $this->storage_model->getThumbs($item->photo);

        return $item;
    }

}
