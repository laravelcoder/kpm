<?php namespace Davzie\LaravelBootstrap\Core;
use Davzie\LaravelBootstrap\Core\Exceptions\EntityNotFoundException;
use Davzie\LaravelBootstrap\Langs\Langs;
use Input;

/**
 * Base Eloquent Repository Class Built On From Shawn McCool <-- This guy is pretty amazing
 */
class EloquentBaseRepository
{
    protected $model;

    public $lang_model;

    public function __construct($model = null)
    {
        $this->model = $model;
        $this->lang_model    = \App::make('Davzie\LaravelBootstrap\Langs\LangsInterface');
        $this->storage_model = \App::make('Davzie\LaravelBootstrap\Storage\StorageInterface');
    }

    public function beforeSave($data)
    {
        return $data;
    }

    /**
     *
     */
    public function getTable()
    {
        return $this->model->getTable();
    }

    /**
     *
     */
    public function find($id)
    {
        return $this->model->find($id);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * Get everything (active only)
     * @return Eloquent
     */
    public function getAll()
    {
        return $this->model->paginate(\Config::get('app.limit'));
    }

    /**
     * Get only deleted items
     * @return Eloquent
     */
    public function getAllTrashed()
    {
        return $this->model->onlyTrashed()->get();
    }

    public function getAllPaginated($count)
    {
        return $this->model->paginate($count);
    }

    /**
     * Get a record by its ID
     * @param  integer $id The ID of the record
     * @return Eloquent
     */
    public function getById($id)
    {
        return $this->model->find($id);
    }

    /**
     *
     */
    public function findById($id, $lang_code = false)
    {
        if (!$lang_code) {
            return $this->model->where('id', '=', $id)->first();
        }

        if (!$lang = Langs::where('code', '=', $lang_code)->first()) {
            return false;
        }

        return $this->model->where('id', '=', $id)->where('lang_id', '=', $lang->id)->first();
    }

    /**
     * Get a record by its ID even if it is trashed
     * @param  integer $id The ID of the record
     * @return Eloquent
     */
    public function getByIdWithTrashed($id)
    {
        return $this->model->withTrashed()->find($id);
    }


    /**
     * Get a record by it's slug
     * @param  string $slug The slug name
     * @return Eloquent
     */
    public function getBySlug($slug)
    {
        return $this->model->where('slug','=',$slug)->first();
    }

    public function requireById($id)
    {
        $model = $this->getById($id);

        if ( ! $model) {
            return false;
        }

        return $model;
    }

    public function getNew($attributes = array(), $exists = false)
    {
        return $this->model->newInstance($attributes, $exists);
    }

    public function store($data)
    {
        if ($data instanceOf \Eloquent) {
            $this->storeEloquentModel($data);
        } elseif (is_array($data)) {
            $this->storeArray($data);
        }
    }

    /**
     * Delete the model passed in
     * @param  Eloquent $model The description
     * @return void
     */
    public function delete($model)
    {
        $model->delete();
    }

    /**
     * Store the eloquent model that is passed in
     * @param  Eloquent $model The Eloquent Model
     * @return void
     */
    protected function storeEloquentModel($model)
    {
        if ($model->getDirty()) {
            $model->save();
        } else {
            $model->touch();
        }
    }

    /**
     * Store an array of data
     * @param  array $data The Data Array
     * @return void
     */
    protected function storeArray($data)
    {
        $model = $this->getNew($data);
        $this->storeEloquentModel($model);
    }

    /**
     * get default model with common model fileds
     */
    public function getDefault($id = null)
    {
        $model = $this->getModel();

        if (!$id) {
            return $model;
        }

        $item = $this->model->where('id', '=', $id)->first();

        if (!$item) {
            return $model;
        }

        $common_fields = $this->model->getCommonFields();

        foreach ($common_fields as $field) {
            $model->$field = $item->$field;
        }

        return $model;
    }

    /**
     *
     */
    public function updateCommon($id, $data)
    {
        $update = [];
        $common = $this->model->getCommonFields();
        foreach ($common as $field) {
            if (isset($data[$field])) {
                if (!strlen($data[$field])) {
                    $data[$field] = NULL;
                }

                $update[$field] = $data[$field];
            }
        }

        return $this->getNew($update + ['id' => $id], true)->save();
    }

    /**
     * create hidden
     */
    public function createHidden($id, $data)
    {
        $hidden_lang = $this->lang_model->getHidden();
        $exists      = $this->findById($id, $hidden_lang->code);

        if (!$exists) {
            $record = $this->getNew($data);
            $record->id = $id;
            $record->lang_id = $hidden_lang->id;
            $record->save();
        }
    }

    /**
     *
     */
    public function getPaths($data = [])
    {
        $path = [];
        $fields = $this->model->getFillable();

        foreach ($fields as $field) {
            if (strpos($field, 'storage_id') != false) {
                if (Input::has($field)) {
                    $path[$field] = $this->storage_model->getFilepath(\Input::old($field));
                } elseif (isset($data[$field])) {
                    $path[$field] = $this->storage_model->getFilepath($data[$field]);
                } else {
                    $path[$field] = false;
                }
            }
        }

        return $path;
    }

    /**
     *
     */
    public function update($id, $lang_id, $data)
    {
        // $table = $this->model->getTable();
        // var_dump($data);die;

        // return \DB::table($table)->where('id', $id)->where('lang_id', $lang_id)->update($data);
        return $this->model->where('id', $id)->where('lang_id', $lang_id)->update($data);

    }

    /**
     *
     */
    public function saveRelations($id)
    {}

    /**
     *
     */
    public function updateRelations($id)
    {}

}
