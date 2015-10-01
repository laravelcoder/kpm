<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Galleries\GalleriesInterface;
use Input;

class GalleriesController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'galleries';

    /**
     *
     */
    protected $whitelist = array('postAddItem', 'postDeleteItem');

    /**
     * Construct Shit
     */
    public function __construct(GalleriesInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     *
     */
    public function postAddItem()
    {
        $dir    = \Input::get('dir');
        $name   = \Input::get('name');
        $gallery_id   = \Input::get('gallery_id');

        $result = ['success' => 0];

        if ($data = $this->storage_model->doUpload($name, $dir)) {
            $data['success'] = 1;
            $data['key']     = $name;
            $result          = $data;

            $this->model->saveRelations($data['id']);
        }


        return \Response::json($result);
    }

    /**
     *
     */
    public function postDeleteItem()
    {
        $this->model->updateRelations(Input::get('storage_id'));

        return ['success' => 1];
    }
}
