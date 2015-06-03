<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Accounts\UserInterface;
use Davzie\LaravelBootstrap\Accounts\UserPassword;
use Illuminate\Support\MessageBag;
use Input, Redirect;

class UsersController extends ObjectBaseController {

    /**
     *
     */
    protected $returnId = true;
    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'users';

    /**
     * By default a mass assignment is used to validate things on a model
     * Sometimes you want to confirm inputs (such as password confirmations)
     * that you don't want to be necessarily stored on the model. This will validate
     * inputs from Input::all() not from $model->fill();
     * @var boolean
     */
    protected $validateWithInput = true;

    /**
     * Construct Shit
     */
    public function __construct(UserInterface $users)
    {
        $this->model = $users;
        parent::__construct();
    }

    /**
     * get New
     */
    public function getNew()
    {
        $roles = $this->model->getRoles();
        \View::share('roles', $roles);

        return parent::getNew();
    }

    /**
     * get Edit
     */
    public function getEdit($id)
    {
        $roles = $this->model->getRoles();
        \View::share('roles', $roles);

        if (!$item = $this->model->requireById($id)) {
            \App::abort(404);
        }

        $group_roles = [];
        foreach ($item->roles as $one)
        {
            $group_roles[] = $one->id;
        }

        $item->roles = $group_roles;

        return \View::make('laravel-bootstrap::'.$this->view_key.'.edit')
                    ->with('item' , $item);
    }

    /**
     * post new
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

        $this->model->saveItems(\Input::get('role_id'), $record->id);

        // Redirect that shit man! You did good! Validated and saved, man mum would be proud!
        return \Redirect::to($this->object_url)->with('success' , new MessageBag(array('Запис додано')));
    }

    /**
     * post edit
     */
    public function postEdit($id)
    {
        if (!$record = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        $record->fill(Input::all());

        $valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

        if(!$valid) {
            return Redirect::to($this->edit_url.$id)->with('errors' , $record->getErrors())->withInput();
        }

        // Run the hydration method that populates anything else that is required / runs any other
        // model interactions and save it.
        $record->hydrateRelations()->save();

        $this->model->updateItems(\Input::get('role_id'), $id);
        return \Redirect::to($this->object_url)->with('success' , new MessageBag(array('Інформацію оновлено')));
    }

    /**
     * select user action
     */
    public function getSelect($id = null)
    {
        $users = $this->model->getUsersList($id);

        return \View::make('laravel-bootstrap::'.$this->view_key.'.select')
                     ->with('items' , $users);
    }

    /**
     *
     */
    public function postSelect($id)
    {
        if (\Input::get('id')) {
            $user_id = \Input::get('id');
            if ($this->model->addUniversityUser($id, $user_id)) {
                return \Response::json(['success' => 1]);
            }
        }

        return \Response::json(['success' => 0]);
    }

    /**
     * get password edit page
     */
    public function getPassword($id)
    {
        if (!$item = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        return \View::make('laravel-bootstrap::'.$this->view_key.'.password')
                    ->with('item' , $item);
    }

    /**
     *
     */
    public function postPassword($id)
    {
        // change model to UserPassword from User
        $this->model->setModel(new UserPassword);

        if (!$record = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        $record->fill(Input::all());

        $valid = $record->isValid(Input::all());

        if(!$valid) {
            return Redirect::back()->with('errors' , $record->getErrors())->withInput();
        }

        // Run the hydration method that populates anything else that is required / runs any other
        // model interactions and save it.
        $record->hydrateRelations()->save();

        return \Redirect::to($this->object_url)->with('success' , new MessageBag(array('Пароль оновлено')));
    }

    /**
     * get profile
     */
    public function getProfile()
    {
        $id = \Auth::id();

        $roles = $this->model->getRoles();
        \View::share('roles', $roles);

        if (!$item = $this->model->requireById($id)) {
            \App::abort(404);
        }

        $group_roles = [];
        foreach ($item->roles as $one)
        {
            $group_roles[] = $one->id;
        }

        $item->roles = $group_roles;

        return \View::make('laravel-bootstrap::'.$this->view_key.'.profile')
                    ->with('item' , $item);
    }

    /**
     * get change own password
     */
    public function getOwnPassword()
    {
        $id = \Auth::id();

        if (!$item = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        return \View::make('laravel-bootstrap::'.$this->view_key.'.own-password')
                    ->with('item' , $item);
    }

    /**
     * change password
     */
    public function postOwnPassword()
    {
        $id = \Auth::id();
         // change model to UserPassword from User
        $this->model->setModel(new UserPassword);

        if (!$record = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        $record->fill(Input::all());

        $valid = $record->isValid(Input::all());

        if(!$valid) {
            return Redirect::back()->with('errors' , $record->getErrors())->withInput();
        }

        // Run the hydration method that populates anything else that is required / runs any other
        // model interactions and save it.
        $record->hydrateRelations()->save();

        return \Redirect::to($this->object_url .'/profile/')->with('success' , new MessageBag(array('Пароль оновлено')));
    }

    /**
     * update profile
     */
    public function postProfile()
    {
        $id = \Auth::id();
        if (!$record = $this->model->requireById($id)) {
            return \App::abort(404);
        }

        $record->fill(Input::all());

        $valid = $this->validateWithInput === true ? $record->isValid(Input::all()) : $record->isValid();

        if(!$valid) {
            return Redirect::to($this->edit_url.$id)->with('errors' , $record->getErrors())->withInput();
        }

        // Run the hydration method that populates anything else that is required / runs any other
        // model interactions and save it.
        $record->hydrateRelations()->save();

        return \Redirect::to($this->object_url . '/profile/')->with('success' , new MessageBag(array('Інформацію оновлено')));
    }

}
