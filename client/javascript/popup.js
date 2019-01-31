jQuery.noConflict();

(function($) {



		$('.popup .close').on('click', function() {

			var PopUp = $('.popup');

			$.ajax({
				url: "popupajax/close",
				context: this,
				data: {datetime:$('.popup').data('timestamp')},
				success: function (data) {
					PopUp.fadeOut();
					console.log('Popup Closed');
				},
				error: function (data) {
					console.log('Problem closing.');
				}
			});

		});


	});
}(jQuery));
