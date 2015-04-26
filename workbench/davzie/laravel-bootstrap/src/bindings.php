<?php

// The Posts Bindings
App::bind('Davzie\LaravelBootstrap\Posts\PostsInterface', function(){
	return new Davzie\LaravelBootstrap\Posts\PostsRepository( new Davzie\LaravelBootstrap\Posts\Posts );
});

// The Users Bindings
App::bind('Davzie\LaravelBootstrap\Accounts\UserInterface', function(){
	return new Davzie\LaravelBootstrap\Accounts\UserRepository( new Davzie\LaravelBootstrap\Accounts\User );
});

// The Settings Bindings
App::bind('Davzie\LaravelBootstrap\Settings\SettingsInterface', function(){
	return new Davzie\LaravelBootstrap\Settings\SettingsRepository( new Davzie\LaravelBootstrap\Settings\Settings );
});


// The Storage Bindings
App::bind('Davzie\LaravelBootstrap\Storage\StorageInterface', function(){
	return new Davzie\LaravelBootstrap\Storage\StorageRepository( new Davzie\LaravelBootstrap\Storage\Storage );
});

// The Galleries Bindings
App::bind('Davzie\LaravelBootstrap\Galleries\GalleriesInterface', function(){
	return new Davzie\LaravelBootstrap\Galleries\GalleriesRepository( new Davzie\LaravelBootstrap\Galleries\Galleries );
});


// The Roles Bindings
App::bind('Davzie\LaravelBootstrap\Roles\RolesInterface', function(){
	return new Davzie\LaravelBootstrap\Roles\RolesRepository( new Davzie\LaravelBootstrap\Roles\Roles );
});

// The Langs Bindings
App::bind('Davzie\LaravelBootstrap\Langs\LangsInterface', function(){
	return new Davzie\LaravelBootstrap\Langs\LangsRepository( new Davzie\LaravelBootstrap\Langs\Langs );
});

// The Rubrics Bindings
App::bind('Davzie\LaravelBootstrap\Rubrics\RubricsInterface', function(){
	return new Davzie\LaravelBootstrap\Rubrics\RubricsRepository( new Davzie\LaravelBootstrap\Rubrics\Rubrics );
});

// The News Bindings
App::bind('Davzie\LaravelBootstrap\News\NewsInterface', function(){
	return new Davzie\LaravelBootstrap\News\NewsRepository( new Davzie\LaravelBootstrap\News\News );
});

// The Pages Bindings
App::bind('Davzie\LaravelBootstrap\Pages\PagesInterface', function(){
	return new Davzie\LaravelBootstrap\Pages\PagesRepository( new Davzie\LaravelBootstrap\Pages\Pages );
});

// The Teachers Bindings
App::bind('Davzie\LaravelBootstrap\Teachers\TeachersInterface', function(){
	return new Davzie\LaravelBootstrap\Teachers\TeachersRepository( new Davzie\LaravelBootstrap\Teachers\Teachers );
});

// The Adverts Bindings
App::bind('Davzie\LaravelBootstrap\Adverts\AdvertsInterface', function(){
	return new Davzie\LaravelBootstrap\Adverts\AdvertsRepository( new Davzie\LaravelBootstrap\Adverts\Adverts );
});
// The Feedback Bindings
App::bind('Davzie\LaravelBootstrap\Feedback\FeedbackInterface', function(){
	return new Davzie\LaravelBootstrap\Feedback\FeedbackRepository( new Davzie\LaravelBootstrap\Feedback\Feedback );
});