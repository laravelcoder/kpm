$(function() {
	// upload file
	var $uploadTarget = $('.js-upload');

	$uploadTarget.fileupload({
		dataType: 'json',
		done: function (e, data) {
			var reload = $(this).attr('data-reload') || false;
			$(this).siblings('#progress').addClass('hide').find('.progress-bar').css('width',  '0%');

			if (data.result.success) {

				if (reload) {
					return location.reload();
				}

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
			$(this).siblings('.js-upload-message').text('Помилка при завантаженні');
			$(this).siblings('#progress').addClass('hide').find('.progress-bar').css('width',  '0%');
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

	$('.js-add-photo').fileupload({
		dataType: 'json',
		done: function (e, data) {
			$(this).siblings('#progress').addClass('hide').find('.progress-bar').css('width',  '0%');

			if (data.result.success) {
				var html = Hbs('item', data.result);
				$('.js-gallery-container').append(html);
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
			$(this).siblings('.js-upload-message').text('Помилка при завантаженні');
			$(this).siblings('#progress').addClass('hide').find('.progress-bar').css('width',  '0%');
		}
	}).bind('fileuploadsubmit', function (e, data) {
	    // The example input, doesn't have to be part of the upload form:
	    var dir  = $(this).attr('data-dir');
	    var name = $(this).attr('name');
	    var gallery_id = $(this).attr('data-gallery-id');

	    data.formData = {
	    	dir: dir,
	    	name: name,
	    	gallery_id: gallery_id
	    };
	});
});