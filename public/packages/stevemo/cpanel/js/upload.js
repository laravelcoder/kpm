$(function() {
	// upload file
	var $uploadTarget = $('.js-upload');

	$uploadTarget.fileupload({
		dataType: 'json',
		done: function (e, data) {
			console.log('uploaded successfully!');
		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
		},
		error: function (e, data) {
			console.log('upload error');
		}
	})
});
