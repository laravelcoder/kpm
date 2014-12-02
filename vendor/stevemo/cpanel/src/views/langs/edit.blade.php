@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-flag"></i>
		Мови
	</h3>
@stop

@section('content')

{{ Former::horizontal_open(route('cpanel.langs.update', array($lang->id)))->method('PUT') }}
	<div class="row">
		<div class="span12">

			<div class="block">
				<p class="block-heading">Редагування мови</p>
				<div class="block-body">
					{{ Former::xlarge_text('name','Назва', $lang->name)->required() }}
					{{ Former::xlarge_text('code','Код(2 знаки)', $lang->code)->pattern('[a-z]{2}')->required() }}

					@if ($lang->is_default)
					{{ Former::checkbox('is_default', 'Мова за замовчуванням', $lang->is_default)->check()}}
					@else
					{{ Former::checkbox('is_default', 'Мова за замовчуванням', $lang->is_default)}}
					@endif
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Редагувати</button>
						<a href="{{route('cpanel.langs.index')}}" class="btn">Назад</a>
					</div>
				</div>
			</div>
		</div>
	</div>
{{ Former::close() }}

@stop
