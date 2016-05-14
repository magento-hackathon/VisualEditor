define([
    "jquery"
], function($) {
    "use strict";

    $(document).ready(function(){
        $(document).on('keyup keydown keypress', function (event) {
            if (event.keyCode == 73 && event.shiftKey) {
                jQuery('.visualeditor_block_container').toggleClass('enabled');
                jQuery('.visualeditor_block_identifier').toggleClass('enabled');
            }
        });
    });
});