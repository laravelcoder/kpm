<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Menu\MenuInterface;
use View, Input;

class MenuController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'menu';

    /**
     * Construct Shit
     */
    public function __construct(MenuInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     *
     */
    public function getIndex($id = null)
    {
        $items = $this->model->getItems($id);

        return View::make('laravel-bootstrap::'.$this->view_key.'.index')
                    ->with('items', $items)
                    ->with('id', $id);
    }

    /**
     *
     */
    public function getNew($lang_code = null, $id = null)
    {
        $items = $this->model->getMainItems();
        View::share('items', $items);

        $pages = $this->model->getPages();
        View::share('pages', $pages);

        return parent::getNew($lang_code, $id);
    }

    /**
     *
     */
    public function getEdit($id = null, $lang_code = null)
    {
        $items = $this->model->getMainItems();
        View::share('items', $items);

        $pages = $this->model->getPages();
        View::share('pages', $pages);

        return parent::getEdit($id, $lang_code);
    }

    /**
     * saving
     */
    public function postNew($lang_code = null, $id = null)
    {
        $this->object_url .= "/" . Input::get('parent_id', null);

        return parent::postNew($lang_code, $id);
    }

    /**
     * updating
     */
    public function postEdit($id, $lang_code = null)
    {
        $this->object_url .= "/" . Input::get('parent_id', null);

        return parent::postEdit($id, $lang_code);
    }

    /**
     * sort menu items
     */
    public function postSort()
    {
        //
        $this->model->saveItems(Input::get('sort', []));

        return ['success' => 1];
    }
}
