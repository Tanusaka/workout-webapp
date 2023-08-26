"use strict";

let baseurl = $("#baseurl").attr('href');


var tx = function () {

    // Define shared variables
    var user_table = document.getElementById('kt_table_users');
    var linkedprofile_table = document.getElementById('kt_table_linkedprofiles');
    
    
    var user_create_form = document.getElementById('kt_create_user_form');
    var user_updateprofile_form = document.getElementById('kt_update_userprofile_form');
    var user_updatepassword_form = document.getElementById('kt_update_userpassword_form');
    var user_updaterole_form = document.getElementById('kt_update_userrole_form');
    
    var linkedprofile_create_form = document.getElementById('kt_modal_addlink_form');

    var linkedprofile_delete_btns = document.querySelectorAll('.del-linked-profile');


    var user_datatable; var linkedprofile_datatable;



    var user_submit_btn; var user_updateprofile_submit_btn; var user_updatepassword_submit_btn; var user_updaterole_submit_btn;

    var linkedprofile_submit_btn;

    var addlink_modal = document.getElementById('kt_modal_addlink');

    var modal;
    
    var initUserDataTable = function () {

        user_datatable = $(user_table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': []
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        user_datatable.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        });
    }

    var handleSearchUserDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            user_datatable.search(e.target.value).draw();
        });
    }

    var initLinkedprofileDataTable = function () {

        linkedprofile_datatable = $(linkedprofile_table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': []
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        linkedprofile_datatable.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        });
    }

    var handleSearchLinkedprofileDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-linkedprofile-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            linkedprofile_datatable.search(e.target.value).draw();
        });
    }

    var saveUser = () => {

        // Handle form submit
        user_submit_btn.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            user_submit_btn.removeAttribute('data-kt-indicator');

            // Enable button
            user_submit_btn.disabled = false;

            var roleid = '';

            if(user_create_form.querySelector('[name="roleid"]:checked')) {
                roleid = user_create_form.querySelector('[name="roleid"]:checked').value;
            } 

            axios.post(baseurl+'configs/user-management/users/save', {
                firstname: user_create_form.querySelector('[name="firstname"]').value, 
                lastname: user_create_form.querySelector('[name="lastname"]').value, 
                email: user_create_form.querySelector('[name="email"]').value, 
                roleid: roleid,
            }).then(function (response) {

                if (response.data.status==200) {

                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {   
                        
                        user_create_form.querySelector('[name="firstname"]').value= "";
                        user_create_form.querySelector('[name="lastname"]').value= ""; 
                        user_create_form.querySelector('[name="email"]').value= ""; 
                        var radio = user_create_form.querySelector('[name="roleid"]:checked').checked = false;
                        
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });

                } else {
                    Swal.fire({
                        text: 'Sorry, looks like there are some missing fields, please fill all required fields.',
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {                            
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });
                }

            }).catch(function (error) {
                console.log(error);
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    
                });
            });


        });

    }

    var updateUserProfile = () => {

        // Handle form submit
        user_updateprofile_submit_btn.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            user_updateprofile_submit_btn.removeAttribute('data-kt-indicator');

            // Enable button
            user_updateprofile_submit_btn.disabled = false;

            axios.post(baseurl+'configs/user-management/users/updateprofile', {
                userid: user_updateprofile_form.querySelector('[name="uid-updateprofile"]').value,
                firstname: user_updateprofile_form.querySelector('[name="firstname"]').value, 
                lastname: user_updateprofile_form.querySelector('[name="lastname"]').value, 
                gender: $('#gender_selector').val(), 
                dob: user_updateprofile_form.querySelector('[name="dob"]').value, 
                mobile: user_updateprofile_form.querySelector('[name="mobile"]').value, 
                address1: user_updateprofile_form.querySelector('[name="address1"]').value, 
                address2: user_updateprofile_form.querySelector('[name="address2"]').value, 
                city: user_updateprofile_form.querySelector('[name="city"]').value, 
                country: user_updateprofile_form.querySelector('[name="country"]').value, 
            }).then(function (response) {

                if (response.data.status==200) {

                    $('#dsp_profilename').html(user_updateprofile_form.querySelector('[name="firstname"]').value
                        +' '+user_updateprofile_form.querySelector('[name="lastname"]').value);
                    
                    $('#dsp_address1').html(user_updateprofile_form.querySelector('[name="address1"]').value);
                    $('#dsp_address2').html(user_updateprofile_form.querySelector('[name="address2"]').value);
                    $('#dsp_city').html(user_updateprofile_form.querySelector('[name="city"]').value);
                    $('#dsp_country').html(user_updateprofile_form.querySelector('[name="country"]').value);

                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {  
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });

                } else {

                    var message = '';
                    
                    if (typeof(response.data.message['firstname']) != "undefined" && 
                    response.data.message['firstname'] !== null) {
                        message = response.data.message['firstname'];
                    } else if (typeof(response.data.message['lastname']) != "undefined" && 
                    response.data.message['lastname'] !== null) {
                        message = response.data.message['lastname'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }

                    Swal.fire({
                        text: message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {                            
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });
                }

            }).catch(function (error) {
                console.log(error);
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    
                });
            });


        });

    }

    var updateUserPassword = () => {

        // Handle form submit
        user_updatepassword_submit_btn.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            user_updatepassword_submit_btn.removeAttribute('data-kt-indicator');

            // Enable button
            user_updatepassword_submit_btn.disabled = false;

            axios.post(baseurl+'configs/user-management/users/updatepassword', {
                userid: user_updatepassword_form.querySelector('[name="uid-updatepw"]').value,
                current_password: user_updatepassword_form.querySelector('[name="current_password"]').value,
                new_password: user_updatepassword_form.querySelector('[name="new_password"]').value,
                confirm_password: user_updatepassword_form.querySelector('[name="confirm_password"]').value
            }).then(function (response) {

                if (response.data.status==200) {

                    user_updatepassword_form.querySelector('[name="current_password"]').value= "";
                    user_updatepassword_form.querySelector('[name="new_password"]').value= ""; 
                    user_updatepassword_form.querySelector('[name="confirm_password"]').value= ""; 

                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {  
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });

                } else {

                    var message = '';
                    
                    if (typeof(response.data.message['current_password']) != "undefined" && 
                    response.data.message['current_password'] !== null) {
                        message = response.data.message['current_password'];
                    } else if (typeof(response.data.message['password']) != "undefined" && 
                    response.data.message['password'] !== null) {
                        message = response.data.message['password'];
                    } else if (typeof(response.data.message['confirm_password']) != "undefined" && 
                    response.data.message['confirm_password'] !== null) {
                        message = response.data.message['confirm_password'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }

                    Swal.fire({
                        text: message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {                            
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });
                }

            }).catch(function (error) {
                console.log(error);
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    
                });
            });

        });

    }

    var updateUserRole = () => {

        // Handle form submit
        user_updaterole_submit_btn.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            user_updaterole_submit_btn.removeAttribute('data-kt-indicator');

            // Enable button
            user_updaterole_submit_btn.disabled = false;

            var roleid = '';

            if(user_updaterole_form.querySelector('[name="roleid"]:checked')) {
                roleid = user_updaterole_form.querySelector('[name="roleid"]:checked').value;
            } 

            axios.post(baseurl+'configs/user-management/users/updaterole', {
                userid: user_updaterole_form.querySelector('[name="uid-updaterole"]').value,
                roleid: roleid
            }).then(function (response) {

                if (response.data.status==200) {

                    $('#dsp_rolename').html($('#kt_user_role_option_'+roleid).data('rolename'));
     

                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {  
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });

                } else {

                    if (typeof(response.data.message['roleid']) != "undefined" && 
                    response.data.message['roleid'] !== null) {
                        message = response.data.message['roleid'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }
                    

                    Swal.fire({
                        text: message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {                            
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });
                }

            }).catch(function (error) {
                console.log(error);
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    
                });
            });

        });

    }

    var saveLinkedProfile = () => {

        // Handle form submit
        linkedprofile_submit_btn.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            linkedprofile_submit_btn.removeAttribute('data-kt-indicator');

            // Enable button
            linkedprofile_submit_btn.disabled = false;

            axios.post(baseurl+'configs/user-management/users/linkedprofiles/save', {
                userid: linkedprofile_create_form.querySelector('[name="uid-addlinkedprofile"]').value, 
                linkedprofileid: $('#linkedprofile_selector').val(), 
            }).then(function (response) {

                if (response.data.status==200) {

                    
                    modal.hide();
                    resetLinkedprofileCreateForm();
                    addRowToLinkedprofileDatatable(response.data.data[0]);

                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() { 
                        location.reload();
                    });

                } else {
                    
                    var message = '';

                    if (typeof(response.data.message['linkedprofileid']) != "undefined" && 
                    response.data.message['linkedprofileid'] !== null) {
                        message = response.data.message['linkedprofileid'];
                    } else {
                        message = response.data.message;
                    }

                    Swal.fire({
                        text: message,
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {                            
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });
                }

            }).catch(function (error) {
                Swal.fire({
                    text: "Sorry, looks like there are some errors detected, please try again.",
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    
                });
            });


        });

    }

    var triggerDeleteLinkedProfile = (linkedprofile_delete_btn, linkid) => {

        // Handle form submit
        linkedprofile_delete_btn.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            linkedprofile_delete_btn.removeAttribute('data-kt-indicator');

            // Enable button
            linkedprofile_delete_btn.disabled = false;

            Swal.fire({
                text: "Are you sure you would like to delete?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    deleteLinkedProfile(linkid);			
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Linked profile has not been deleted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });

        });

    }

    var deleteLinkedProfile = (linkid) => {

        axios.post(baseurl+'configs/user-management/users/linkedprofiles/delete', {
            linkid: linkid, 
        }).then(function (response) {

            if (response.data.status==200) {        

                Swal.fire({
                    text: response.data.message,
                    icon: "success",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() { 
                    location.reload();
                });

            } else {
                
                var message = '';

                if (typeof(response.data.message['id']) != "undefined" && 
                response.data.message['id'] !== null) {
                    message = response.data.message['id'];
                } else {
                    message = response.data.message;
                }

                Swal.fire({
                    text: message,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    if (response.data.redirect) {
                        location.href = response.data.redirect;
                    }
                });
            }

        }).catch(function (error) {
            console.log(error);
            Swal.fire({
                text: "Sorry, looks like there are some errors detected, please try again.",
                icon: "error",
                buttonsStyling: false,
                confirmButtonText: "Ok, got it!",
                customClass: {
                    confirmButton: "btn btn-primary"
                }
            }).then(function() {                            
                
            });
        });
    }

    var closeAddLinkModal = () => {
        var closeButton = addlink_modal.querySelector('[data-kt-addlink-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            modal.hide();	
            resetLinkedprofileCreateForm();
        });
    }
    

    var resetLinkedprofileCreateForm = () => {
        $('#linkedprofile_selector').val('').select2();
    }

    var addRowToLinkedprofileDatatable = (linkedprofile) => {
          
        var status=''; var statusClass = '';

        if (linkedprofile.status=='A') {
            status = 'ACTIVE';
            statusClass = 'badge badge-light-success fw-bold';
        } else {
            status = 'INACTIVE';
            statusClass = 'badge badge-light-danger fw-bold';
        }

        linkedprofile_datatable.row.add( [ 
            '<div class="d-flex align-items-center">'+
            '<!--begin:: Avatar -->'+
            '<div class="symbol symbol-circle symbol-50px overflow-hidden me-3">'+
                '<a href="">'+
                    '<div class="symbol-label fs-3 bg-light-danger text-danger">'+linkedprofile.firstname.toUpperCase().charAt(0)+'</div>'+
                '</a>'+
            '</div>'+
            '<!--end::Avatar-->'+
            '<!--begin::User details-->'+
            '<div class="d-flex flex-column">'+
                '<a href="" class="text-gray-800 text-hover-primary mb-1">'+linkedprofile.firstname+' '+linkedprofile.lastname+'</a>'+
                '<span>'+linkedprofile.email+'</span>'+
            '</div>'+
            '<!--begin::User details-->'+
            '</div>', 
            '<div>'+linkedprofile.rolename+'</div>', 
            '<div>'+
                '<div class="'+statusClass+'">'+status+'</div>'+
            '</div>', 
            '<div class="text-center">'+
                '<a id="del-linked-profile-'+linkedprofile.id+'" class="del-linked-profile" title="Delete Linked Profile">'+
                '<i class="ki-duotone ki-trash-square fs-1 text-danger">'+
                '<i class="path1"></i>'+
                '<i class="path2"></i>'+
                '<i class="path3"></i>'+
                '<i class="path4"></i>'+
                '</i></a>'+
            '</div>'
        ] ).draw();

        

        var dlp = document.getElementById('del-linked-profile-'+linkedprofile.id);

        dlp.addEventListener('click', e => {
            e.preventDefault();

            Swal.fire({
                text: "Are you sure you would like to delete?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    deleteLinkedProfile(linkedprofile.id);	
                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Linked profile has not been deleted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });
            
        });
        
    }

    return {
        init: function () {
            
            if (user_table) {
                initUserDataTable();
                handleSearchUserDatatable();
            }

            if (user_create_form) {
                user_submit_btn = document.querySelector('#kt_create_user_submit');
                saveUser();
            }

            if (user_updateprofile_form) {
                user_updateprofile_submit_btn = document.querySelector('#kt_update_userprofile_submit');
                updateUserProfile();
            }

            if (user_updatepassword_form) {
                user_updatepassword_submit_btn = document.querySelector('#kt_update_userpassword_submit');
                updateUserPassword();
            }

            if (user_updaterole_form) {
                user_updaterole_submit_btn = document.querySelector('#kt_update_userrole_submit');
                updateUserRole();
            }

            if (addlink_modal) {
                modal = new bootstrap.Modal(addlink_modal);
                closeAddLinkModal();
            }


            if (linkedprofile_table) {
                initLinkedprofileDataTable();
                handleSearchLinkedprofileDatatable();
            }

            if (linkedprofile_create_form) {
                linkedprofile_submit_btn = document.querySelector('#kt_linkedprofile_submit');
                saveLinkedProfile();
            }

            if (linkedprofile_delete_btns) {
                linkedprofile_delete_btns.forEach(linkedprofile_delete_btn => {
                    var linkid = linkedprofile_delete_btn.getAttribute('data-linkid');
                    triggerDeleteLinkedProfile(linkedprofile_delete_btn, linkid);
                });
            }

            
        }
    }

}();

$(function() {

    tx.init();
    
});