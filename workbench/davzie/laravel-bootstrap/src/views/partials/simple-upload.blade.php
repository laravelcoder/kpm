<form action="" style="display:inline;" enctype="multipart/form-data">
	<span class="btn btn-default simple-up fileinput-button">
		<input id="fileupload" class="js-upload" type="file" data-url="{{action('Davzie\LaravelBootstrap\Controllers\StorageController@postUpload')}}" data-dir="{{isset($dir) && $dir ? $dir->path : ''}}" data-reload="true" name="file" data-name="file">
		<i class="icon-upload"></i>
		<span>Завантажити файл</span>
	</span>
</form>
