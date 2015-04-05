<?php

class StorageJoin extends \Eloquent {
	/**
	 *
	 */
	protected $fillable = [];

	public $timestamps = false;

	/**
	 *
	 */
	protected $table = 'storage_join';

	/**
	 *
	 */
	public function file()
	{
		return $this->belongsTo('Storage', 'storage_id');
	}
}
