<?php namespace Davzie\LaravelBootstrap\Teachers;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Teachers\Teachers;
use Davzie\LaravelBootstrap\Departments\Departments;

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
        $lang = $this->lang_model->defaultLang();
        $items = $this->model->where('lang_id', '=', $lang->id)->paginate(\Config::get('app.limit'));

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo ? $item->photo->hashname : '');
        }

        return $items;
    }
}
