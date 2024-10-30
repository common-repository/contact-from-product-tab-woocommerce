/**
 * Main Javascript Script For WooCommerce tabs contact form
 */

jQuery(document).ready(function($){
    $('#cfptwc-contact-form').on('submit',function(e){
        e.preventDefault();
        var form_input = $(this).serialize()+'&action=cfptwc_save_form_data';
        $('#cfptwc_submit').attr('disabled', 'disabled');
        $('.cfptwc-loading').show();
        $.ajax({
            type : 'POST',
            url : cfptwc.ajaxurl,
            data : form_input,
            success : function(data){
                var success_data = JSON.parse(data);
                if (success_data.status == 1){
                    $('#cfptwc-status-msg').html('<span class="alert alert-success">'+success_data.msg+'</span>');
                    $('#cfptwc-contact-form').trigger("reset");
                    $('html, body').animate({scrollTop: ($("#tab-themeqx_tabs_contact_form").offset().top)-100 }, 500);
                }else{
                    $('#cfptwc-status-msg').html('<span class="alert alert-warning">'+success_data.msg+'</span>');
                }
                $('#cfptwc_submit').removeAttr('disabled');
                $('.cfptwc-loading').hide();

            }
        })
    });

});
