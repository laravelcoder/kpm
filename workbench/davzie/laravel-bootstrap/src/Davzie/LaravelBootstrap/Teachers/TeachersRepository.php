<?php namespace Davzie\LaravelBootstrap\Teachers;
use Davzie\LaravelBootstrap\Core\EloquentBaseRepository;
use Davzie\LaravelBootstrap\Teachers\Teachers;
use Davzie\LaravelBootstrap\Departments\Departments;

class TeachersRepository extends EloquentBaseRepository implements TeachersInterface
{

    /**
     * Construct Shit
     * @param Teachers $model
     */
    public function __construct(Teachers $model)
    {
        $this->model = $model;
    }

    /**
     * get teachers by department id
     */
    public function getByDepartmentId($id)
    {
        return $this->model->where('department_id', '=', $id)->with('department')->paginate(\Config::get('app.limit'));
    }

    /**
     *
     */
    public function getDepartment($id)
    {
        if (!$group = Departments::find($id)) {
            return false;
        }

        return Departments::with('faculty')->find($id);
    }

    /**
     *
     */
    public function getDepartments()
    {
        $faculties = Departments::all();
        $res = [];

        foreach ($faculties as $faculty) {
            $res[$faculty->id] = $faculty->name;
        }

        return $res;
    }

    /**
     * get teacher subjects
     */
    public function getSubjects($id)
    {
        return TeachersHasSubjects::where('teacher_id', '=', $id)->with('subject')->get();
    }

    /**
     * delete teacher subject
     */
    public function deleteTeacherSubject($id, $subject_id)
    {
        return TeachersHasSubjects::where('teacher_id', '=', $id)->where('subject_id', '=', $subject_id)->delete();
    }
}
