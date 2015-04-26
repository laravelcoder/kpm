<?php

class Storage extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;

	/**
	 *
	 */
	protected $table = 'storage';

	/**
	 *
	 */
	public function news()
	{
		 return $this->hasMany('Davzie\LaravelBootstrap\News\News', 'photo_storage_id', 'id');
	}

	/**
	 *
	 */
	public function parent()
	{
		 return $this->hasMany('Davzie\LaravelBootstrap\Storage\Storage', 'parent_id', 'id');
	}
}
