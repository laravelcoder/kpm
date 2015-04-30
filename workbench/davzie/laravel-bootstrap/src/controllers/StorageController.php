<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Storage\StorageInterface;
use Input, Redirect;
use Illuminate\Support\MessageBag;

class StorageController extends ObjectBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'storage';

    /**
     * Construct Shit
     */
    public function __construct(StorageInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     * upload file
     */
    public function postUpload() {
        $dir    = \Input::get('dir');
        $name   = \Input::get('name');

        $result = ['success' => 0];

        if ($data = $this->model->doUpload($name, $dir)) {
            $data['success'] = 1;
            $data['key']     = $name;
            $result          = $data;
        }

        return \Response::json($result);
    }

    /**
     * get list of files for dir
     */
    public function getIndex($dir_id = null)
    {
        $items = $this->model->readDir($dir_id);

        foreach ($items as $item) {
            $item->is_image = $this->model->isImg($item->mime);
            if (!$item->is_dir) {
                $item->thumbs   = $this->model->getThumbs($item);
                $item->path     = 'http://'.\Request::server('HTTP_HOST').$this->model->getFilepath($item->id);
            }
        }

        if (!$dir_id) {
            $dir = false;
        } elseif (!$dir   = $this->model->requireById($dir_id)) {
            $dir = false;
        }

        return \View::make('laravel-bootstrap::'.$this->view_key.'.index')
                    ->with('items', $items)
                    ->with('dir_id', $dir_id)
                    ->with('dir', $dir);
    }

    /**
     * add new dir (get)
     */
    public function getAddDir($parent_id = null)
    {
        \View::share('new_url', $this->object_url . '/add-dir/');

        return \View::make('laravel-bootstrap::'.$this->view_key.'.add-dir')
                    ->with('parent_id', $parent_id);
    }

    /**
     *
     */
    public function postAddDir()
    {
        $record = $this->model->getNew(Input::all());

        $valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

        if(!$valid) {
            return Redirect::back()->withErrors($record->getErrors())->withInput();
        }

        $name = Input::get('filename');
        $parent_id = Input::get('parent_id');

        if ($this->model->createDir($name, $parent_id)) {
            return Redirect::to($this->object_url . '/' . $parent_id)->with('success' , new MessageBag(array('Папку створено')));
        }

        return Redirect::back()->with('errors' , new MessageBag(array('Помилка при створенні папки')))->withInput();
    }

    /**
     *
     */
    public function getEditDir($id)
    {
        if (!$record = $this->model->requireById($id)) {
            return Redirect::to($this->object_url);
        }


        \View::share('edit_url', $this->object_url . '/edit-dir/');

        return \View::make('laravel-bootstrap::'.$this->view_key.'.edit-dir')
                    ->with('id', $id)
                    ->with('item', $record);
    }

    /**
     *
     */
    public function postEditDir($id)
    {
        if (!$record = $this->model->requireById($id)) {
            return Redirect::to($this->object_url);
        }

        $record->fill(Input::all());

        $valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

        if(!$valid) {

            return Redirect::back()->with('errors' , $record->getErrors())->withInput();
        }

        $record->save();

        return Redirect::to($this->object_url . '/' . $record->parent_id)->with('success' , new MessageBag(array('Зміни збережено')));
    }

    /**
     *
     */
    // deleting

    /**
     *
     */
    public function getFile($id)
    {
        if (!$file = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        if ($file->is_dir) {
            return \App::abort(404);
        }

        $file->is_image = $this->model->isImg($file->type);
        $file->path     = $this->model->getFilepath($file->id);

        return \View::make('laravel-bootstrap::'.$this->view_key.'.file')
                    ->with('file', $file);
    }

}