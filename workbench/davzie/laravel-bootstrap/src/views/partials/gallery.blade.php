<div class="form-group">
	<label for="" class="col-lg-2 control-label">Зображення</label>
	<div class="col-lg-10">
		<div class="alert alert-info">Додайте зображення</div>
		<div class="js-gallery-container" style="margin-right: 6px;">
			@foreach ($items as $item)
				<div class="pull-left">
					<a class="btn btn-xs btn-danger js-remove-from-gallery" data-storage-id="{{$item->id}}" data-gallery-id="{{$id}}" data-url="/admin/galleries/delete-item" style="position:absolute;">&times;</a>
					<img src="{{$item->thumbs['100x100']}}" class="thumbnail" width="90" height="90" style="margin-right: 4px;"/>
				</div>
			@endforeach
			{{--<div class="pull-left">
				<a href="#" class="btn btn-xs btn-danger" style="position:absolute;">&times;</a>
				<img src="" class="thumbnail" width="90" height="90">
			</div>--}}
		</div>
		<div class="">
			<span  style="width:90px; height: 90px; line-height: 86px; font-size: 14px;" class="btn btn-xs btn-default">
				<input id="fileupload-gallery" class="js-add-photo" type="file" data-url="/admin/galleries/add-item" data-dir="galleries/{{$id}}" name="gallery_photo" data-gallery-id="{{$id}}">
				<i class="icon icon-plus"></i>
				<div id="progress" class="progress customize-progress progress-bar-block2 hide">
					<div class="progress-bar progress-bar-success"></div>
				</div>
			</span>
		</div>
	</div>
</div>

@include('laravel-bootstrap::partials.hbs.gallery', ['id' => $id])