"use strict";

$(document).ready(function() {

    var editdescription_RTE; 
    var dz_profileimage;

    var connectionpreview_DT;

    $.fn.openModalEditDescription = function() { 

        axios.post(baseurl+'profile/view', {
            userid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetFormEditDescription(response.data.data); 
            $('#editDescriptionModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditDescription = function() { 
        $('#editDescriptionModal').modal('hide');
    }

    $.fn.openModalEditProfile = function() { 

        axios.post(baseurl+'profile/view', {
            userid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetFormEditProfile(response.data.data); 
            $('#editProfileModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditProfile = function() { 
        $('#editProfileModal').modal('hide');
    }

    //begin:tab functions
    $.fn.refreshProfileTab = function() { 
        axios.post(baseurl+'profile/view', {
            userid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.resetProfileTab(response.data.data);
            $.fn.showTabContent('profile');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.refreshSettingsTab = function() { 
        axios.post(baseurl+'profile/settings', {
            userid: $('#pagedata-container').data('pid')
        }).then(function (response) {
            
            if (response.data.status==200) {
            $.fn.resetSettingsTab(response.data.data);
            $.fn.showTabContent('settings');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updatePassword = function() {
        axios.post(baseurl+'profile/settings/update/password', {
            userid: $('#pagedata-container').data('pid'),
            current_password: $('#current_password').val(),
            new_password: $('#password').val(),
            confirm_password: $('#confirm_password').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('PASSWORD', 'UPDATE', response.data);
            } else {
            $.fn.showErrorResponse('PASSWORD', 'UPDATE', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateDescription = function(roleid) {
        axios.post(baseurl+'profile/settings/update/description', {
            userid: $('#pagedata-container').data('pid'),
            description: editdescription_RTE.getHTMLCode()
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('DESCRIPTION', 'UPDATE', response.data);
            } else {
            $.fn.showErrorResponse('DESCRIPTION', 'UPDATE', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateProfile = function(roleid) {
        axios.post(baseurl+'profile/settings/update/profile', {
            userid: $('#pagedata-container').data('pid'),
            firstname: $('#firstname').val(),
            lastname: $('#lastname').val(),
            dob: $('#dob').val(),
            gender: $('#gender').val(),
            profileimage: $('#profileimage').val(),
            mobile: $('#mobile').val(),
            address1: $('#address1').val(),
            address2: $('#address2').val(),
            city: $('#city').val(),
            country: $('#country').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('PROFILE', 'UPDATE', response.data);
            } else {
            $.fn.showErrorResponse('PROFILE', 'UPDATE', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:tab functions

    //begin:response functions
    $.fn.showSuccessResponse = function(component, event, response) {
        if (component=='PASSWORD') {
            if (event=='UPDATE') {
                $.fn.resetFormUpdatePassword();
                $.fn.showPageAlert('success', response.message);
            }
        } else if (component=='DESCRIPTION') {
            if (event=='UPDATE') {
                $('#dsp_userabout').html(response.data.user.description);
                $.fn.closeModalEditDescription();
                $.fn.showPageAlert('success', response.message);
            }
        } else if (component=='PROFILE') {
            if (event=='UPDATE') {
                $.fn.resetProfile(response.data.user);
                $.fn.closeModalEditProfile();
                $.fn.showPageAlert('success', response.message);
            }
        } 
    }

    $.fn.showErrorResponse = function(component, event, response) {
        
        if (component=='PASSWORD') {
            if (event=='UPDATE') {
                $.fn.resetFormErrorsUpdatePassword();
                if (typeof(response.message['current_password']) != "undefined" && 
                response.message['current_password'] !== null) {
                $("#current_password_er").html(response.message['current_password']).removeClass('d-none');
                } 
                if (typeof(response.message['password']) != "undefined" && 
                response.message['password'] !== null) {
                $("#password_er").html(response.message['password']).removeClass('d-none');
                }
                if (typeof(response.message['confirm_password']) != "undefined" && 
                response.message['confirm_password'] !== null) {
                $("#confirm_password_er").html(response.message['confirm_password']).removeClass('d-none');
                } 
            } 
        } else if (component=='DESCRIPTION') {
            if (event=='UPDATE') {
                $.fn.resetFormErrorsEditDescription();
                if (typeof(response.message['description']) != "undefined" && 
                response.message['description'] !== null) {
                $("#editdescription_er").html(response.message['description']).removeClass('d-none');
                }
            } 
        } else if (component=='PROFILE') {
            if (event=='UPDATE') {
                $.fn.resetFormErrorsEditProfile();
                if (typeof(response.message['firstname']) != "undefined" && 
                response.message['firstname'] !== null) {
                $("#firstname_er").html(response.message['firstname']).removeClass('d-none');
                } 
                if (typeof(response.message['lastname']) != "undefined" && 
                response.message['lastname'] !== null) {
                $("#lastname_er").html(response.message['lastname']).removeClass('d-none');
                } 
            } 
        }
        
    }
    //end:response functions

    //begin:tab reset functions
    $.fn.resetProfileTab = function(data) {
        $.fn.hideTabAlert('profile');
        if (data.description!=null) {
            $('#dsp_userabout').html(data.description);
        } else {
            $('#dsp_userabout').html('This user has not given any content for this section.');
        }

        if (typeof(data.connections) != "undefined" && data.connections !== null) {
            $.fn.resetDataTableConnectionPreview(data.connections);
        }
    }

    $.fn.resetSettingsTab = function(data) {
        $.fn.hideTabAlert('settings');
        $.fn.resetFormUpdatePassword();
    }

    $.fn.showTabContent = function(id) {
        $('.tab-pane').each(function(i, obj) {
        if ( $(this).is(".active.show") ) {
        $(this).removeClass("active show");
        }
        });
        $("#tabcontent_"+id).addClass("active show");
    }
    //end:tab reset functions

    //begin:reset form functions
    $.fn.resetFormEditProfile = function(data) {
        $('#firstname').val(data.firstname);
        $('#lastname').val(data.lastname);
        $('#dob').val(data.dob);
        $('#gender').select2("val", data.gender);
        $('#mobile').val(data.mobile);
        $('#address1').val(data.address1);
        $('#address2').val(data.address2);
        $('#city').val(data.city);
        $('#country').val(data.country);

        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[0].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
          
        $('.dropzone').removeClass('dz-started');

        dz_profileimage.files = [];
        //to reset dropzone after adding files

        $.fn.resetFormErrorsEditProfile();
    }

    $.fn.resetFormEditDescription = function(data) {

        if (data.description==null) {
            editdescription_RTE.setHTMLCode(''); 
        } else {
            editdescription_RTE.setHTMLCode(data.description); 
        }
        
        $.fn.resetFormErrorsEditDescription();
    }

    $.fn.resetFormUpdatePassword = function() {
        $("#current_password").val('');
        $("#password").val('');
        $("#confirm_password").val('');
        $("#instructorprofile").val("").trigger("change");   

        $.fn.resetFormErrorsUpdatePassword();
    }

    $.fn.resetProfile = function(data) {
        $('#dsp_profilename').html(data.firstname+' '+data.lastname);
        $('#dsp_header_profilename').html(data.firstname);

        if ( data.dob=='' ) {
            $('#dsp_dob').html('NOT GIVEN');
        } else {
            $('#dsp_dob').html(data.dob);
        }

        if ( data.gender=='M' ) {
            $('#dsp_gender').html('Male');
        } else if ( data.gender=='F' ) {
            $('#dsp_gender').html('Female');
        } else {
            $('#dsp_gender').html('NOT GIVEN'); 
        }

        if ( data.mobile=='' ) {
            $('#dsp_mobile').html('NOT GIVEN');
        } else {
            $('#dsp_mobile').html(data.mobile);
        }

        if ( data.address1=='' ) {
            $('#dsp_addressL1').html('NOT GIVEN');
        } else {
            $('#dsp_addressL1').html(data.address1+' '+data.address2);
            $('#dsp_addressL2').html(data.city+' '+data.country);
        }

        if (data.profileimage == '') {
            $('#dsp_profileimage').attr("src", "assets/images/avatar.png");
            $('#dsp_header_profileimage').attr("src", "assets/images/avatar.png");
            $('#dsp_header_profileimage_avatar').attr("src", "assets/images/avatar.png");
        } else {
            $('#dsp_profileimage').attr("src", data.profileimage);
            $('#dsp_header_profileimage').attr("src", data.profileimage);
            $('#dsp_header_profileimage_avatar').attr("src", data.profileimage);
        }
        
    }
    //end:reset form functions

    //begin:reset form error functions
    $.fn.resetFormErrorsEditProfile = function() {
        $("#firstname_er").html('').addClass('d-none'); 
        $("#lastname_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsEditDescription = function() {
        $("#editdescription_er").html('').addClass('d-none'); 
    }

    $.fn.resetFormErrorsUpdatePassword = function() {
        $("#current_password_er").html('').addClass('d-none'); 
        $("#password_er").html('').addClass('d-none');  
        $("#confirm_password_er").html('').addClass('d-none');  
    }
    //end:reset form error functions


    //begin:reset datatable functions  _DT
    $.fn.resetDataTableConnectionPreview = function(dataset) {
        
        $('#connectionpreview_DT').DataTable().clear().destroy();
        $('#connectionpreview_body').empty();

        $.each(dataset, function(index, datarow) {
            $.fn.addConnectionPreiviewElement(datarow);
        });

        $('#connectionpreview_DT_search').val('');

        connectionpreview_DT = $('#connectionpreview_DT').DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "bPaginate": false,
            "lengthChange": false,
            'columnDefs': [],
            "destroy": true,
        });
        // connectionpreview_DT.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        // });

        if (dataset.length > 0) {
            $('#connection_conatiner').removeClass('d-none');
            if (dataset.length==1) {
                $('#connection_preview_summary').html('This profile has '+dataset.length+' connection');
            } else {
                $('#connection_preview_summary').html('This profile have '+dataset.length+' connections');
            }
        } else {    
            $('#connection_conatiner').addClass('d-none');
            $('#connection_preview_summary').html('This profile has no connections');
        }
    }
    //end:reset datatable functions  _DT

    //begin:element functions
    $.fn.addConnectionPreiviewElement = function(datarow) {
        var el = '<tr id="dt_connectionpreview_row_'+datarow.id+'" class="odd">'+
        '<td class="d-flex text-start">'+
            '<div class="symbol symbol-circle symbol-40px me-3">';

        if (datarow.profileimage != null) {   
            el = el + '<div class="symbol-label">'+
                '<img src="'+datarow.profileimage+'" class="" alt="">'+
            '</div>';
        } else {
            el = el +' <div class="symbol-label fs-14 bg-light-danger text-danger">'+
                datarow.firstname.charAt(0).toUpperCase()+
            '</div>';
        }

        el = el + '</div>'+
            '<div class="d-flex flex-column">'+
                '<a href="" class="text-gray-800 text-hover-primary mb-1 fs-14">'+datarow.firstname+' '+datarow.lastname+'</a>'+
                '<span class="fs-12">'+datarow.contype+'</span>'+
            '</div>'+
        '</td>'+
        '<td class="text-end">'+
        '</td>'+
        '</tr>';

        $('#connectionpreview_body').append(el);
    }
    //end:element functions

    //begin:jQuery event triggers
    $('#tabbtn_profile').click(function() {
        $.fn.refreshProfileTab();
    });

    $('#tabbtn_settings').click(function() {
        $.fn.refreshSettingsTab();
    });

    $('#btn_updatePassword').click(function() {
        $.fn.updatePassword();
    });

    $('#btn_updateDescription').click(function() {
        $.fn.updateDescription();
    });

    $('#btn_updateProfile').click(function() {
        $.fn.updateProfile();
    });

    $('#btn_openModalEditDescription').click(function() {
        $.fn.openModalEditDescription();
    });

    $('#btn_closeModalEditDescription').click(function() {
        $.fn.closeModalEditDescription();
    });

    $('#btn_openModalEditProfile').click(function() {
        $.fn.openModalEditProfile();
    });

    $('#btn_closeModalEditProfile').click(function() {
        $.fn.closeModalEditProfile();
    });


    $('#current_password').keypress(function() {
        $("#current_password_er").html('').addClass('d-none'); 
    });

    $('#current_password').on('paste', function(e) {
        $("#current_password_er").html('').addClass('d-none'); 
    });

    $('#password').keypress(function() {
        $("#password_er").html('').addClass('d-none'); 
    });

    $('#password').on('paste', function(e) {
        $("#password_er").html('').addClass('d-none'); 
    });

    $('#confirm_password').keypress(function() {
        $("#confirm_password_er").html('').addClass('d-none'); 
    });

    $('#confirm_password').on('paste', function(e) {
        $("#confirm_password_er").html('').addClass('d-none'); 
    });

    $('#connectionpreview_DT_search').keyup(function(e) {
        connectionpreview_DT.search(e.target.value).draw();
    });
    //end:jQuery event triggers

    //begin:init functions
    editdescription_RTE = new RichTextEditor("#editdescription_RTE",
    {
        toolbar: "basic",
        showFloatParagraph: false,
    }); 
    editdescription_RTE.attachEvent("change", function () {    
        $("#editdescription_er").html('').addClass('d-none'); 
    }); 

    dz_profileimage = new Dropzone("#dz_profileimage", { 
        url: baseurl+"profile/settings/upload/profileimage", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 10, // MB
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        init: function() {
            
            this.on("success", function (file, response) {
            if (response.data.status == 200) {

                var filedata = response.data.filename+'|'+
                               response.data.filetype+'|'+
                               response.data.fileextn+'|'+
                               response.data.filesize;

                $("#profileimage").val(filedata);
            } else {
                $("#profileimage").val('');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                $("#profileimage").val('');
                $("#profileimage_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#profileimage").val('');
                $("#profileimage_er").html('').addClass('d-none'); 
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#profileimage").val('');
            //     $("#profileimage_er").html('').addClass('d-none'); 
            // });

        }
    }); 

    $.fn.refreshProfileTab();
    //end:init functions
});

