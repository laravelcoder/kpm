<?php namespace Davzie\LaravelBootstrap;


class Access {
	/**
	 *
	 */
	public static $rules = [];

	/**
	 *
	 */
	protected static $session = [];

	/**
	 *
	 */
	public static function __callStatic($name, $arguments) {
		$name = ucfirst($name);
        list($rule, $alias, $enabled) = $arguments;

        self::$rules[$name]['rules'][$rule]['alias'] = $alias;
        self::$rules[$name]['rules'][$rule]['enabled'] = (bool)$enabled;
    }

	/**
	 *
	 */
	private static function getDefaultActions()
	{
		return [
			'index' => 'Список',
			'new' => 'Додавання',
			'view' => 'Перегляд',
			'edit' => 'Редагування',
			'delete' => 'Видалення',
		];
	}

	/**
	 *
	 */
	private static function prepareDefaultActions($enabled)
	{
		$actions = self::getDefaultActions();
		$rules = [];

		foreach ($actions as $action => $alias) {
			$rules["{$action}"]['enabled'] = $enabled;
			$rules["{$action}"]['alias']   = $alias;
		}

		return $rules;
	}

	/**
	 *
	 */
	public static function module($name, $alias, $enabled = true, $crud = true)
	{
		$defaultActions = [];

		if ($crud) {
			$defaultActions = self::prepareDefaultActions($enabled);
		}

		self::$rules[$name] = [
			'alias' => $alias,
			'enabled' => $enabled,
			'rules' => $defaultActions,
		];
	}

	/**
	 *
	 */
	public static function get()
	{
		return self::$rules;
	}

	/**
	 *
	 */
	public static function check($module, $rule)
	{
		$module = ucfirst($module);
		$perms = \Session::get('perms');
		$perms = json_decode($perms, true);

		if (!empty($perms)) {

			if (isset($perms[$module])) {
				if (isset($perms[$module][$rule])) {
					return $perms[$module][$rule];
				}
			}
		}

		if (!isset(self::$rules[$module])) {
			return false;
		}

		if (!isset(self::$rules[$module]['rules'][$rule])) {
			return false;
		}

		return (bool)self::$rules[$module]['rules'][$rule]['enabled'];
	}

	/**
	 *
	 */
	protected function writeToSession()
	{
		foreach (self::$rules as $key => $module) {
			foreach ($module['rules'] as $rk => $rule) {
				if (!isset(self::$session[$key][$rk])) {
					self::$session[$key][$rk] = $rule['enabled'];
				}
			}
		}
	}


}