// JavaScript Document

jQuery(document).ready(function() {
    if (jQuery('.example2') != null) {
            jQuery('.example2').hide().before('<a href="#" id="toggle-example2" class="button">Sign In</a>');
            jQuery('a#toggle-example2').click(function() {
                jQuery('.example2').slideToggle(0);
                return false;
            });
    }
});