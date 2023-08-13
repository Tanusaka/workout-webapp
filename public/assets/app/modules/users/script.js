"use strict";

let baseurl = $("#baseurl").attr('href');


var tx = function () {

    // Define shared variables
    var user_table = document.getElementById('kt_table_users');
    var user_create_form = document.getElementById('kt_create_user_form');

    

    var datatable;
    var user_submit_btn;

    var initDataTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(user_table).DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [
                //{ orderable: false, targets: 0 }, // Disable ordering on column 0 (checkbox)
                //{ orderable: false, targets: 6 }, // Disable ordering on column 6 (actions)                
            ]
        });

        // Re-init functions on every table re-draw -- more info: https://datatables.net/reference/event/draw
        datatable.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        });
    }

    // Search Datatable --- official docs reference: https://datatables.net/reference/api/search()
    var handleSearchDatatable = () => {
        const filterSearch = document.querySelector('[data-kt-user-table-filter="search"]');
        filterSearch.addEventListener('keyup', function (e) {
            datatable.search(e.target.value).draw();
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
                    if (response.data.redirect) {
                        location.href = response.data.redirect;
                    }
                });
            });


        });

    }

    return {
        init: function () {
            
            if (user_table) {
                initDataTable();
                handleSearchDatatable();
            }

            if (user_create_form) {
                user_submit_btn = document.querySelector('#kt_create_user_submit');
                saveUser();
            }
            
        }
    }

}();

$(function() {

    tx.init();
    
});