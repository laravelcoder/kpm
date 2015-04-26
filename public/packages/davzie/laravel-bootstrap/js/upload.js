$(function() {
	// upload file
	var $uploadTarget = $('.js-upload');

	$uploadTarget.fileupload({
		dataType: 'json',
		done: function (e, data) {
			$(this).siblings('#progress').addClass('hide').find('.progress-bar').css('width',  '0%');

			if (data.result.success) {
				var name = data.result.key;
				$('input[name=' + name + '].js-upload-target').val(data.result.id);
				$(this).siblings('.js-upload-message').text('Файл завантажено');
				$(this).siblings('.upload-cover').attr('src', data.result.path);
			} else {
				$(this).siblings('.js-upload-message').text('Помилка при завантаженні')
			}

		},
		progressall: function (e, data) {
			var progress = parseInt(data.loaded / data.total * 100, 10);
			$(this).siblings('.js-upload-message').text('');

			$(this).siblings('#progress').removeClass('hide').find('.progress-bar').css('width', progress + '%');
		},
		error: function (e, data) {
			$(this).siblings('.js-upload-message').text('Помилка при завантаженні')
		}
	});

	$uploadTarget.bind('fileuploadsubmit', function (e, data) {
	    // The example input, doesn't have to be part of the upload form:
	    var dir  = $(this).attr('data-dir');
	    var name = $(this).attr('name');

	    data.formData = {
	    	dir: dir,
	    	name: name
	    };
	});
});