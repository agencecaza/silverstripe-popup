jQuery.noConflict();

(function($) {

	function show(){
	  $('.popup').addClass('show');
	}
	setTimeout(show, $('.popup').attr('data-displaydelay') * 1000);

	$('.popup .close, .popup a.redirect').on('click', function() {

		var popup = $('.popup');
		var href = $(this).attr('data-href');

		$.ajax({
			url: "popup/close",
			context: this,
			data: {datetime:$('.popup').data('timestamp')},
			success: function (data) {
			popup.removeClass('show');
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
