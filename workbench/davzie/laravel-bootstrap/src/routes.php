<?php

// Get the URL segment to use for routing
$urlSegment = Config::get('laravel-bootstrap::app.access_url');


// Filter all requests ensuring a user is logged in when this filter is called
Route::filter('adminFilter', 'Davzie\LaravelBootstrap\Filters\Admin');
Route::filter('langFilter', 'Davzie\LaravelBootstrap\Filters\Lang');

Route::controller($urlSegment.'/users'     , 'Davzie\LaravelBootstrap\Controllers\UsersController');
Route::controller($urlSegment.'/settings'  , 'Davzie\LaravelBootstrap\Controllers\SettingsController');
Route::controller($urlSegment.'/blocks'    , 'Davzie\LaravelBootstrap\Controllers\BlocksController');
Route::controller($urlSegment.'/posts'     , 'Davzie\LaravelBootstrap\Controllers\PostsController');
Route::controller($urlSegment.'/roles'     , 'Davzie\LaravelBootstrap\Controllers\RolesController');

Route::controller($urlSegment.'/langs'     , 'Davzie\LaravelBootstrap\Controllers\LangsController');

Route::controller($urlSegment.'/rubrics'   , 'Davzie\LaravelBootstrap\Controllers\RubricsController');
Route::controller($urlSegment.'/news'      , 'Davzie\LaravelBootstrap\Controllers\NewsController');

Route::get($urlSegment.'/pages/{id}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\PagesController@getIndex'))->where(array('id' => '\d+'));
Route::controller($urlSegment.'/pages'     , 'Davzie\LaravelBootstrap\Controllers\PagesController');
Route::controller($urlSegment.'/informing' , 'Davzie\LaravelBootstrap\Controllers\AdvertsController');
Route::controller($urlSegment.'/feedback'  , 'Davzie\LaravelBootstrap\Controllers\FeedbackController');
Route::controller($urlSegment.'/teachers'  , 'Davzie\LaravelBootstrap\Controllers\TeachersController');
Route::controller($urlSegment.'/galleries' , 'Davzie\LaravelBootstrap\Controllers\GalleriesController');

Route::get($urlSegment.'/menu/{id}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\MenuController@getIndex'))->where(array('id' => '\d+'));
Route::controller($urlSegment.'/menu' , 'Davzie\LaravelBootstrap\Controllers\MenuController');


Route::get($urlSegment.'/storage/{id}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\StorageController@getIndex'))->where(array('id' => '\d+'));
Route::controller($urlSegment.'/storage'   , 'Davzie\LaravelBootstrap\Controllers\StorageController');

Route::controller($urlSegment.'/polls' , 'Davzie\LaravelBootstrap\Controllers\PollsController');
Route::get($urlSegment.'/polls-answers/{id}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\PollsAnswersController@getIndex'))->where(array('id' => '\d+'));
Route::controller($urlSegment.'/polls-answers' , 'Davzie\LaravelBootstrap\Controllers\PollsAnswersController');
Route::controller($urlSegment.'/links' , 'Davzie\LaravelBootstrap\Controllers\LinksController');
Route::controller($urlSegment.'/comments' , 'Davzie\LaravelBootstrap\Controllers\CommentsController');

// Route::pattern('code', '^[0-9]+$');
Route::get($urlSegment.'/users/compleate/{code}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\UsersController@getCompleate'));

Route::post($urlSegment.'/users/compleate/{code}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\UsersController@postCompleate'));

Route::get($urlSegment.'/users/restore/', array('uses' => 'Davzie\LaravelBootstrap\Controllers\UsersController@getRestore'));

Route::post($urlSegment.'/users/restore/', array('uses' => 'Davzie\LaravelBootstrap\Controllers\UsersController@postRestore'));

Route::controller($urlSegment, 'Davzie\LaravelBootstrap\Controllers\DashController');



/** Include IOC Bindings **/
include __DIR__.'/bindings.php';
include __DIR__.'/access.php';
