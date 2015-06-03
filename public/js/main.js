$body = $('body');

$body.on('click', '.js-toggle-poll' ,function (e) {
	e.preventDefault();

	var $this = $(this);
	var $poll = $this.parent().siblings('.poll');
	var $pollResult = $this.parent().siblings('.poll-result');

	$poll.toggleClass('hide');
	$pollResult.toggleClass('hide');
	$this.siblings('button').toggleClass('hide');
});