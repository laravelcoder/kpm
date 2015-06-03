<?php

use Davzie\LaravelBootstrap\Pages\PagesInterface;
use Illuminate\Support\MessageBag;

class PagesController extends BaseController {

	/**
	 *
	 */
	public function __construct(PagesInterface $model)
	{
		parent::__construct();
		$this->model = $model;
	}

	/**
	 * view page by slug
	 */
	public function getView($slug)
	{
		if (!$item = $this->model->getBySlug($slug)) {
			return App::abort(404);
		}

		return View::make('pages.view')
					->with('item', $item);
	}

	/**
	 * get contact page
	 */
	public function getContact()
	{
		return View::make('pages.contact');
	}

	/**
	 * post contact page (store feedback)
	 */
	public function postContact()
	{
		$feedback_repo = App::make('Davzie\LaravelBootstrap\Feedback\FeedbackInterface');
		$record        = $feedback_repo->getNew(Input::all());
		$valid         = $record->isValid(Input::all());

		if(!$valid) {
			return Redirect::back()->with('errors' , $record->getErrors())->withInput();
		}

		// var_dump($record); die;
		$record = new Feedback;
		$record->fill(Input::all());
		$record->save();

		return Redirect::action('PagesController@getContact')->with('success' , new MessageBag(array(_('Ваш лист відправлено'))));
	}

	/**
	 * get schedule for group for a week
	 */
	public function getGroupSchedule()
	{
		//
		$faculty_id    = 19;
		$university_id = 6;
		$department_id = 70;

		$weeks = [];
		$weeks = file_get_contents('http://studvel.com/api/weeks/'. $university_id);
		$weeks = json_decode($weeks, true);

		$groups = [];
		$groups = file_get_contents('http://studvel.com/api/groups/'. $faculty_id);
		$groups = json_decode($groups, true);

		$week  = Input::get('week', $weeks[0]['id']);
		$group = Input::get('group', $groups[0]['id']);

		$weeks_ids  = [];
		$groups_ids = [];
		$week_opts  = [];
		$group_opts = [];

		foreach ($weeks as $item) {
			$weeks_ids[] = $item['id'];
			$week_opts[$item['id']] = $item['title'];
		}

		foreach ($groups as $item) {
			$groups_ids[] = $item['id'];
			$group_opts[$item['id']] = $item['title'];
		}

		if (!in_array($week, $weeks_ids)
			|| !in_array($group, $groups_ids)) {
			return App::abort(404);
		}

		$schedule = [];
		$schedule = file_get_contents("http://studvel.com/api/group-schedule/{$group}/{$week}");
		$schedule = json_decode($schedule, true);

		$current = file_get_contents("http://studvel.com/api/week/{$week}");
		$current = json_decode($current, true);
		$delta = 3600*24;
		$current['time_start'] = strtotime($current['time_start']);

		$days = [
			1 => _('Понеділок'),
			2 => _('Вівторок'),
			3 => _('Середа'),
			4 => _('Четвер'),
			5 => _('П`ятниця'),
			6 => _('Субота'),
		];

		return View::make('pages.group-schedule')
					->with('schedule', $schedule)
					->with('group', $group)
					->with('week', $week)
					->with('days', $days)
					->with('weeks', $week_opts)
					->with('current', $current)
					->with('delta', $delta)
					->with('groups', $group_opts);
	}

	/**
	 * get schedule for group for a week
	 */
	public function getTeacherSchedule()
	{
		//
		$faculty_id    = 19;
		$university_id = 6;
		$department_id = 70;

		$weeks = [];
		$weeks = file_get_contents('http://studvel.com/api/weeks/'. $university_id);
		$weeks = json_decode($weeks, true);

		$teachers = [];
		$teachers = file_get_contents('http://studvel.com/api/department-teachers/'. $department_id);
		$teachers = json_decode($teachers, true);

		$week    = Input::get('week', $weeks[0]['id']);
		$teacher = Input::get('teacher', $teachers[0]['id']);

		$weeks_ids  = [];
		$teachers_ids = [];
		$week_opts  = [];
		$teacher_opts = [];

		foreach ($weeks as $item) {
			$weeks_ids[] = $item['id'];
			$week_opts[$item['id']] = $item['title'];
		}

		foreach ($teachers as $item) {
			$teachers_ids[] = $item['id'];
			$teacher_opts[$item['id']] = $item['title'];
		}

		if (!in_array($week, $weeks_ids)
			|| !in_array($teacher, $teachers_ids)) {
			return App::abort(404);
		}

		$schedule = [];
		$schedule = file_get_contents("http://studvel.com/api/teacher-schedule/{$teacher}/{$week}");
		$schedule = json_decode($schedule, true);

		$current = file_get_contents("http://studvel.com/api/week/{$week}");
		$current = json_decode($current, true);
		$delta = 3600*24;
		$current['time_start'] = strtotime($current['time_start']);

		$days = [
			1 => _('Понеділок'),
			2 => _('Вівторок'),
			3 => _('Середа'),
			4 => _('Четвер'),
			5 => _('П`ятниця'),
			6 => _('Субота'),
		];

		return View::make('pages.teacher-schedule')
					->with('schedule', $schedule)
					->with('teacher', $teacher)
					->with('week', $week)
					->with('days', $days)
					->with('weeks', $week_opts)
					->with('current', $current)
					->with('delta', $delta)
					->with('teachers', $teacher_opts);
	}

	/**
	 *
	 */
	public function getRss()
	{
		$news_model = App::make('Davzie\LaravelBootstrap\News\NewsInterface');
		$news = $news_model->frontList();

		$content = View::make('pages.rss')->with('news', $news);

		return Response::make($content, '200')->header('Content-Type', 'text/xml');
	}

	/**
	 *
	 */
	public function getSitemap()
	{
		$pages = $this->model->getActivePages();

		return View::make('pages.sitemap')
					->with('pages', $pages);
	}

}
