@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-flag"></i>
		Мови
	</h3>
@stop

@section('content')
	<div class="row">
		<div class="span12">
			<div class="block">
				<p class="block-heading">Інформація про мову</p>
				<div class="block-body">
					<div class="btn-toolbar">
						<a href="{{ route('cpanel.langs.index') }}" class="btn btn-primary" rel="tooltip" title="Back">
							<i class="icon-arrow-left"></i>
							До списку
						</a>
					</div>
					<table class="table table-striped">
						<tbody>
							<tr>
								<td><strong>Назва<strong></td>
								<td>{{$lang->name}}</td>
							</tr>
							<tr>
								<td><strong>Код<strong></td>
								<td>{{$lang->code}}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@stop
