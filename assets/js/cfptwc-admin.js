/**
 * Main Javascript Script For WooCommerce tabs contact form
 */

jQuery(document).ready(function($){
    $( "#cfptwc-tabs" ).tabs();

    $(document).on('keyup','#cfptwc_field_name',function(e){
        $(this).val(wpneo_wpsd_slugify($(this).val()));
    });
    function wpneo_wpsd_slugify(text) {
        return text.toString().toLowerCase()
            .replace(/\s+/g, '-')           // Replace spaces with -
            .replace(/[^\w\-]+/g, '')       // Remove all non-word chars
            .replace(/\-\-+/g, '-')         // Replace multiple - with single -
            .replace(/^-+/, '')             // Trim - from start of text
            .replace(/-+$/, '');            // Trim - from end of text
    }

    $(document).on('click', '.cfptwc_custom_field_edit_btn', function(){
        var field_name = $(this).data('field-name');
        $.post(ajaxurl, {action: 'cfptwc_edit_custom_field', field_name: field_name}, function(data){
            $('#cfptwc_custom_field_input_area').html(data);
        });
    });
    $(document).on('click', '.cfptwc_custom_field_delete_btn', function(){
        if ( ! confirm('Are you sure?')){
            return;
        }
        
        var field_name = $(this).data('field-name');
        var this_selector = $(this);
        $.post(ajaxurl, {action: 'cfptwc_delete_custom_field', field_name: field_name}, function(data){
            this_selector.closest('tr').hide('slow');
        });
    });

});
