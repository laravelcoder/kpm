<?php

class Rubrics extends \Eloquent {
	protected $fillable = ['lang_id'];

	protected $table = 'rubrics';

	public $timestamps = false;

	public function lang()
	{
		return $this->hasOne('Langs', 'id', 'lang_id');
	}
}
