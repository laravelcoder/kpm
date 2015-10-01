<script id="item" type="text/x-handlebars-template">
	<div class="pull-left">
		<a class="btn btn-xs btn-danger js-remove-from-gallery" data-storage-id="{{id}}" data-gallery-id="<?php echo $id; ?>" data-url="/admin/galleries/delete-item" style="position:absolute;">&times;</a>
		<img src="{{path}}" class="thumbnail" width="90" height="90" style="margin-right: 4px;">
	</div>
</script>