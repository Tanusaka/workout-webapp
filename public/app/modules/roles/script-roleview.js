"use strict";

$(document).ready(function() {

    $.fn.changePermission = function(pid, access) {
        axios.post(baseurl+'configs/roles/update/permissions', {
            permissionid: pid,
            access: access
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showPageAlert('success', response.data.message);
            } else {
                if (access==0) {
                    $('#form_check_input_'+pid).prop('checked', true);
                } else {
                    $('#form_check_input_'+pid).prop('checked', false);
                }
            $.fn.showPageAlert('danger', response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $('.form-check-input').change(function() {
        var access = 0; var pid = $(this).attr("data-pid");
        if (this.checked) { access = 1; } 
        $.fn.changePermission(pid, access);
    });
    
});