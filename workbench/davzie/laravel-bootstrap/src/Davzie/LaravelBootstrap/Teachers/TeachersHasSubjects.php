<?php namespace Davzie\LaravelBootstrap\Teachers;
use Davzie\LaravelBootstrap\Core\EloquentBaseModel;

class TeachersHasSubjects extends EloquentBaseModel
{
    public $timestamps = false;
    /**
     * The table to get the data from
     * @var string
     */
    protected $table    = 'teachers_has_subjects';

    /**
     * subject
     */
    public function subject()
    {
    	return $this->belongsTo('Davzie\LaravelBootstrap\Subjects\Subjects', 'subject_id', 'id');
    }

}
