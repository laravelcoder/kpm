<?php namespace Davzie\LaravelBootstrap\Abstracts;
use Illuminate\Support\MessageBag;
use Validator;

abstract class ValidatorBase
{

	/**
	 * The rules for the validation
	 * @var array
	 */
	protected $rules;

	/**
	 * The messages generated
	 * @var MessageBag
	 */
	protected $messages = array();

	/**
	 * The data to validate against
	 * @var array
	 */
	protected $data;

	/**
	 *
	 */
	protected $errors;

	/**
	 * Construct shit
	 * @param array $data The array of data to validate against
	 */
	public function __construct($data)
	{
		$this->data = $data;
		$this->errors = new MessageBag();
	}

	/**
	 * Run the validation on the rules in the array
	 * @return boolean
	 */
	public function passes()
	{
		$validation = Validator::make($this->data , $this->rules, $this->messages);

		if ($validation->fails()) {
			$this->errors = $validation->messages();
			return false;
		}

		return true;
	}

	/**
	 * Return the MessageBag Instance
	 * @return MessageBag
	 */
	public function errors() {
		return $this->errors;
	}

}
