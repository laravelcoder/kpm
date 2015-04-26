<?php namespace Davzie\LaravelBootstrap\Controllers;
use Illuminate\Support\MessageBag;
use View, Redirect, Input, App, ReflectionClass, Request, Config, Response;
use Davzie\LaravelBootstrap\Core\Exceptions\EntityNotFoundException;

abstract class ObjectBaseController extends BaseController {

	/**
	 * language model instance
	 */
	public $lang_model;

	/**
	 * The model to work with for editing stuff
	 */
	protected $model;

	/**
	 * The place to find some standardised views (products, posts etc)
	 * @var string
	 */
	protected $view_key;

	/**
	 * The URL to get the root of this object (/admin/posts for example)
	 * @var string
	 */
	protected $object_url;

	/**
	 * The URL that is used to edit shit
	 * @var string
	 */
	protected $edit_url;

	/**
	 * The URL to create a new entry
	 * @var string
	 */
	protected $new_url;

	/**
	 * The URL to delete an entry
	 * @var string
	 */
	protected $delete_url;

	/**
	 * Is the controller allowed to upload images?
	 * @var boolean
	 */
	protected $uploadable;

	/**
	 * Is the controller allowed to have tags?
	 * @var boolean
	 */
	protected $taggable;

	/**
	 * Can items be deleted?
	 * @var boolean
	 */
	protected $deletable = true;


	protected $uploads_model;

	/**
	 * storage model
	 * @var object
	 */
	public $storage_model;

	/**
	 * By default a mass assignment is used to validate things on a model
	 * Sometimes you want to confirm inputs (such as password confirmations)
	 * that you don't want to be necessarily stored on the model. This will validate
	 * inputs from Input::all() not from $model->fill();
	 * @var boolean
	 */
	protected $validateWithInput = false;

	/**
	 * return saved id
	 * @var boolean
	 */
	protected $returnId = false;

	/**
	 * controller constructor
	 */
	public function __construct()
	{
		parent::__construct();
		$this->storage_model = App::make('Davzie\LaravelBootstrap\Storage\StorageInterface');
		$this->lang_model    = App::make('Davzie\LaravelBootstrap\Langs\LangsInterface');

		View::share('module', get_class($this));

		$this->setHandyUrls();
		$this->shareHandyUrls();
		$this->setTraitableProperties();
		$this->setViewObjectAbilities();
	}

	/**
	 * Main users page.
	 *
	 * @access   public
	 * @return   View
	 */
	public function getIndex()
	{
		View::share('items', $this->model->getAll());

		return View::make('laravel-bootstrap::'.$this->view_key.'.index');
	}

	/**
	 * The new object
	 * @access public
	 * @return View
	 */
	public function getNew() {
		if(!View::exists('laravel-bootstrap::'.$this->view_key.'.new')) {
			return App::abort(503, "View {$this->view_key}.new not found");
		}

		return View::make('laravel-bootstrap::'.$this->view_key.'.new');
	}

	/**
	 * The generic method for the start of editing something
	 * @return View
	 */
	public function getEdit($id)
	{
		try{
			$item = $this->model->requireById($id);
		} catch(EntityNotFoundException $e) {
			return Redirect::to($this->object_url)->with('errors', new MessageBag(array("An item with the ID:$id could not be found.")));
		}

		if(!View::exists('laravel-bootstrap::'.$this->view_key.'.edit'))
			return App::abort(404, 'Page not found');

		return View::make('laravel-bootstrap::'.$this->view_key.'.edit')
					->with('item' , $item);
	}

	/**
	 * Delete an object based on the ID passed in
	 * @param  integer $id The object ID
	 * @return Redirect
	 */
	public function getDelete($id) {
		if (\Hash::check('delete', Input::get('token')))
		{
			if($this->deletable == false) {
				return App::abort(404, 'Page not found');
			}

			$model = $this->model->getById($id)->delete();

			$message = 'Запис успішно видалено';
			return Redirect::back()
							 ->with('success', new MessageBag(array($message)));
		}

		return Redirect::back()
							 ->with('errors', new MessageBag(array('Доступ до сторінки заборонений')));
	}

	/**
	 * The new object method, very generic, just allows mass assignable stuff to be filled and saved
	 * @return Redirect
	 */
	public function postNew()
	{

		$record = $this->model->getNew(Input::all());

		$valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

		if(!$valid) {
			return Redirect::back()->withErrors($record->getErrors())->withInput();
		}

		// Run the hydration method that populates anything else that is required / runs any other
		// model interactions and save it.
		$record->save();

		// Redirect that shit man! You did good! Validated and saved, man mum would be proud!
		return Redirect::to($this->object_url)->with('success' , new MessageBag(array('Запис додано')));
	}

	/**
	 * The method to handle the posted data
	 * @param  integer $id The ID of the object
	 * @return Redirect
	 */
	public function postEdit($id)
	{
		$record = $this->model->requireById($id);
		$record->fill(Input::all());

		$valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

		if(!$valid) {

			return Redirect::to($this->edit_url.$id)->with('errors' , $record->getErrors())->withInput();
		}

		// Run the hydration method that populates anything else that is required / runs any other
		// model interactions and save it.
		$record->hydrateRelations()->save();

		// Redirect that shit man! You did good! Validated and saved, man mum would be proud!
		return Redirect::to($this->object_url)->with('success' , new MessageBag(array('Зміни збережено')));
	}


	/**
	 * Set the order of the images
	 * @return Response
	 */
	public function postOrderImages() {
		// This should only be accessible via AJAX you know...
		if(!Request::ajax())
			Response::json('error', 400);

		// Ensure that the product images that need to be deleted get deleted
		$this->uploads_model->setOrder(Input::get('data'));

		return Response::json('success', 200);
	}

	/**
	 * Set the URL's to be used in the views
	 * @return void
	 */
	private function setHandyUrls()
	{
		if(is_null($this->object_url))
			$this->object_url = url($this->urlSegment.'/'.$this->view_key);

		if(is_null($this->edit_url))
			$this->edit_url = $this->object_url.'/edit/';

		if(is_null($this->new_url))
			$this->new_url = $this->object_url.'/new';

		if(is_null($this->delete_url))
			$this->delete_url = $this->object_url.'/delete/';
	}

	/**
	 * Set the view to have variables detailing some of the key URL's used in the views
	 * Trying to keep views generic...
	 * @return void
	 */
	private function shareHandyUrls()
	{
		// Share these variables with any views
		View::share('object_url', $this->object_url);
		View::share('edit_url', $this->edit_url);
		View::share('new_url', $this->new_url);
		View::share('delete_url', $this->delete_url);
	}

	/**
	 * Set the view variables for this object. If you can upload tell it, if you can tag, tell it.
	 * @return void
	 */
	private function setViewObjectAbilities()
	{
		View::share('uploadable', $this->uploadable);
		View::share('taggable', $this->taggable);
	}

	/**
	 * Set the class properties for if this object should allow uploads or tags
	 * Uses reflection to check the model to see if it uses a taggable / uploadable trait
	 */
	private function setTraitableProperties()
	{
		if(is_null($this->taggable))
			$this->taggable = $this->model->getModel()->isTaggable();

		if(is_null($this->uploadable))
			$this->uploadable = $this->model->getModel()->isUploadable();

	}

	/**
     * toggle value of record column
     */
    public function postToggle($id)
    {
        if (!$record = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        $data['success'] = 0;

        if (\Input::has('value') && \Input::has('column')) {
            $value  = trim(\Input::get('value'));
            $column = trim(\Input::get('column'));

            if ($value == '1' || $value == '0') {
                if (isset($record->$column)) {
                    $record->$column = $value;
                    $record->save();
                    $data['success'] = 1;
                }
            }
        }

        return \Response::json($data);
    }

    /**
     *
     */
    public function getView($id)
    {
    	if (!$item = $this->model->requireById($id)) {
    		return \App::abort(404);
    	}

    	return View::make('laravel-bootstrap::'.$this->view_key.'.view')
					->with('item' , $item);
    }

}
