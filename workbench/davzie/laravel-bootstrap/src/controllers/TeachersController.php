<?php namespace Davzie\LaravelBootstrap\Controllers;
use Davzie\LaravelBootstrap\Teachers\TeachersInterface;

class TeachersController extends ObjectBaseController {

    /**
     * The place to find the views / URL keys for this controller
     * @var string
     */
    protected $view_key = 'teachers';

    /**
     * Construct Shit
     */
    public function __construct(TeachersInterface $model)
    {
        $this->model = $model;
        parent::__construct();
    }

    /**
     * get teachers list for department with $id
     *
     * @param int $id
     */
    public function getIndex($id = null)
    {
        // if not $id
        if (!$id || !$department = $this->model->getDepartment($id)) {
            return \App::abort(404, 'Not found');
        }

        //
        $teachers = $this->model->getByDepartmentId($id);

        //
        return \View::make('laravel-bootstrap::'.$this->view_key.'.index')
                     ->with('items' , $teachers)
                     ->with('id' , $id)
                     ->with('department', $department);
    }

    /**
     * add new teacher
     */
    public function getNew($department_id = null)
    {
        $department = $this->model->getDepartment($department_id);
        \View::share('department', $department);

        return parent::getNew();
    }

    /**
     * edit  teacher
     */
    public function getEdit($id)
    {
        if (!$teacher = $this->model->find($id)) {
            \App::abort(404, 'Not found');
        }

        $department = $this->model->getDepartment($teacher->department_id);
        \View::share('department', $department);

        return parent::getEdit($id);
    }

    /**
     * add teacher POST-method
     */
    public function postNew()
    {
        // die;
        $this->object_url .= '/' . \Input::get('department_id');
        return parent::postNew();
    }

    /**
     * edit teacher POST-method
     */
    public function postEdit($id)
    {
        $this->object_url .= '/' . \Input::get('faculty_id');
        return parent::postEdit($id);
    }

    /**
     *
     */
    public function getSubjects($id)
    {
        $subjects = $this->model->getSubjects($id);

        try{
            $item = $this->model->requireById($id);
        } catch(EntityNotFoundException $e) {
            return Redirect::to($this->object_url)->with('errors', new MessageBag(array("Запису з номером:$id не знайдено.")));
        }

        if(!\View::exists('laravel-bootstrap::'.$this->view_key.'.subjects'))
            return App::abort(404);

        return \View::make('laravel-bootstrap::'.$this->view_key.'.subjects')
                    ->with('item' , $item)
                    ->with('id' , $id)
                    ->with('subjects', $subjects);
    }

    /**
     * remove teacher subjects
     */
    public function postRemoveSubject($id)
    {
        //
        if (\Input::get('id')) {
            $subject_id = \Input::get('id');

            if ($this->model->deleteTeacherSubject($id, $subject_id)) {
                return \Response::json(['success' => 1]);
            }
        }

        return \Response::json(['success' => 0]);
    }

}
