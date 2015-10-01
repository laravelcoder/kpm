<?php namespace Davzie\LaravelBootstrap\Teachers;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Teachers\Teachers;
use Davzie\LaravelBootstrap\Departments\Departments;
use App, Input;

class TeachersRepository extends EloquentBaseRepository implements TeachersInterface
{

    /**
     * Construct Shit
     * @param Teachers $model
     */
    public function __construct(Teachers $model)
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
     *
     */
    public function frontList()
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $s     = Input::get('s', false);
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1);

        if ($s) {
            $s = "%{$s}%";
            $items = $items->where(function ($query) use ($s) {
                $query->where('surname', 'LIKE', $s)
                      ->orWhere('name', 'LIKE', $s)
                      ->orWhere('second_name', 'LIKE', $s);
            });
        }

        $items = $items->get();

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo);
        }

        return $items;
    }

    /**
     *
     */
    public function getRandom($limit = 4)
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->orderByRaw('RAND()')->take($limit)->get();

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo);
        }

        return $items;
    }

    /**
     * get one item by id (front)
     */
    public function frontView($id)
    {
        $lang = $this->lang_model->getByCode(App::getLocale());
        $item = $this->model->where('id', $id)->where('lang_id', $lang->id)->where('is_active', 1)->first();

        if (!$item) {
            return false;
        }

        $item->thumbs = $this->storage_model->getThumbs($item->photo);

        return $item;
    }
}
