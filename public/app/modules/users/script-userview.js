"use strict";

$(document).ready(function() {

    var connectionpreview_DT;
    var connectionadd_DT;

    //begin:jQuery function defenitions
    $.fn.openModalAddConnection = function() { 

        axios.post(baseurl+'configs/users/get/role/connections', {
            userid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {
                
            $.fn.resetDataTableConnectionAdd(response.data.data);
            $('#addConnectionModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalAddConnection = function() { 
        $('#addConnectionModal').modal('hide');
    }

    $.fn.openAlertDeleteConnection = function(id) { 
        Swal.fire({
            title: 'Delete Confirmation',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Cofirm'
        }).then((result) => {
            if (result.isConfirmed) {
                $.fn.deleteConnection(id);
            }
        });
    }
    //end:jQuery function defenitions

    //begin:tab functions
    $.fn.refreshProfileTab = function() { 
        axios.post(baseurl+'configs/users/get/profile', {
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
        axios.post(baseurl+'configs/users/get/settings', {
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

    $.fn.updateUserRole = function(roleid) {
        axios.post(baseurl+'configs/users/update/role', {
            userid: $('#pagedata-container').data('pid'),
            roleid: roleid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#dsp_rolename').html(response.data.data.user.rolename);
            $.fn.showPageAlert('success', response.data.message);
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.addConnection = function(connid) {
        axios.post(baseurl+'configs/users/save/connection', {
            userid: $('#pagedata-container').data('pid'),
            connid: connid,
        }).then(function (response) {
            if (response.data.status==200) {
                $.fn.resetDataTableConnectionAdd(response.data.data.connections);
                $.fn.showModalAlert('addconnection', 'success', response.data.message);
                $.fn.refreshProfileTab();
            } else {
                $.fn.showErrorMessage(response.data.message);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteConnection = function(id) {
        axios.post(baseurl+'configs/users/delete/connection', {
            id: id
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.resetDataTableConnectionPreview(response.data.data.connections);
            $.fn.showPageAlert('success', response.data.message);
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:tab functions

    //begin:tab reset functions
    $.fn.resetProfileTab = function(data) {
        
        $.fn.hideTabAlert('profile');
        if (data.description!=null) {
            $('#dsp_userabout').html(data.description);
        } else {
            $('#dsp_userabout').html('This user has not given any content for this section.');
        }

        $.fn.resetDataTableConnectionPreview(data.connections);
    }

    $.fn.resetSettingsTab = function(data) {
        $.fn.hideTabAlert('settings');
        $("input[name=roleid][value=" + data.roleid + "]").prop('checked', true);
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

        //use off to prevent calling the function multiples times on each initialization
        $(document).off().on('click', '.btn_deleteConnection', function() {
            $.fn.openAlertDeleteConnection($(this).data('actionid'));
        });

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

    $.fn.resetDataTableConnectionAdd = function(dataset) {

        console.log(dataset);
        $('#connectionadd_DT').DataTable().clear().destroy();
        $('#connectionadd_body').empty();

        $.each(dataset, function(index, datarow) {
            $.fn.addConnectionAddElement(datarow);
        });

        $('#connectionadd_DT_search').val('');

        connectionadd_DT = $('#connectionadd_DT').DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "bPaginate": false,
            "lengthChange": false,
            'columnDefs': [],
            "destroy": true,
        });
        // connectionadd_DT.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        // });

        console.log("XXX");
        //use off to prevent calling the function multiples times on each initialization
        $(document).off().on('click', '.btn_addConnection', function() {
            $.fn.addConnection($(this).data('actionid'));
        });
        
    }
    //end:reset datatable functions


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
        '<button data-actionid="'+datarow.id+'" type="button" class="btn_deleteConnection form-action-btn" tabindex="-1">Remove</button>'+
        '</td>'+
        '</tr>';

        $('#connectionpreview_body').append(el);
    }

    $.fn.addConnectionAddElement = function(datarow) {
        var el = '<tr id="dt_connectionadd_row_'+datarow.id+'" class="odd">'+
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
                '<span class="fs-12">'+datarow.rolename+'</span>'+
            '</div>'+
        '</td>'+
        '<td class="text-end">'+
        '<button data-actionid="'+datarow.id+'" type="button" class="btn_addConnection form-action-btn" tabindex="-1">Add</button>'+
        '</td>'+
        '</tr>';

        $('#connectionadd_body').append(el);
    }
    //end:element functions



    //begin:jQuery event triggers
    $('#tabbtn_profile').click(function() {
        $.fn.refreshProfileTab();
    });

    $('#tabbtn_settings').click(function() {
        $.fn.refreshSettingsTab();
    });

    $('#btn_openModalAddConnection').click(function() {
        $.fn.openModalAddConnection();
    });

    $('#btn_closeModalAddConnection').click(function() {
        $.fn.closeModalAddConnection();
    });

    $('.btn_deleteConnection').click(function() {
        $.fn.openAlertDeleteConnection($(this).data('actionid'));
    });



    $('#connectionpreview_DT_search').keyup(function(e) {
        connectionpreview_DT.search(e.target.value).draw();
    });

    $('#connectionadd_DT_search').keyup(function(e) {
        connectionadd_DT.search(e.target.value).draw();
    });

    $('input[name="roleid"]').change(function() {
        var roleid = $( 'input[name=roleid]:checked' ).val();
        $.fn.updateUserRole(roleid);
    });
    //end:jQuery event triggers

    //begin:init functions
    $.fn.refreshProfileTab();
    //end:init functions
});

