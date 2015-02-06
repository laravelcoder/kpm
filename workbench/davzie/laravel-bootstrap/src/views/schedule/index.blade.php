@extends('laravel-bootstrap::layouts.interface')

@section('title')
    Розклад занять
@stop

@section('breadcrumbs')
    <li><a href="{{route('universities')}}">Університети</a></li>
    <li class="active">{{$group->faculty->university->name}}</li>
    <li><a href="{{route('faculties', array($group->faculty->university_id))}}">Факультети</a></li>
    <li><a href="{{route('groups', array($group->faculty->id))}}">Групи</a></li>
    <li class="active">Розклад занять</li>
@stop

@section('content')

    <h1>Розклад занять</h1><h3>Група {{$group->title}}</h3>

    {{-- The error / success messaging partial --}}
    @include('laravel-bootstrap::partials.messaging')

    <div class="form-group">
        <form action="">
            Тиждень:&nbsp;&nbsp;
            {{Form::select('week_id', $weeks, Input::get('week_id'), array('class' => 'form-control', 'style'=>"display: inline; width: 300px;"))}}
            &nbsp;&nbsp;
            <button style="display: inline;" type="submit" class="btn btn-success">Перегляд</button>
            @if (allowed('schedule', 'deleteAll'))
            <a href="{{$object_url. '/delete-all/' . $group->id .
            '/?token='.Hash::make('delete')}}" class="btn btn-danger js-delete pull-right" data-message="Після продовження увесь розклад буде видалено. Продовжити?"><i class="icon icon-trash"></i> Видалити все</a>
            @endif
            @if (allowed('schedule', 'new'))
            <a href="{{route('scheduleAdd', $id)}}" class="btn btn-success pull-right" style="margin-right: 5px;"><i class="glyphicon glyphicon-plus"></i> Додати</a>
            @endif&nbsp;&nbsp;

        </form>
    </div>

    <table class="table table-bordered table-stripped">
        @foreach ($days as $d_k => $day)
            <tr>
                <td width="100">Пара</td>
                <td style="text-align:center;">{{$day}}</td>
            </tr>
            @foreach ($bells_schedules as $key => $one)
            <tr>
                <td style="text-align:center;">{{$one['time_start']}}<br><i class="icon icon-time"></i><br>{{$one['time_end']}}</td>
                <td>
                    @if (isset($schedule[$d_k][$key]))
                    @foreach ($schedule[$d_k][$key] as $index => $lesson)
                        <div class="pull-left">
                            <b>{{$lesson['subject']}}</b><br>
                            {{$lesson['teacher']['surname']}} {{$lesson['teacher']['name']}} {{$lesson['teacher']['last_name']}}
                            <br>
                            {{$lesson['type']}}
                        </div>

                        <div class="pull-right">
                            &nbsp;&nbsp;&nbsp;&nbsp;
                            <div class="btn-group">
                                <button class="btn btn-default btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">Опції <span class="caret"></span></button>
                                <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                    @if (allowed('schedule', 'edit'))
                                    <li><a href="{{$object_url.'/edit/'. $lesson['id'] . '/?week_id='.$week_id}}">
                                    <i class="glyphicon glyphicon-edit"></i> Редагувати</a></li>
                                    @endif
                                    @if (allowed('schedule', 'delete'))
                                    <li><a href="{{$delete_url.$lesson['id']. '/'.$lesson['day'].'/'.$lesson['bells_schedule_id'].'/?token='.Hash::make('delete')}}" class="js-delete" data-message="Видалити?"><i class="glyphicon glyphicon-trash"></i> Видалити</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>

                        <div class="pull-right">
                            {{$lesson['building']}} <br>
                            Аудиторія: {{$lesson['classroom']}}
                        </div>
                        @if ($index+1!=count($schedule[$d_k][$key]))
                            <div class="clearfix"></div>
                            <hr>
                        @endif
                    @endforeach
                    @endif
                </td>
            </tr>
            @endforeach
        @endforeach
    </table>
@stop
