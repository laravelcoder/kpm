<?php

Route::get('/blog/', array(
	'as' => 'sBlog',
	'uses' => 'Sashko\Blog\SBlogController@getList'
));

Route::get('/blog/{slug}', array(
	'as' => 'sViewPost',
	'uses' => 'Sashko\Blog\SBlogController@getView'
))->where('slug', '[a-z0-9\-]+');
