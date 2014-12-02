@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-tags"></i>
		Рубрики
	</h3>
@stop

@section('content')
	<div class="row">
		<div class="span12">
			<div class="block">
				<p class="block-heading">Інформація про рубрику</p>
				<div class="block-body">
					<div class="btn-toolbar">
						<a href="{{ route('cpanel.rubrics.index') }}" class="btn btn-primary" rel="tooltip" title="Назад">
							<i class="icon-arrow-left"></i>
							До списку
						</a>
					</div>
					<table class="table table-striped">
						<tbody>
							<tr>
								<td><strong>Назва<strong></td>
								<td>{{$rubric->title}}</td>
							</tr>
							<tr>
								<td><strong>Аліас<strong></td>
								<td>{{$rubric->slug}}</td>
							</tr>
							<tr>
								<td><strong>Активна<strong></td>
								<td>
									@if ($rubric->is_active)
										Так
									@else
										Ні
									@endif
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
