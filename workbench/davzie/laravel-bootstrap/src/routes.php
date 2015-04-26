<?php

// Get the URL segment to use for routing
$urlSegment = Config::get('laravel-bootstrap::app.access_url');


// Filter all requests ensuring a user is logged in when this filter is called
Route::filter('adminFilter', 'Davzie\LaravelBootstrap\Filters\Admin');

Route::controller($urlSegment.'/users'     , 'Davzie\LaravelBootstrap\Controllers\UsersController');
Route::controller($urlSegment.'/galleries' , 'Davzie\LaravelBootstrap\Controllers\GalleriesController');
Route::controller($urlSegment.'/settings'  , 'Davzie\LaravelBootstrap\Controllers\SettingsController');
Route::controller($urlSegment.'/blocks'    , 'Davzie\LaravelBootstrap\Controllers\BlocksController');
Route::controller($urlSegment.'/posts'     , 'Davzie\LaravelBootstrap\Controllers\PostsController');
Route::controller($urlSegment.'/roles'     , 'Davzie\LaravelBootstrap\Controllers\RolesController');

Route::controller($urlSegment.'/langs', 'Davzie\LaravelBootstrap\Controllers\LangsController');

Route::controller($urlSegment.'/rubrics', 'Davzie\LaravelBootstrap\Controllers\RubricsController');
Route::controller($urlSegment.'/news'   , 'Davzie\LaravelBootstrap\Controllers\NewsController');
Route::controller($urlSegment.'/pages'  , 'Davzie\LaravelBootstrap\Controllers\PagesController');
Route::controller($urlSegment.'/adverts'   , 'Davzie\LaravelBootstrap\Controllers\AdvertsController');
Route::controller($urlSegment.'/feedback'  , 'Davzie\LaravelBootstrap\Controllers\FeedbackController');
Route::controller($urlSegment.'/teachers'  , 'Davzie\LaravelBootstrap\Controllers\TeachersController');


Route::get($urlSegment.'/storage/{id}', array('uses' => 'Davzie\LaravelBootstrap\Controllers\StorageController@getIndex'))->where(array('id' => '\d+'));
Route::controller($urlSegment.'/storage', 'Davzie\LaravelBootstrap\Controllers\StorageController');

Route::controller($urlSegment, 'Davzie\LaravelBootstrap\Controllers\DashController');



/** Include IOC Bindings **/
include __DIR__.'/bindings.php';
include __DIR__.'/access.php';
