function initializePlugins() {
    $('.jq_input_tags').tagsInput({
        width: 'auto'
    });
}

$(document).ajaxComplete(function() {
    initializePlugins();
});

jQuery(document).ready(function ($) {
    "use strict";  
    initializePlugins();
});