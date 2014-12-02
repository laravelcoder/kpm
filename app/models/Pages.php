<?php

class Pages extends \Eloquent {
	protected $fillable = ['lang_id'];

	protected $table = 'pages';

	public $timestamps = false;

	public function lang()
	{
		return $this->hasOne('Langs', 'id', 'lang_id');
	}

	/**
	 *
	 */
	public function findWithoutId($id)
	{
		return $this->where('id', '!=', $id)->get();
	}
}
