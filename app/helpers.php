<?php


/**
 *
 */
function allowed($module, $action) {
	return Access::check($module, $action);
}

/**
 *
 */
function site_url() {
	$settings_model = \App::make('Davzie\LaravelBootstrap\Settings\SettingsInterface');
	return $settings_model->getByKey('site_url')->value;
}
