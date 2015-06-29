$body = $('body');

$('input').attr('autocomplete','off');

$body.on('click', '.js-toggle-poll' ,function (e) {
	e.preventDefault();

	var $this = $(this);
	var $poll = $this.parent().siblings('.poll');
	var $pollResult = $this.parent().siblings('.poll-result');

	$poll.toggleClass('hide');
	$pollResult.toggleClass('hide');
	$this.siblings('button').toggleClass('hide');
});

$body.on('click', '.js-vote', function (e) {
	e.preventDefault();

	var $this = $(this);
	var $form = $this.parent().parent('.js-vote-form');
	var url = $this.data('action') || '/vote';
	var $block = $form.parent('.blog_desc');

	console

	$.ajax({
		url: url,
		data: $form.serialize(),
		dataType: 'json',
		type: 'POST',
		beforeSend: function () {
			$block.addClass('loading');
		},
		complete: function () {
			$block.removeClass('loading');
		},
		success: function (data) {
			$block.removeClass('loading');

			if (data.success) {
				var source   = $("#polls-result").html();
				var template = Handlebars.compile(source);
				var content = template(data.results);
				// create template and insert to block
				$form.remove();
				$block.append(content);
			}
		}
	});
});