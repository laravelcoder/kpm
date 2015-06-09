<?php

use Davzie\LaravelBootstrap\News\NewsInterface;
use Davzie\LaravelBootstrap\Links\LinksInterface;
use Davzie\LaravelBootstrap\Polls\PollsInterface;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;

class HomeController extends BaseController {

	/**
	 *
	 */
	public $news_model;

	/**
	 *
	 */
	public $links_model;

	/**
	 *
	 */
	public $polls_model;

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/
	public function __construct()
	{
		parent::__construct();
		$this->news_model  = App::make('Davzie\LaravelBootstrap\News\NewsInterface');
		$this->links_model = App::make('Davzie\LaravelBootstrap\Links\LinksInterface');
		$this->polls_model = App::make('Davzie\LaravelBootstrap\Polls\PollsInterface');
	}

	public function showWelcome()
	{
		return View::make('hello');
	}

	/**
	 *
	 */
	public function index()
	{
		// get 4 news
		$news  = $this->news_model->frontList(4);

		// get links
		$links = $this->links_model->frontList();

		// get polls
		$polls = $this->polls_model->frontList();

		foreach ($polls as &$poll) {
			$total = 0;

			foreach ($poll->answers as $answer) {
				$total += $answer->votes->count();
			}

			foreach ($poll->answers as &$answer) {
				$answer->count = 0;

				if ($total) {
					$answer->count = round(100*($answer->votes->count()/$total), 2);
				}
			}
		}

		return View::make('index')
					->with('news', $news)
					->with('links', $links)
					->with('polls', $polls);
	}

}
