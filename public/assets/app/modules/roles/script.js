"use strict";

let baseurl = $("#baseurl").attr('href');


var tx = function () {

    // Define shared variables
    var table = document.getElementById('kt_table_roles');
    var datatable;

    var initDataTable = function () {
        // Init datatable --- more info on datatables: https://datatables.net/manual/
        datatable = $(table).DataTable({
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

    var updatePermissions = () => {
        $('.form-check-input').change(function() {

            var access = 0;
    
            if (this.checked) {
                access = 1;
            } 
    
            axios.post(baseurl+'configs/user-management/roles/permissions/update', {
                permissionid: $(this).attr("data-pid"), 
                mode: $(this).attr("data-mode"), 
                access: access
            }).then(function (response) {
                
                if (response.data.status!=200) {
    
                    Swal.fire({
                        text: response.data.message,
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
            
            if (table) {
                initDataTable();
                handleSearchDatatable();
            }
            
            updatePermissions();
        }
    }

}();

$(function() {

    tx.init();
    
});