@extends('laravel-bootstrap::layouts.interface')

@section('title')
    {{ $app_name }}
@stop

@section('content')

    <h1>Welcome To {{ $app_name }}</h1>
    <p>Основні можливості управління:</p>
    <ul>
        <li>Предмети</li>
        <li>Факультети</li>
        <li>Кафедри</li>
        <li>Викладачі</li>
        <li>Групи</li>
        <li>Розклад дзвінків</li>
        <li>Розклад занятть</li>
    </ul>
    {{--<div class="form-actions">
    	<div class=" panel panel-default">
    		<div class="panel-body">
				<div class="btn-group">
					<a href="#" class="btn btn-primary active disabled ">uk</a><a href="http://localhost:8000/admin/rubrics/add/ru" class="btn btn-default">ru</a>					<a href="http://localhost:8000/admin/rubrics/add/en" class="btn btn-default">en</a>
				</div>
			</div>
		</div>
	</div>--}}

@stop