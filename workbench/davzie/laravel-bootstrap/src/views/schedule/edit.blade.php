@extends('laravel-bootstrap::layouts.interface-edit')

@section('title')
    Редагування розкладу
@stop

@section('heading')
    <h1>Редагування розкладу <small>Група {{$group->title}}</small></h1>
@stop

@section('form-items')

    <h3>Вибір викладача та предмета</h3>

    <div class="form-group">
        {{ Form::label( "name" , 'Факультет' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "faculty_id" , ['' => ''] + $faculties, Input::old( "faculty_id", $item->teacher->department->faculty_id ) , array( 'class'=>'form-control js-select-dropdown', 'data-url' => '/api/departments/' , 'data-target' => '[name=department_id]', 'placeholder'=>'Факультет' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Кафедра' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "department_id" , ['' => ''] + $departments, Input::old( "department_id",$item->teacher->department->id ) , array( 'class'=>'form-control js-select-dropdown', 'data-url' => '/api/department-teachers/' , 'placeholder'=>'Кафедра', 'data-target' => '[name=teacher_id]' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Викладач' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "teacher_id" , ['' => ''] + $teachers, Input::old( "teacher_id", $item->teacher->id ) , array( 'class'=>'form-control js-select-dropdown', 'data-url' => '/api/teachers-subjects/' , 'placeholder'=>'Викладач','data-target' => '[name=subject_id]', ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Предмет' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "subject_id" , ['' => ''] + $subjects, Input::old( "subject_id", $item->subject_id ) , array( 'class'=>'form-control', 'placeholder'=>'Предмет' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Тип заняття' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "subject_type_id" , $subj_types, Input::old( "subject_type_id", $item->subject_type_id ) , array( 'class'=>'form-control ', 'data-url' => '' , 'placeholder'=>'Тип заняття' ) ) }}
        </div>
    </div>

    <h3>Корпус та аудиторія</h3>

    <div class="form-group">
        {{ Form::label( "name" , 'Корпус' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "building_id" , ['' => ''] + $buildings, Input::old( "building_id", $item->classroom->building_id ) , array( 'class'=>'form-control js-select-dropdown', 'data-url' => '/api/classrooms/' , 'placeholder'=>'Корпус', 'data-target' => '[name=classroom_id]' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Аудиторія' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "classroom_id" , ['' => ''] + $classrooms, Input::old( "classroom_id", $item->classroom_id ) , array( 'class'=>'form-control', 'placeholder'=>'Аудиторія' ) ) }}
        </div>
    </div>

    <h3>Дати занять</h3>

    <div class="form-group">
        {{ Form::label( "name" , 'Тижні' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            {{ Form::select( "weeks[]" , $weeks, Input::old( "weeks[]", $weeksOld ) , array( 'class'=>'form-control sel2', 'multiple' ) ) }}
        </div>
    </div>

    <div class="form-group">
        {{ Form::label( "name" , 'Дні та номери занять' , array( 'class'=>'col-lg-2 control-label' ) ) }}
        <div class="col-lg-10">
            <span class="lead">Відьмітьте пари для цього заняття</span>
            <p style="border-bottom: 1px solid #eee; padding-bottom: 5px;">
                @foreach ($days as $day_id => $day)
                    <span class="schedule-cell head">{{$day}}</span>
                @endforeach
            </p>
            @foreach ($bells_schedules as $lesson_id => $lesson)
                <p style="border-bottom: 1px solid #eee; padding-bottom: 5px;">
                    @foreach ($days as $day_id => $day)
                        @if (!empty($daysOld[$day_id][$lesson_id]))
                            <button type="button" class="btn btn-xs btn-success schedule-cell js-toogle-lesson">{{$lesson}} <input type="checkbox" style="display: none;" name="day[{{$day_id}}][{{$lesson_id}}]" value="1" checked>
                        @else
                            <button type="button" class="btn btn-xs btn-default schedule-cell js-toogle-lesson">{{$lesson}} <input type="checkbox" style="display: none;" name="day[{{$day_id}}][{{$lesson_id}}]" value="1">
                        @endif
                        </button>
                    @endforeach
                </p>
            @endforeach
            <input type="hidden" name="group_id" value="{{$group->id}}">
        </div>
    </div>


@stop

@section('form-additional-block')
    <a href="{{route('schedule', $group->id)}}" class="btn btn-danger">Назад</a>
@stop
