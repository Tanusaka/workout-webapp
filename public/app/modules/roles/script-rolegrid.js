"use strict";

$(document).ready(function() {

    var roles_DT;

    $('#roles_DT_search').keyup(function(e) {
        roles_DT.search(e.target.value).draw();
    });    

    //begin:init functions
    roles_DT = $('#roles_DT').DataTable({
        "info": false,
        'order': [],
        "pageLength": 10,
        "lengthChange": false,
        'columnDefs': [],
        "destroy": true,
    });
    // roles_DT.on('draw', function () {
        // initToggleToolbar();
        // handleDeleteRows();
        // toggleToolbars();
    // });

    //end:init functions
    
});