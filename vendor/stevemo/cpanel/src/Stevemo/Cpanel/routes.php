<?php

Route::group(array('prefix' => Config::get('cpanel::prefix', 'admin')), function()
{
	/*
	|--------------------------------------------------------------------------
	| Cpanel Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('/', array(
		'as'     => 'cpanel.home',
		'uses'   => 'Stevemo\Cpanel\Controllers\CpanelController@index',
		'before' => 'auth.cpanel:cpanel.view'
	));

	/*
	|--------------------------------------------------------------------------
	| Cpanel Permissions Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('permissions', array(
		'as'     => 'cpanel.permissions.index',
		'uses'   => 'Stevemo\Cpanel\Controllers\PermissionsController@index',
		'before' => 'auth.cpanel'
	));
	Route::post('permissions', array(
		'as'     => 'cpanel.permissions.store',
		'uses'   => 'Stevemo\Cpanel\Controllers\PermissionsController@store',
		'before' => 'auth.cpanel'
	));
	Route::get('permissions/create', array(
		'as'     => 'cpanel.permissions.create',
		'uses'   => 'Stevemo\Cpanel\Controllers\PermissionsController@create',
		'before' => 'auth.cpanel'
	));
	Route::get('permissions/{id}/edit', array(
		'as'     => 'cpanel.permissions.edit',
		'uses'   => 'Stevemo\Cpanel\Controllers\PermissionsController@edit',
		'before' => 'auth.cpanel'
	));
	Route::put('permissions/{id}', array(
		'as'     => 'cpanel.permissions.update',
		'uses'   => 'Stevemo\Cpanel\Controllers\PermissionsController@update',
		'before' => 'auth.cpanel'
	));
	Route::delete('permissions/{id}', array(
		'as'     => 'cpanel.permissions.destroy',
		'uses'   => 'Stevemo\Cpanel\Controllers\PermissionsController@destroy',
		'before' => 'auth.cpanel'
	));

	/*
	|--------------------------------------------------------------------------
	| Cpanel Groups Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('groups', array(
		'as'     => 'cpanel.groups.index',
		'uses'   => 'Stevemo\Cpanel\Controllers\GroupsController@index',
		'before' => 'auth.cpanel'
	));
	Route::post('groups', array(
		'as'     => 'cpanel.groups.store',
		'uses'   => 'Stevemo\Cpanel\Controllers\GroupsController@store',
		'before' => 'auth.cpanel'
	));
	Route::get('groups/create', array(
		'as'     => 'cpanel.groups.create',
		'uses'   => 'Stevemo\Cpanel\Controllers\GroupsController@create',
		'before' => 'auth.cpanel'
	));
	Route::get('groups/{id}/edit', array(
		'as'     => 'cpanel.groups.edit',
		'uses'   => 'Stevemo\Cpanel\Controllers\GroupsController@edit',
		'before' => 'auth.cpanel'
	));
	Route::put('groups/{id}', array(
		'as'     => 'cpanel.groups.update',
		'uses'   => 'Stevemo\Cpanel\Controllers\GroupsController@update',
		'before' => 'auth.cpanel'
	));
	Route::delete('groups/{id}', array(
		'as'     => 'cpanel.groups.destroy',
		'uses'   => 'Stevemo\Cpanel\Controllers\GroupsController@destroy',
		'before' => 'auth.cpanel'
	));

	/*
	|--------------------------------------------------------------------------
	| Cpanel Users Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('users', array(
		'as'     => 'cpanel.users.index',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@index',
		'before' => 'auth.cpanel'
	));
	Route::post('users', array(
		'as'     => 'cpanel.users.store',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@store',
		'before' => 'auth.cpanel'
	));
	Route::get('users/create', array(
		'as'     => 'cpanel.users.create',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@create',
		'before' => 'auth.cpanel'
	));
	Route::get('users/{id}', array(
		'as'     => 'cpanel.users.show',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@show',
		'before' => 'auth.cpanel'
	));
	Route::get('users/{id}/edit', array(
		'as'     => 'cpanel.users.edit',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@edit',
		'before' => 'auth.cpanel'
	));
	Route::put('users/{id}', array(
		'as'     => 'cpanel.users.update',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@update',
		'before' => 'auth.cpanel'
	));
	Route::delete('users/{id}', array(
		'as'     => 'cpanel.users.destroy',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@destroy',
		'before' => 'auth.cpanel'
	));
	Route::put('users/{users}/activate', array(
		'as'     => 'cpanel.users.activate',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@putActivate',
		'before' => 'auth.cpanel:users.update'
	));

	Route::put('users/{users}/deactivate', array(
		'as'     => 'cpanel.users.deactivate',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersController@putDeactivate',
		'before' => 'auth.cpanel:users.update'
	));


	/*
	|--------------------------------------------------------------------------
	| Cpanel Users Permissions Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('users/{users}/permissions', array(
		'as'     => 'cpanel.users.permissions',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersPermissionsController@index',
		'before' => 'auth.cpanel:users.update'
	));

	Route::put('users/{users}/permissions', array(
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersPermissionsController@update',
		'before' => 'auth.cpanel:users.update'
	));

	/*
	|--------------------------------------------------------------------------
	| Cpanel Users Throttling Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('users/{user}/throttling', array(
		'as'     => 'cpanel.users.throttling',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersThrottlingController@getStatus',
		'before' => 'auth.cpanel:users.view'
	));

	Route::put('users/{user}/throttling/{action}', array(
		'as'     => 'cpanel.users.throttling.update',
		'uses'   => 'Stevemo\Cpanel\Controllers\UsersThrottlingController@putStatus',
		'before' => 'auth.cpanel:users.update'
	));

	/*
	|--------------------------------------------------------------------------
	| Cpanel Login/Logout/Register Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('login', array(
		'as'   => 'cpanel.login',
		'uses' => 'Stevemo\Cpanel\Controllers\CpanelController@getLogin'
	));

	Route::get('logout', array(
		'as'   => 'cpanel.logout',
		'uses' => 'Stevemo\Cpanel\Controllers\CpanelController@getLogout'
	));

	Route::post('login','Stevemo\Cpanel\Controllers\CpanelController@postLogin');

	Route::get('register', array(
		'as'   => 'cpanel.register',
		'uses' => 'Stevemo\Cpanel\Controllers\CpanelController@getRegister'
	));

	Route::post('register','Stevemo\Cpanel\Controllers\CpanelController@postRegister');

	/*
	|--------------------------------------------------------------------------
	| Cpanel Password management Routes
	|--------------------------------------------------------------------------
	|
	|
	*/
	Route::get('password/forgot', array(
		'as'   => 'cpanel.password.forgot',
		'uses' => 'Stevemo\Cpanel\Controllers\PasswordController@getForgot'
	));

	Route::post('password/forgot','Stevemo\Cpanel\Controllers\PasswordController@postForgot');

	Route::get('password/reset/{code}', array(
		'as'   => 'cpanel.password.reset',
		'uses' => 'Stevemo\Cpanel\Controllers\PasswordController@getReset'
	));

	Route::post('password/reset',array(
		'as' => 'cpanel.password.update',
		'uses' => 'Stevemo\Cpanel\Controllers\PasswordController@postReset'
	));

	/*
	|--------------------------------------------------------------------------
	| My routers for module admin.news
	|--------------------------------------------------------------------------
	|
	|
	*/

	Route::get('news/', array(
		'as' => 'cpanel.news.index',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@index',
		'before' => 'auth.cpanel'
	));

	Route::get('news/add/{lang_code?}', array(
		'as' => 'cpanel.news.add',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@add',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}'));

	Route::get('news/edit/{id}/{lang_code?}', array(
		'as' => 'cpanel.news.add',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@edit',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::post('news/', array(
		'as' => 'cpanel.news.create',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@create',
		'before' => 'auth.cpanel'
	));

	Route::put('news/{id}/{lang_code?}', array(
		'as' => 'cpanel.news.update',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@update',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::get('news/{id}/{lang_code?}', array(
		'as' => 'cpanel.news.view',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@view',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::delete('news/{id}/', array(
		'as' => 'cpanel.news.delete',
		'uses' => 'Stevemo\Cpanel\Controllers\NewsController@delete',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	/*
	|--------------------------------------------------------------------------
	| My routers for module admin.rubrics
	|--------------------------------------------------------------------------
	|
	|
	*/

	Route::get('rubrics/', array(
		'as' => 'cpanel.rubrics.index',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@index',
		'before' => 'auth.cpanel'
	));

	Route::get('rubrics/add/{lang_code?}/{id?}/', array(
		'as' => 'cpanel.rubrics.add',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@add',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::get('rubrics/edit/{id}/{lang_code?}', array(
		'as' => 'cpanel.rubrics.edit',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@edit',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::post('rubrics/{id?}', array(
		'as' => 'cpanel.rubrics.create',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@create',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	Route::put('rubrics/{id}/{lang_code?}', array(
		'as' => 'cpanel.rubrics.update',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@update',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::get('rubrics/{id}/{lang_code?}', array(
		'as' => 'cpanel.rubrics.view',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@view',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::delete('rubrics/{id}/', array(
		'as' => 'cpanel.rubrics.delete',
		'uses' => 'Stevemo\Cpanel\Controllers\RubricsController@delete',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	/*
	|--------------------------------------------------------------------------
	| My routers for module admin.langs
	|--------------------------------------------------------------------------
	|
	|
	*/

	Route::get('langs/', array(
		'as' => 'cpanel.langs.index',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@index',
		'before' => 'auth.cpanel'
	));

	Route::get('langs/add/', array(
		'as' => 'cpanel.langs.add',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@add',
		'before' => 'auth.cpanel'
	));

	Route::get('langs/edit/{id}/', array(
		'as' => 'cpanel.langs.edit',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@edit',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	Route::post('langs/', array(
		'as' => 'cpanel.langs.create',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@create',
		'before' => 'auth.cpanel'
	));

	Route::put('langs/{id}/', array(
		'as' => 'cpanel.langs.update',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@update',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	Route::get('langs/{id}/', array(
		'as' => 'cpanel.langs.view',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@view',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	Route::delete('langs/{id}/', array(
		'as' => 'cpanel.langs.delete',
		'uses' => 'Stevemo\Cpanel\Controllers\LangsController@delete',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));

	/*
	|--------------------------------------------------------------------------
	| My routers for module admin.rubrics
	|--------------------------------------------------------------------------
	|
	|
	*/

	Route::get('pages/', array(
		'as' => 'cpanel.pages.index',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@index',
		'before' => 'auth.cpanel'
	));

	Route::get('pages/add/{lang_code?}', array(
		'as' => 'cpanel.pages.add',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@add',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}'));

	Route::get('pages/edit/{id}/{lang_code?}', array(
		'as' => 'cpanel.pages.edit',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@edit',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::post('pages/', array(
		'as' => 'cpanel.pages.create',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@create',
		'before' => 'auth.cpanel'
	));

	Route::put('pages/{id}/{lang_code?}', array(
		'as' => 'cpanel.pages.update',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@update',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::get('pages/{id}/{lang_code?}', array(
		'as' => 'cpanel.pages.view',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@view',
		'before' => 'auth.cpanel'
	))->where(array('lang_code' => '[a-z]{2}', 'id' => '\d+'));

	Route::delete('pages/{id}/', array(
		'as' => 'cpanel.pages.delete',
		'uses' => 'Stevemo\Cpanel\Controllers\PagesController@delete',
		'before' => 'auth.cpanel'
	))->where(array('id' => '\d+'));


	// UPLOADER
	Route::post('upload', array(
		'as' => 'cpanel.strorage.upload',
		'uses' => 'Stevemo\Cpanel\Controllers\StorageController@upload',
		'before' => 'auth.cpanel'
	));

});




/*
|--------------------------------------------------------------------------
| Admin auth filter
|--------------------------------------------------------------------------
| You need to give your routes a name before using this filter.
| I assume you are using resource. so the route for the UsersController index method
| will be admin.users.index then the filter will look for permission on users.view
| You can provide your own rule by passing a argument to the filter
|
*/
Route::filter('auth.cpanel', function($route, $request, $userRule = null)
{
	if (! Sentry::check())
	{
		Session::put('url.intended', URL::full());
		return Redirect::route('cpanel.login');
	}

	// no special route name passed, use the current name route
	if ( is_null($userRule) )
	{
		list($prefix, $module, $rule) = explode('.', Route::currentRouteName());
		switch ($rule)
		{
			case 'index':
			case 'show':
				$userRule = $module.'.view';
				break;
			case 'create':
			case 'store':
				$userRule = $module.'.create';
				break;
			case 'edit':
			case 'update':
				$userRule = $module.'.update';
				break;
			case 'destroy':
				$userRule = $module.'.delete';
				break;
			default:
				$userRule = Route::currentRouteName();
				break;
		}
	}
	// no access to the request page and request page not the root admin page
	if ( ! Sentry::hasAccess($userRule) and $userRule !== 'cpanel.view' )
	{
		return Redirect::route('cpanel.home')
			->with('error', Lang::get('cpanel::permissions.access_denied'));
	}
	// no access to the request page and request page is the root admin page
	else if( ! Sentry::hasAccess($userRule) and $userRule === 'cpanel.view' )
	{
		//can't see the admin home page go back to home site page
		return Redirect::to('/')
			->with('error', Lang::get('cpanel::permissions.access_denied'));
	}

});
