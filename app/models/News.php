<?php

class News extends \Eloquent {
	protected $fillable = [];

	public $timestamps = false;

	public function lang()
	{
		return $this->belongsTo('Langs', 'lang_id');
	}
}
