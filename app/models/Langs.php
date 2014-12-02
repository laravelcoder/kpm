<?php

class Langs extends \Eloquent {
	/**
	 *
	 */
	protected $fillable = [];

	/**
	 *
	 */
	protected $table = 'langs';

	/**
	 *
	 */
	public $timestamps = false;

	/**
	 *
	 */
	public function rubrics()
	{
		return $this->hasMany('Rubrics', 'lang_id');
	}

	/**
	 *
	 */
	public function pages()
	{
		return $this->hasMany('Pages', 'lang_id');
	}

	/**
	 *
	 */
	public function news()
	{
		return $this->hasMany('News', 'lang_id');
	}

	/**
	 *
	 */
	public static function getByCode($code)
	{
		return self::where('code', '=', $code)->first();
	}

	/**
	 *
	 */
	public static function allWithoutDefault()
	{
		return self::where('code', '!=', '--')->get();
	}

	/**
	 *
	 */
	public static function hiddenId()
	{
		$lang = self::where('code', '=', '--')->first();

		return $lang->id;
	}

	/**
	 *
	 */
	public static function defaultLangCode()
	{
		if ($lang =  self::where('is_default', '=', 1)->first()) {
			return $lang->code;
		}

		return false;
	}

	/**
	 *
	 */
	public static function langIsset($code)
	{
		return ($lang = self::where('code', '!=', $code)->get()) == true;
	}
}
