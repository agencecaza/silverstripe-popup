jQuery.noConflict();

(function($) {

	$('input.datetime').datetimepicker({
		format:'Y-m-d H:i:s',
		lang:'fr',
		timepicker:true,
	});

}(jQuery));
