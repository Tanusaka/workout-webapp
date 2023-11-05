"use strict";

let baseurl = $("#baseurl").attr('href');

$(document).ready(function() {

    $.fn.showException = function(message) {
        Swal.fire({
            text: message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function() {                            
            location.reload(true);
        });
    }

    $.fn.showErrorMessage = function(message) {
        Swal.fire({
            text: message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function() {                            
            location.reload(true);
        });
    }

    $.fn.showWarningMessage = function(message) {
        Swal.fire({
            text: message,
            icon: "warning",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function() {                            
            location.reload(true);
        });
    }

    $.fn.showTabAlert = function(tabid, alertClass, message) {
        $('#'+tabid+'_tab_content_container').hide();
        $('#tab_alertmessage').text(message);
        $('#tab_alert').addClass('alert-'+alertClass);
        $('#tab_alert').removeClass('d-none');
    }

    $.fn.hideTabAlert = function(tabid) {
        $('#tab_alert').addClass('d-none');
        $('#tab_alertmessage').text('');
        $('#tab_alert').removeClass('alert-success alert-danger alert-warning');  
        $('#'+tabid+'_tab_content_container').show();
    }

    $.fn.showPageAlert = function(alertClass, message) {
        $('#alertmessage').text(message);
        $('#alert').addClass('alert-'+alertClass);
        $('#alert').removeClass('d-none');

        setTimeout(() => {
            $('#alert').addClass('d-none');
            $('#alertmessage').text('');
            $('#alert').removeClass('alert-success alert-danger alert-warning');
        }, 2000);
    }

    $.fn.showModalAlert = function(modalName, alertClass, message) {
        $('#modal_'+modalName+'_alertmessage').text(message);
        $('#modal_'+modalName+'_alert').addClass('alert-'+alertClass);
        $('#modal_'+modalName+'_alert').removeClass('d-none');

        setTimeout(() => {
            $('#modal_'+modalName+'_alert').addClass('d-none');
            $('#modal_'+modalName+'_alertmessage').text('');
            $('#modal_'+modalName+'_alert').removeClass('alert-success alert-danger alert-warning');
        }, 2000);
    }

});