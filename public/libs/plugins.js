$(function(){
    $('form').submit(function(){
        return false;
    });
    $('.money').mask('0000.00', {reverse: true});
    $('[data-toggle="datepicker"]').datepicker({
    	autoHide: true,
      	zIndex: 2048,
        format: 'yyyy/mm/dd',
  	});
});