"use strict";

$(document).ready(function() {

    //begin:user functions
    $.fn.saveUser = function() {   
        
        var roleid = $("input[name='roleid']:checked").val();

        if(typeof(roleid) == "undefined" || roleid == null) {
            roleid = '';
        } 

        axios.post(baseurl+'configs/users/save', {
            firstname: $("#firstname").val(),
            lastname: $("#lastname").val(),
            email: $("#email").val(),
            roleid: roleid,
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('USER', 'ADD', response.data);
            } else {
            $.fn.showErrorResponse('USER', 'ADD', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:user functions

    //begin:response functions
    $.fn.showSuccessResponse = function(component, event, response) {
        if (component=='USER') {
            if (event=='ADD') {
                $.fn.resetFormCreateUser();
                $.fn.showPageAlert('success', response.message);
            }
        } 
    }

    $.fn.showErrorResponse = function(component, event, response) {
        
        if (component=='USER') {
            if (event=='ADD') {
                $.fn.resetFormErrorsCreateUser();
                if (typeof(response.message['firstname']) != "undefined" && 
                response.message['firstname'] !== null) {
                $("#firstname_er").html(response.message['firstname']).removeClass('d-none');
                } 
                if (typeof(response.message['lastname']) != "undefined" && 
                response.message['lastname'] !== null) {
                $("#lastname_er").html(response.message['lastname']).removeClass('d-none');
                }
                if (typeof(response.message['email']) != "undefined" && 
                response.message['email'] !== null) {
                $("#email_er").html(response.message['email']).removeClass('d-none');
                } 
                if (typeof(response.message['roleid']) != "undefined" && 
                response.message['roleid'] !== null) {
                $("#roleid_er").html(response.message['roleid']).removeClass('d-none');
                }
            } 
        }
        
    }

    //begin:reset form functions
    $.fn.resetFormCreateUser = function() {
        $("#firstname").val('');
        $("#lastname").val('');
        $("#email").val('');  
        $("input[name='roleid']:checked").prop('checked', false);

        $.fn.resetFormErrorsCreateUser();
    }
    //end:reset form functions

    //begin:reset form error functions
    $.fn.resetFormErrorsCreateUser = function() {
        $("#firstname_er").html('').addClass('d-none'); 
        $("#lastname_er").html('').addClass('d-none');  
        $("#email_er").html('').addClass('d-none'); 
        $("#roleid_er").html('').addClass('d-none');  
    }
    //end:reset form error functions

    //begin:event trigger functions
    $('#btn_saveUser').click(function() {
        $.fn.saveUser();
    });

    $('#firstname').keypress(function() {
        $("#firstname_er").html('').addClass('d-none'); 
    });

    $('#firstname').on('paste', function(e) {
        $("#firstname_er").html('').addClass('d-none'); 
    });

    $('#lastname').keypress(function() {
        $("#lastname_er").html('').addClass('d-none'); 
    });

    $('#lastname').on('paste', function(e) {
        $("#lastname_er").html('').addClass('d-none'); 
    });

    $('#email').keypress(function() {
        $("#email_er").html('').addClass('d-none'); 
    });

    $('#email').on('paste', function(e) {
        $("#email_er").html('').addClass('d-none'); 
    });

    $('input[name="roleid"]').change(function() {
        $("#roleid_er").html('').addClass('d-none');  
    });
    //end:event trigger functions



    //begin:init functions
    //end:init functions

});