<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
$locales = array('en' => 'en_US', 'ru' => 'ru_RU', 'uk' => 'uk_UA');

$locale = Request::segment(1);
App::setLocale('uk');
LaravelGettext::setLocale('uk_UA');

if (in_array($locale, Config::get('app.available_locales'))) {
    App::setLocale($locale);
	LaravelGettext::setLocale($locales[$locale]);
} else {
    $locale = null;
}

Route::group(array('prefix' => $locale), function() {
	Route::get('/', 'HomeController@index');

	Route::get('/news', 'NewsController@getIndex');
	Route::get('/new/{slug}', 'NewsController@getView')->where(['slug' => '[a-z0-9\-]+']);

	Route::get('/informing', 'AdvertsController@getIndex');
	Route::get('/informing/{id}', 'AdvertsController@getView')->where(['id' => '\d+']);

	Route::get('/teachers', 'TeachersController@getIndex');
	Route::get('/teacher/{id}', 'TeachersController@getView')->where(['id' => '\d+']);

	Route::get('/galleries', 'GalleriesController@getIndex');
	Route::get('/gallery/{id}', 'GalleriesController@getView')->where(['id' => '\d+']);

	// Route::get('/links', 'PagesController@getLinks');

	// pages view
	Route::post('/vote', 'PagesController@postVote');
	Route::get('/contact', 'PagesController@getContact');
	Route::post('/contact', 'PagesController@postContact');
	Route::get('/sitemap', 'PagesController@getSitemap');
	Route::get('/rss', 'PagesController@getRss');
	Route::get('/group-schedule', 'PagesController@getGroupSchedule');
	Route::get('/teacher-schedule', 'PagesController@getTeacherSchedule');
	// last action
	Route::get('/{slug}', 'PagesController@getView')->where(['slug' => '[a-z0-9\-]+']);
});

$composed_views = array('*');
View::composer($composed_views, 'Davzie\LaravelBootstrap\Front\Page');

