jQuery.noConflict();

(function($) {

	$('input.datetime').datetimepicker({
		timepicker:false,
		mask:true,
		format:'Y-m-d H:i:s',
		lang:'fr',
		timepicker:true,

	});

}(jQuery));
