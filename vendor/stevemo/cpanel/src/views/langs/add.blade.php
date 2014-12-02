@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-flag"></i>
		Мови
	</h3>
@stop

@section('content')

{{ Former::horizontal_open(route('cpanel.langs.create')) }}
	<div class="row">
		<div class="span12">

			<div class="block">
				<p class="block-heading">Створити нову мову</p>
				<div class="block-body">
					{{ Former::xlarge_text('name','Назва')->required() }}
					{{ Former::xlarge_text('code','Код(2 знаки)')->pattern('[a-z]{2}')->required() }}
					{{ Former::checkbox('is_default', 'Мова за замовчуванням')}}
					<div class="form-actions">
						<button type="submit" class="btn btn-primary">Створити</button>
						<a href="{{route('cpanel.langs.index')}}" class="btn">Назад</a>
					</div>
				</div>
			</div>
		</div>
	</div>
{{ Former::close() }}

@stop
