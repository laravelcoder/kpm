<?php namespace Stevemo\Cpanel\Rubrics\Repo;

interface CpanelRubricsInterface {

	/**
	 *
	 */
	public function findById($id, $lang_code);

	/**
	 *
	 */
	public function findByIdWithLangId($id, $lang_id);

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
	public function create(array $attributes, $id = null);

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

	/**
	 *
	 */
	public function createHiddenRecord($data, $id);

}
