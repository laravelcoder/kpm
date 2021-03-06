<?php namespace Davzie\LaravelBootstrap\Core;
use Davzie\LaravelBootstrap\Core\Exceptions\NoValidationRulesFoundException;
use Validator, Eloquent, ReflectionClass, Input;
use Illuminate\Database\Eloquent\Builder;

/**
 * Base Eloquent Class Built On From Shawn McCool <-- This guy is pretty amazing
 */
class EloquentBaseModel extends Eloquent
{
	/**
	 * rules
	 */
	protected $validationRules = [];

	/**
	 * validator
	 */
	protected $validator;

	/**
	 * messages
	 */
	protected $messages = [];

	/**
	 *
	 */
	protected $common_fields = [];


	/**
	 *
	 */
	public function getCommonFields()
	{
		return $this->common_fields;
	}

	/**
	 *
	 */
	public function withOut(array $fields)
	{
		foreach ($fields as $field) {
			if (isset($this->validationRules[$field])) {
				unset($this->validationRules[$field]);
			}
		}

		return $this;
	}

	/**
	 *
	 */
	public function isValid( $data = array() )
	{
		if ( ! isset($this->validationRules)) {
			throw new NoValidationRulesFoundException('no validation rules found in class ' . get_called_class());
		}

		$this->validationRules = $this->getPreparedRules();

		if (empty($this->validationRules)) {
			return true;
		}

		if(!$data) {
			$data = $this->getAttributes();
		}

		$this->validator = Validator::make($data , $this->validationRules, $this->messages);

		return $this->validator->passes();
	}

	/**
	 * errors
	 */
	public function getErrors()
	{
		return $this->validator->errors();
	}

	protected function getPreparedRules()
	{
		if (!$this->validationRules) {
			return [];
		}

		$preparedRules = $this->replaceIdsIfExists($this->validationRules);

		return $preparedRules;
	}

	protected function replaceIdsIfExists($rules)
	{
		$preparedRules = [];

		foreach ($rules as $key => $rule) {

			if (is_array($rule)) {
				foreach ($rule as &$item) {
					if (false !== strpos($item, "<id>")) {
						if ($this->exists) {
							$item = str_replace("<id>", $this->getAttribute($this->primaryKey), $item);
						} else {
							$item = str_replace("<id>", "", $item);
						}
					}
				}
			} else {
				if (false !== strpos($rule, "<id>")) {
					if ($this->exists) {
						$rule = str_replace("<id>", $this->getAttribute($this->primaryKey), $rule);
					} else {
						$rule = str_replace("<id>", "", $rule);
					}
				}
			}

			$preparedRules[$key] = $rule;
		}

		return $preparedRules;
	}

	/**
	 * Hydrate the model with more stuff and
	 * @return this
	 */
	public function hydrateRelations()
	{
		if( $this->isTaggable() )
			$this->saveTags();

		if( $this->isUploadable() )
			$this->deleteImagery( Input::get('deleteImage') );

		return $this;
	}

	/**
	 * Delete method overrid
	 * @return void
	 */
	public function delete()
	{
		if( $this->isTaggable() )
			$this->saveTags('');

		if( $this->isUploadable() )
			$this->deleteAllImagery();


		return parent::delete();
	}

	/**
	 * Figure out if tags can be used on the model
	 * @return boolean
	 */
	public function isTaggable()
	{
		return in_array( 'Davzie\LaravelBootstrap\Abstracts\Traits\TaggableRelationship' , ( new ReflectionClass( $this ) )->getTraitNames() );
	}

	/**
	 * Figure out if you can upload stuff here
	 * @return boolean
	 */
	public function isUploadable()
	{
		return in_array( 'Davzie\LaravelBootstrap\Abstracts\Traits\UploadableRelationship' , ( new ReflectionClass( $this ) )->getTraitNames() );
	}

	/**
	 * Return the table name
	 * @return string
	 */
	public function getTableName()
	{
		return $this->table;
	}

	/**
	 *
	 */
	protected function setKeysForSaveQuery(Builder $query)
    {
        $keys = $this->getKeyName();

        if (!is_array($keys)) {
        	$query = $query->where($keys, '=', $this->getAttribute($keys));
        } else {
	        foreach ($keys as $key) {
	        	$query = $query->where($key, '=', $this->getAttribute($key));
	        }
	    }

        return $query;
    }

}
