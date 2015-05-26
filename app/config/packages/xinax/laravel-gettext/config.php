<?php

return array(

	/**
	 * Default locale: this will be the default for your application.
	 * Is to be supposed that all strings are written in this language.
	 */
	'locale' => 'uk_UA',

	/**
	 * Supported locales: An array containing all allowed languages
	 */
	'supported-locales' => array(
		'en_US',
		'ru_RU',
		'uk_UA'
	),

	/**
	 * Default charset encoding.
	 */
	'encoding' => 'UTF-8',

	/**
	 * -----------------------------------------------------------------------
	 * All standard configuration ends here. The following values
	 * are only for special cases.
	 * -----------------------------------------------------------------------
	 **/

	/**
	 * Fallback locale: When default locale is not available
	 */
	'fallback-locale' => 'en_US',

	/**
	 * Domain used for translations: It is the file name for .po and .mo files
	 */
	'domain' => 'messages',

	/**
	 * Base translation directory path (don't use trailing slash)
	 */
	'translations-path' => 'lang',

	/**
	 * Project name: is used on .po header files
	 */
	'project' => 'MultilanguageLaravelApplication',

	/**
	 * Translator contact data (used on .po headers too)
	 */
	'translator' => 'James Translator <james@translations.colm>',

	/**
	 * Paths where PoEdit will search recursively for strings to translate.
	 * All paths are relative to app/ (don't use trailing slash).
	 *
	 * If you have already .po files with translations and the need to add
	 * another directory remember to call artisan gettext:update after do this.
	 */
	'source-paths' => array(
		'controllers',
		'models',
		'views',
	),

	/**
	 * Sync laravel: A flag that determines if the laravel built-in locale must
	 * be changed when you call LaravelGettext::setLocale.
	 */
	'sync-laravel' => true,

);
