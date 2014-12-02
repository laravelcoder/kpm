@extends(Config::get('cpanel::views.layout'))

@section('header')
	<h3>
		<i class="icon-file-text-alt"></i>
		Сторінки
	</h3>
@stop

@section('content')
	<div class="row">
		<div class="span12">
			<div class="block">
				<p class="block-heading">Список сторінок</p>
				<div class="block-body">

					<div class="btn-toolbar">
						<a href="{{ route('cpanel.pages.add') }}" class="btn btn-primary" rel="tooltip" title="Додати нову сторінку">
							<i class="icon-plus"></i>
							Додати сторінку
						</a>
					</div>

					@if (count($pages) == 0)
						<div class="alert alert-warn">
							Список сторінок порожній.
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
							@foreach ($pages as $page)
								<tr>
									<td>{{ $page->title }}</td>
									<td>{{ $page->slug }}</td>
									<td>
										@if ($page->is_active)
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
													<a href="{{ route('cpanel.pages.edit', array($page->id)) }}">
														<i class="icon-edit"></i>&nbsp;Редагувати
													</a>
												</li>
												<li>
													<a href="{{ route('cpanel.pages.delete', array($page->id)) }}"
														data-method="delete"
														data-modal-text="Видалити цю сторінку?">
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
					<?php echo $pages->links(); ?>
					@endif

				</div> <!-- end of body -->

			</div> <!-- end of block -->

		</div>
	</div>
@stop
