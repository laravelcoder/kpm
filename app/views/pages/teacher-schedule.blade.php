@extends('base')

@section('title') {{_('Розклад для студентів')}} @stop

@section('content')
	<div class="single">
		<div class="container">
			  <div class="col-md-9">
				<div class="grid_1 left">
					<h4 class="top-header">{{_('Розклад занять')}}</h4>
				</div>
				<div class="grid_1">
					<div class="schedule-filter">
						<form action="">
							<label>{{_('Викладач')}}</label>
							{{ Form::select( "teacher" , $teachers, Input::old( "teacher", $teacher ) , array( 'class'=>'form-control col-sm-6 input-small') ) }}
							<label>{{_('Тиждень')}}</label>
							{{ Form::select( "week" , $weeks, Input::old( "week", $week ) , array( 'class'=>'form-control col-sm-6 input-small') ) }}
							<button class="btn btn-default" type="submit">{{_('Вибрати')}}</button>
						</form>
					</div>
					@foreach ($schedule as $day => $day_lessons)
						<table class="table table-bordered schedule">
							<tr>
								<th>{{_('Час')}}</th>
								<th colspan="3">{{$days[$day]}} {{date('d.m.Y', ($day-1)*$delta+$current['time_start'])}}</th>
							</tr>
							@foreach ($day_lessons as $lessons)
								@if (count($lessons) == 1)
									@foreach ($lessons as $lesson)
										<tr>
											<td>{{$lesson['time_start']}} <br><i class="fa fa-clock-o"></i><br> {{$lesson['time_end']}}</td>
											<td>{{$lesson['subject']}}</td>
											<td>{{$lesson['teacher']['surname']}} {{Str::limit($lesson['teacher']['name'], 1, '.')}} {{Str::limit($lesson['teacher']['last_name'], 1, '.')}}</td>
											<td>{{$lesson['educational_building']}},<br> {{$lesson['classroom']}}</td>
										</tr>
									@endforeach
								@else
									<?php $count = count($lessons); ?>
									<?php $lesson = array_shift($lessons); ?>
									<tr>
										<td rowspan="{{$count}}">{{$lesson['time_start']}} <br><i class="fa fa-clock-o"></i><br> {{$lesson['time_end']}}</td>
										<td>{{$lesson['subject']}}</td>
										<td>{{$lesson['teacher']['surname']}} {{Str::limit($lesson['teacher']['name'], 1, '.')}} {{Str::limit($lesson['teacher']['last_name'], 1, '.')}}</td>
										<td>{{$lesson['educational_building']}},<br> {{$lesson['classroom']}}</td>
									</tr>
									@foreach ($lessons as $lesson)
											<td>{{$lesson['subject']}}</td>
											<td>{{$lesson['teacher']['surname']}} {{Str::limit($lesson['teacher']['name'], 1, '.')}} {{Str::limit($lesson['teacher']['last_name'], 1, '.')}}</td>
											<td>{{$lesson['educational_building']}},<br> {{$lesson['classroom']}}</td>
									@endforeach
								@endif
							@endforeach
						</table>
					@endforeach
				</div>
			 </div>
			 <div class="col-md-3 sidebar">
						  <h3><a href="{{action('PagesController@getGroupSchedule')}}">{{_('Розклад для студентів')}}</a></h3>
					{{View::make('widgets.last-posts')}}
		     </div>
		     <div class="clearfix"> </div>
		 </div>
	</div>
@stop