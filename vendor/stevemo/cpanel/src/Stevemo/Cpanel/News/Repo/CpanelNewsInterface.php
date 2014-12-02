<?php namespace Stevemo\Cpanel\News\Repo;

interface CpanelNewsInterface {

	/**
	 *
	 */
	public function findById($id, $lang_code);

	/**
	 * Find the group by name.
	 *
	 */
	public function findBySlug($slug);

	/**
	 * Returns all groups.
	 *
	 * @return array  $groups
	 */
	public function findAll($lang_code);

	/**
	 * Creates a group.
	 *
	 * @author Steve Montambeault
	 * @link   http://stevemo.ca
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
