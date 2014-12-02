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
				<p class="block-heading">Список мов</p>

				<div class="block-body">

					<div class="btn-toolbar">
						<a href="{{ route('cpanel.langs.add') }}" class="btn btn-primary" rel="tooltip" title="Додати нову мову">
							<i class="icon-plus"></i>
							Додати мову
						</a>
					</div>

					@if (count($langs) == 0)
						<div class="alert alert-warn">
							Список мов порожній. Для того, щоб керувати вмістом сайту додайте хоча б одну мову.
						</div>
					@else
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Назва</th>
								<th>Код</th>
								<th>Мова за замовчуванням</th>
								<th>Дії</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($langs as $lang)
								<tr>
									<td>{{ HTML::linkRoute('cpanel.langs.view',$lang->name, array($lang->id)) }}</td>
									<td>{{ $lang->code }}</td>
									<td>
										@if ($lang->is_default)
											Так
										@else
											Ні
										@endif
									</td>
									<td>
										<div class="btn-group">
											<a class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#">
												Опції
												<span class="caret"></span>
											</a>
											<ul class="dropdown-menu">
												<li>
													<a href="{{ route('cpanel.langs.edit', array($lang->id)) }}">
														<i class="icon-edit"></i>&nbsp;Редагувати
													</a>
												</li>
												<li>
													<a href="{{ route('cpanel.langs.delete', array($lang->id)) }}"
														data-method="delete"
														data-modal-text="Видалити цю мову?">
														<i class="icon-trash"></i>&nbsp;Видалити
													</a>
												</li>
											</ul>
										</div>
									</td>
								</tr>
							@endforeach

						</tbody>
					</table>
					@endif

				</div> <!-- end of body -->

			</div> <!-- end of block -->

		</div>
	</div>

@stop
