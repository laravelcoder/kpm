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

if (in_array($locale, Config::get('app.available_locales'))) {
    \App::setLocale($locale);
} else {
    $locale = null;
}

LaravelGettext::setLocale($locale ? $locales[$locale] : 'uk_UA');

Route::group(array('prefix' => $locale), function()
{
	Route::get('/', 'HomeController@index');

	Route::get('users/{id}', 'HomeController@users')->where(array('id' => '\d+'));
});

