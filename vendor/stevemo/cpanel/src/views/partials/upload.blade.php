<div class="control-group">
	<label for="{{$name}}" class="control-label">{{$label}}</label>
	<div class="controls customize-controls">
		<span class="btn btn-default fileinput-button">
			<i class="icon-upload"></i>
			<span>Виберіть файл</span>
			<input id="fileupload" class="js-upload" type="file" name="{{$name}}" data-url="{{route('cpanel.strorage.upload')}}">
		</span>
		<br>
		<br>
		<div id="progress" class="progress customize-progress">
			<div class="progress-bar progress-bar-success"></div>
		</div>
	</div>
</div>
