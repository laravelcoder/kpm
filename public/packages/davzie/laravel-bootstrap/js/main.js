$(function () {
	// Main js
	// Connect plugins to app
	var taggables = $('input[name="tags"]');
	var richText = $('textarea.rich');
	var $body = $('body');

	if( taggables.length )
		$(taggables).tagsInput({});

	if( richText.length ) {
		$(richText).redactor({
			buttonSource: true,
		});
	}

	$('.timepicker').datetimepicker({
		format: 'HH:mm'
	});

	$('.datetimepicker').datetimepicker({
		format: 'DD-MM-YYYY, HH:mm:ss'
	});

	$('.datepicker').datetimepicker({
		format: 'DD.MM.YYYY'
	});

	// init aliases
	$('input[data-slug]').each(function () {
		var $this = $(this);
		var $target = $($this.data('slug'));

		$this.on('keyup keydown', function () {
			$target.val(getSlug($this.val()));
		});
	});

	$body.on('click', '.js-delete', function (e) {
		e.preventDefault();

		var $this = $(this);
		var text  = $this.data('message');
		var url   = $this.attr('href');

		if (confirm(text)) {
			location.href = url;
		}
	});

	$('select.sel2').select2();

	$body.on('click', '.js-back', function (e) {
		e.preventDefault();
		history.back();
	});

	$body.on('click', '.js-modal-select', function (e) {
		//
		e.preventDefault();

		$this = $(this);
		ModalSelect.setOptions({
			url: $this.data('url'),
			header: 'Вибір елемента',
			selector: '.modal',
			target: location.href
		});

		ModalSelect.popup();
	});

	$body.on('click', '.js-close-modal', function (e) {
		e.preventDefault();

		var $this = $(this);
		var reload = false;

		console.log(ModalSelect.items);
		if (ModalSelect.items.length) {
			reload = true;
		}

		$this.trigger('hide.bs.modal', [reload]);
	});

	$('.modal').on('hide.bs.modal', function (e, reload) {
		if (reload) {
			location.reload();
		}
	});

	$body.on('click', '.js-select-modal-item', function (e) {
		e.preventDefault();
		var $this = $(this);
		var url = $this.data('url');
		var id  = $this.data('id');

		$.ajax({
			url: '',
			type: 'POST',
			data: {
				id: id
			},
			dataType: 'json',
			beforeSend: function () {
				$this.addClass('disabled').text('Зачекайте...');
			},
			success: function (data) {
				if (data.success) {
					ModalSelect.send($this);
					$this.html('<i class="glyphicon glyphicon-ok"></i>');
				}
			},
			error: function () {
				$this.removeClass('disabled').text('Обрати');
			}
		});

		// ModalSelect.send($(this));
	});

	$body.on('click', '.js-remove-from-list', function (e) {
		e.preventDefault();

		var $this = $(this);
		var url   = $this.data('url');
		var id    = $this.data('id');

		$.ajax({
			url: url,
			type: 'POST',
			data: {
				id: id
			},
			dataType: 'json',
			beforeSend: function () {
				$this.addClass('disabled').text('Йде видалення...');
			},
			success: function (data) {
				if (data.success) {
					location.reload();
				}
			},
			error: function () {}
		});
	});

	$body.on('click', '.js-toogle-permission', function (e) {
		e.preventDefault();

		var $this = $(this);

		if ($this.hasClass('btn-success')) {
			$this.removeClass('btn-success').addClass('btn-default');
			$this.find('input[type=hidden]').val(0);
		} else {
			$this.removeClass('btn-default').addClass('btn-success');
			$this.find('input[type=hidden]').val(1);
		}
	});

	// $('select').prepend('<option>---</option>');

	$body.on('change', '.js-select-dropdown', function (e) {
		var $this = $(this);
		var url   = $this.attr('data-url');
		var id    = $this.val();

		if (!id) {
			return false;
		}

		$target = $($this.attr('data-target'));
		$label = $this.parents('.form-group').find('label');

		url += id;

		$.ajax({
			dataType: 'json',
			type: 'GET',
			url: url,
			beforeSend: function () {
				$this.addClass('disabled');
				$label.append(' <i class="icon-spinner icon-spin icon-large"></i>');
				deleteRecursive($this.attr('data-target'));
			},
			success: function (data) {
				//
				$label.find('i').remove();

				if (!data.length) {
					return false;
				}

				$target.append('<option value="">Зробіть вибір</option>');
				$.each(data, function (k, val) {
					$target.append('<option value="'+ val.id +'">' + val.title + '</option>');
				});
			},
			compleate: function () {
				$this.removeClass('disabled');
				$label.find('i').remove();
				alert('1');
			}
		});
	});

	deleteRecursive = function (selector) {
		var $el = $(selector);
		var target = $el.attr('data-target') || '';

		$el.empty();

		if (target.length) {
			deleteRecursive(target);
		}
	}

	$body.on('click', '.js-toggle-bool-value', function (e) {
		e.preventDefault();
		var $this  = $(this);
		var value  = $this.attr('data-value').trim();
		var column = $this.attr('data-column');
		var url    = $this.attr('data-url');

		$.ajax({
			url: url,
			type: 'POST',
			dataType: 'json',
			data: {
				value: value,
				column: column
			},
			success: function (data) {
				if (data.success) {
					if (value == '1') {
						$this.removeClass('btn-default').addClass('btn-success').attr('data-value', 0);
					} else if (value == '0') {
						$this.removeClass('btn-success').addClass('btn-default').attr('data-value', 1);
					}
				}
			}
		});
	});

	$body.on('click', '.js-get-path', function (e) {
		e.preventDefault();
		prompt('Шлях до файлу:', $(this).attr('data-path'));
	});

	Hbs = function (id, data) {

		if (!Handlebars) {
			return false;
		}

		var source   = $("#" + id).html();
		var template = Handlebars.compile(source);

		return template(data);
	};

	$body.on('click', '.js-remove-from-gallery', function (e) {
		e.preventDefault();
		var $this = $(this);
		var gallery_id = $this.attr('data-gallery-id');
		var storage_id = $this.attr('data-storage-id');
		var url = $this.attr('data-url');

		if (confirm('Видалити це фото')) {
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'json',
				data: {
					gallery_id: gallery_id,
					storage_id: storage_id
				},
				success: function (data) {
					if (data.success) {
						$this.parent().remove();
					}
				}
			});
		}

	});

	// sortable
	$("#sortable").sortable({
		placeholder: "ui-state-highlight",
		update: function (event, ui) {
			var $this = $(this);
			var url   = $this.attr('data-url');
			var $form = $(this).parent('form');

			$.ajax({
				url: url,
				data: $form.serialize(),
				dataType: 'json',
				type: 'POST'
			});
		}
    });

    $body.on('click', '.js-toggle-element', function (e) {
    	e.preventDefault();

    	var target = $(this).attr('data-target');
    	var $target = $(target);

    	$target.toggle();
    });

    $body.on('change', '.js-select-to', function () {
    	var $this = $(this);
    	var value = $this.val();
    	var $target = $($this.attr('data-target'));

    	$target.val(value);
    });

});