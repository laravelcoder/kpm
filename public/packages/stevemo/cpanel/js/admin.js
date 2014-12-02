$(function() {

	$('a[rel=tooltip]').tooltip();

		//Apply twitter bootstrap alike style to select element
	$('.select2').select2({
		width :'element',
		placeholder : 'Select'
	});

	// Convert text input in create permission view into tags mode
	$('#permission-tags').select2({
		tags: ['view','create','update','delete'],
		width: 'element'
	});

	// init aliases
	$('input[data-slug]').each(function () {
		var $this = $(this);
		var $target = $($this.data('slug'));

		$this.on('keyup keydown', function () {
			$target.val(getSlug($this.val()));
		});
	});

	CKEDITOR.on('instanceReady', function(e) {
		var $jsTexteditor = $(e.editor.element.$);

		$jsTexteditor.closest('form').on('update', function () {
			e.editor.updateElement();
		});

		if ($jsTexteditor.hasClass('js-html-editor')) {
			e.editor.config.autoParagraph = false;
		}
	});

	CKEDITOR.replaceAll('js-texteditor', {
		toolbar: 'Basic',
		allowedContent: true,
		autoParagraph: false
	});

});

/**
 * Create a confirm modal
 * We want to send an HTTP DELETE request
 *
 * @usage  <a href="posts/2" data-method="delete"
 *         	data-modal-text="Are you sure you want to delete"
 *         >
 *
 *
 * @author Steve Montambeault
 * @link   http://stevemo.ca
 *
 */
(function() {

	var laravel =
	{
		initialize: function()
		{
			this.methodLinks = $('a[data-method]');
			this.registerEvents();
		},

		registerEvents: function()
		{
			this.methodLinks.on('click', this.handleMethod);
		},

		handleMethod: function(e)
		{
			e.preventDefault();
			var link = $(this);

			var httpMethod = link.data('method').toUpperCase();
			var allowedMethods = ['PUT', 'DELETE'];
			var extraMsg = link.data('modal-text');
			var msg  = '<i class="icon-warning-sign modal-icon"></i>&nbsp;' + extraMsg;

			// If the data-method attribute is not PUT or DELETE,
			// then we don't know what to do. Just ignore.
			if ( $.inArray(httpMethod, allowedMethods) === - 1 )
			{
				return;
			}

			bootbox.dialog(msg,
			[
				{
					"label": "OK",
					"class": "btn-danger",
					"callback": function()
					{
						var form =
							$('<form>', {
								'method': 'POST',
								'action': link.attr('href')
							});

						var hiddenInput =
							$('<input>', {
								'name': '_method',
								'type': 'hidden',
								'value': link.data('method')
							});

						form.append(hiddenInput).appendTo('body').submit();
					}
				},
				{
					"label": "Назад",
					"class": "btn-default"
				}
			],
			{
				"header": "Підтвердження дії"
			});
		}
	};

	laravel.initialize();

})();
