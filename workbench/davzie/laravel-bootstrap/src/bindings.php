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

// The Blocks Bindings
App::bind('Davzie\LaravelBootstrap\Blocks\BlocksInterface', function(){
	return new Davzie\LaravelBootstrap\Blocks\BlocksRepository( new Davzie\LaravelBootstrap\Blocks\Blocks );
});

// The Tags Bindings
App::bind('Davzie\LaravelBootstrap\Tags\TagsInterface', function(){
	return new Davzie\LaravelBootstrap\Tags\TagsRepository( new Davzie\LaravelBootstrap\Tags\Tags );
});

// The Galleries Bindings
App::bind('Davzie\LaravelBootstrap\Galleries\GalleriesInterface', function(){
	return new Davzie\LaravelBootstrap\Galleries\GalleriesRepository( new Davzie\LaravelBootstrap\Galleries\Galleries );
});

// The Teachers Bindings
App::bind('Davzie\LaravelBootstrap\Teachers\TeachersInterface', function(){
	return new Davzie\LaravelBootstrap\Teachers\TeachersRepository( new Davzie\LaravelBootstrap\Teachers\Teachers );
});

// The Roles Bindings
App::bind('Davzie\LaravelBootstrap\Roles\RolesInterface', function(){
	return new Davzie\LaravelBootstrap\Roles\RolesRepository( new Davzie\LaravelBootstrap\Roles\Roles );
});
