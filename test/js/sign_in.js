// JavaScript Document

$(document).ready(function(){	
    $('.example2').hide().before('<a href="#" id="toggle-example2" class="button">Sign In</a>');
	$('a#toggle-example2').click(function() {
		$('.example2').slideToggle(0);
		return false;
	});
});