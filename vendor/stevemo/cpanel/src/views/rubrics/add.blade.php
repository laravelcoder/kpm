@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-tags"></i>
		Рубрики
	</h3>
@stop

@section('content')

{{ Former::horizontal_open(route('cpanel.rubrics.create', array($id))) }}
	<div class="row">
		<div class="span12">

			<div class="block">
				<p class="block-heading">Створити нову рубрику</p>
				<div class="block-body">
					<div class="form-actions">
						<div class="btn-group">
							@foreach ($langs as $lang)
								@if ($lang->id == $lang_id)
								<a href="#" class="btn btn-default disabled">{{$lang->code}}</a>
								@else
								<a href="{{route('cpanel.rubrics.add', array($lang->code, $id))}}" class="btn btn-default">{{$lang->code}}</a>
								@endif
							@endforeach
						</div>
					</div>
					{{ Former::xlarge_text('title','Назва')->required()->data_slug('input[name=slug]') }}
					{{ Former::xlarge_text('slug','Аліас', $default->slug)->pattern('[a-z0-9\-]+')->required() }}
					{{ Former::hidden('is_active', 0)}}

					@if ($default->is_active)
						{{ Former::checkbox('is_active', 'Активна', 1)->check()}}
					@else
						{{ Former::checkbox('is_active', 'Активна', 1)}}
					@endif
					{{ Former::hidden('lang_id', $lang_id)}}

					@include('cpanel::partials.upload', array('name' => 'tets', 'label' => 'Photo'))

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Створити</button>
						<a href="{{route('cpanel.rubrics.index')}}" class="btn">Назад</a>
					</div>
				</div>
			</div>
		</div>
	</div>
{{ Former::close() }}

@stop
