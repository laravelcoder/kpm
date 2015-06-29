<?php namespace Davzie\LaravelBootstrap\Galleries;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Galleries\Galleries;
use Davzie\LaravelBootstrap\Departments\Departments;
use Config, Input, App;

class GalleriesRepository extends EloquentBaseRepository implements GalleriesInterface
{

    /**
     * Construct Shit
     * @param Galleries $model
     */
    public function __construct(Galleries $model)
    {
    	parent::__construct();
        $this->model = $model;
    }

    /**
     * get all galleries
     */
    public function getAll()
    {
        // get default lang
    	$lang       = $this->lang_model->defaultLang();
        // get hidden lang
        $hidden     = $this->lang_model->getHidden();
        // get records, exists on this lang
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
     * save model relations
     */
    public function saveRelations($storage_id = null)
    {
        $gallery_id = Input::get('gallery_id', null);

        if (!$gallery_id || !$storage_id) {
            return false;
        }

        $this->model->id = $gallery_id;
        $this->model->photos()->attach([$storage_id]);
    }

    /**
     * update model relations
     */
    public function updateRelations($storage_id = null)
    {
        $gallery_id = Input::get('gallery_id', null);

        if (!$gallery_id || !$storage_id) {
            return false;
        }

        $this->model->id = $gallery_id;
        $this->model->photos()->detach([$storage_id]);
    }

    /**
     *
     */
    public function findById($id, $lang_code = false)
    {
        $item = parent::findById($id, $lang_code);

        if ($item) {
            foreach ($item->photos as &$photo) {
                $photo->thumbs = $this->storage_model->getThumbs($photo);
            }

        }

        return $item;
    }

    /**
     * get galleries list
     */
    public function frontList()
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('lang_id', $lang->id)->where('is_active', 1)->paginate(\Config::get('app.limit'));

        foreach ($items as &$item) {
            $item->thumbs = $this->storage_model->getThumbs($item->photo);

            foreach ($item->photos as &$photo) {
                $photo->thumbs = $this->storage_model->getThumbs($photo);
            }
        }

        return $items;
    }

    /**
     * get one gallery
     */
    public function frontView($id)
    {
        $lang  = $this->lang_model->getByCode(App::getLocale());
        $items = $this->model->where('id', $id)->where('lang_id', $lang->id)->where('is_active', 1)->first();

        $item->thumbs = $this->storage_model->getThumbs($item->photo);

        foreach ($item->photos as &$photo) {
            $photo->thumbs = $this->storage_model->getThumbs($photo);
        }

        return $item;
    }

}
