<div class="form-actions">
	<div class=" panel panel-default">
		<div class="panel-body">
			<div class="btn-group">
				@foreach ($langs as $lang)
				<a href="{{action($module . '@getNew', array($lang->code, $id))}}@if(!empty($_get))/?{{http_build_query($_get)}} @endif" class="btn btn-default @if ($lang_id == $lang->id)active btn-primary disabled @endif">{{$lang->code}}</a>
				@endforeach
			</div>
		</div>
	</div>
</div>