<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Pages\PagesInterface;
use View;

class PagesController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'pages';

    /**
     * Construct Shit
     */
    public function __construct( PagesInterface $pages )
    {
        $this->model = $pages;
        parent::__construct();
    }

    /**
     *
     */
    public function getIndex($id = null)
    {
        $items = $this->model->getItems($id);
        $page  = $this->model->requireById($id);

        return View::make('laravel-bootstrap::'.$this->view_key.'.index')
                    ->with('items', $items)
                    ->with('page' , $page)
                    ->with('id', $id);
    }

    /**
     *
     */
    public function getNew($lang_code = null, $id = null)
    {
        View::share('pages', $this->model->getList());

        return parent::getNew($lang_code, $id);
    }

    /**
     *
     */
    public function getEdit($id, $lang_code = null)
    {
        View::share('pages', $this->model->getList([$id]));

        return parent::getEdit($id, $lang_code);
    }

}