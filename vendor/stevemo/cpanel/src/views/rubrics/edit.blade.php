@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-tags"></i>
		Рубрики
	</h3>
@stop

@section('content')

{{ Former::horizontal_open(route('cpanel.rubrics.update', array($rubric->id)))->method('PUT') }}
	<div class="row">
		<div class="span12">

			<div class="block">
				<p class="block-heading">Редагування рубрики</p>
				<div class="block-body">
					<div class="form-actions">
						<div class="btn-group">
							@foreach ($langs as $lang)
								@if ($lang->id == $rubric->lang_id)
								<a href="#" class="btn btn-default disabled">{{$lang->code}}</a>
								@else
								<a href="{{route('cpanel.rubrics.edit', array($rubric->id, $lang->code))}}" class="btn btn-default">{{$lang->code}}</a>
								@endif
							@endforeach
						</div>
					</div>
					{{ Former::xlarge_text('title','Назва', $rubric->title)->required() }}
					{{ Former::xlarge_text('slug','Аліас', $rubric->slug)->pattern('[a-z0-9\-]+')->required() }}
					{{ Former::hidden('is_active', 0)}}
					@if ($rubric->is_active)
					{{ Former::checkbox('is_active', 'Активна', 1)->check()}}
					@else
					{{ Former::checkbox('is_active', 'Активна', 1)}}
					@endif
					{{ Former::hidden('lang_id', $rubric->lang_id)}}

					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Редагувати</button>
						<a href="{{route('cpanel.rubrics.index')}}" class="btn">Назад</a>
					</div>
				</div>
			</div>
		</div>
	</div>
{{ Former::close() }}

@stop
