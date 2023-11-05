"use strict";

$(document).ready(function() {

    var users_DT;

    $('#users_DT_search').keyup(function(e) {
        users_DT.search(e.target.value).draw();
    });    

    //begin:init functions
    users_DT = $('#users_DT').DataTable({
        "info": false,
        'order': [],
        "pageLength": 10,
        "lengthChange": false,
        'columnDefs': [],
        "destroy": true,
    });
    // users_DT.on('draw', function () {
        // initToggleToolbar();
        // handleDeleteRows();
        // toggleToolbars();
    // });

    //end:init functions
    
});