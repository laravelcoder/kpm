<?php namespace Stevemo\Cpanel\Langs\Repo;

interface CpanelLangsInterface {

	public function findById($id);

	/**
	 * Returns all groups.
	 *
	 * @return array  $groups
	 */
	public function findAll();

	/**
	 * Creates a group.
	 *
	 * @param  array  $attributes
	 *
	 * @return \Cartalyst\Sentry\Groups\GroupInterface
	 */
	public function create(array $attributes);

	/**
	 * Update a group
	 *
	 * @param array $attributes
	 *
	 * @return bool
	 */
	public function update(array $attributes, $id);

	/**
	 * Delete a group
	 *
	 * @param $id
	 *
	 * @return void
	 */
	public function delete($id);

}
