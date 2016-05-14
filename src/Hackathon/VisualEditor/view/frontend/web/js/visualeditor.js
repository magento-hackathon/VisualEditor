define([
    "jquery"
], function($) {
    "use strict";

    $(document).ready(function(){
        $(document).on('keyup keydown keypress', function (event) {
            if (event.keyCode == 73 && event.shiftKey) {
                jQuery('.visualeditor_block_container').toggleClass('enabled');
                jQuery('.visualeditor_block_identifier').toggleClass('enabled');
                jQuery('.visualeditor_textarea').toggleClass('enabled');
                jQuery('.visualeditor_content').toggleClass('disabled');

                jQuery('.visualeditor_textarea').on('change', function (e) {
                    var identifier = jQuery(e.target).data('textarea-identifier');
                    jQuery('.visualeditor_content[data-content-identifier="' + identifier + '"]').html(jQuery(e.target).val());
                });
            }
        });
    });
});