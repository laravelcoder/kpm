<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\News\NewsInterface;
use Davzie\LaravelBootstrap\Rubrics\RubricsRepository;
use Davzie\LaravelBootstrap\Rubrics\Rubrics;
use View;

class NewsController extends LangsBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'news';

    /**
     * Construct Shit
     */
    public function __construct( NewsInterface $news )
    {
        $this->model = $news;
        parent::__construct();
    }

    /**
     *
     */
    public function getNew($lang_code = null, $id = null)
    {
        // get rubrics list with default lang
        View::share('rubrics', $this->model->rubrics());

        return parent::getNew($lang_code, $id);
    }

    /**
     *
     */
    public function getEdit($id, $lang_code = null)
    {
        View::share('rubrics', $this->model->rubrics());

        return parent::getEdit($id, $lang_code);
    }

}