<?php


/**
 *
 */

if (!function_exists('allowed')) {
	function allowed($module, $action) {
		return Access::check($module, $action);
	}
}

/**
 *
 */
if (!function_exists('site_url')) {
	function site_url() {
		$settings_model = \App::make('Davzie\LaravelBootstrap\Settings\SettingsInterface');
		return $settings_model->getByKey('site_url')->value;
	}
}

