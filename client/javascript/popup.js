jQuery.noConflict();

(function($) {

	$('.popup .close, .popup a.redirect').on('click', function() {

		var popup = $('.popup');

		$.ajax({
			url: "popup/close",
			context: this,
			data: {datetime:$('.popup').data('timestamp')},
			success: function (data) {
			popup.fadeOut();
			console.log('Close.');
			if (href) {
				window.location.href = href;
				}
			},
			error: function (data) {
				console.log('Problem closing.');
			}
		});

	});

}(jQuery));
