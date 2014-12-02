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
				<p class="block-heading">Список рубрик</p>
				<div class="block-body">

					<div class="btn-toolbar">
						<a href="{{ route('cpanel.rubrics.add') }}" class="btn btn-primary" rel="tooltip" title="Додати нову рубрику">
							<i class="icon-plus"></i>
							Додати рубрику
						</a>
					</div>

					@if (count($rubrics) == 0)
						<div class="alert alert-warn">
							Список рубрик порожній.
						</div>
					@else
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Назва</th>
								<th>Аліас</th>
								<th>Активна</th>
								<th>Дії</th>
							</tr>
						</thead>
						<tbody>
							@foreach ($rubrics as $rubric)
								<tr>
									<td>{{ HTML::linkRoute('cpanel.rubrics.view',$rubric->title, array($rubric->id)) }}</td>
									<td>{{ $rubric->slug }}</td>
									<td>
										@if ($rubric->is_active)
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
													<a href="{{ route('cpanel.rubrics.edit', array($rubric->id)) }}">
														<i class="icon-edit"></i>&nbsp;Редагувати
													</a>
												</li>
												<li>
													<a href="{{ route('cpanel.rubrics.delete', array($rubric->id)) }}"
														data-method="delete"
														data-modal-text="Видалити цю рубрику?">
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
					<?php echo $rubrics->links(); ?>
					@endif

				</div> <!-- end of body -->

			</div> <!-- end of block -->

		</div>
	</div>
@stop
