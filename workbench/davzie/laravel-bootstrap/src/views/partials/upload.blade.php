<div class="form-group">
	<label for="{{$name}}" class="col-lg-2 control-label">{{$label}}</label>
	<div class="col-lg-10">
		<div class="controls customize-controls">
			<span class="btn btn-default fileinput-button">
				<img src="{{isset($path) ? $path : ''}}" alt="" height="75" width="75" class="pull-left upload-cover thumbnail">
				<input id="fileupload" class="js-upload" type="file" name="{{$name}}" data-url="{{action('Davzie\LaravelBootstrap\Controllers\StorageController@postUpload')}}" data-dir="{{isset($dir) ? $dir : ''}}" data-name="{{$name}}">
				<i class="icon-upload"></i>
				<input type="hidden" name="{{$name}}" class="js-upload-target" @if (isset($value) || Input::old($name)) value="{{Input::old($name, isset($value) ? $value : false)}}" @endif>
				<span>Виберіть файл</span>
				<button type="button" class="btn btn-xs btn-danger js-remove-file-id" data-target="[name={{$name}}]"><i class="icon icon-trash"></i> Видалити</button>
				<div class="js-upload-message"></div>
				<div id="progress" class="progress customize-progress progress-bar-block hide">
					<div class="progress-bar progress-bar-success"></div>
				</div>
			</span>
		</div>
	</div>
</div>