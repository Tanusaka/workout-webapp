"use strict";

$(document).ready(function() {

    var dz_fileupload;

    //begin:jquery function definitions
    $.fn.openModalAddFile = function() { 
        $.fn.resetFormAddFile();
        $('#addFileModal').modal('show');
    }

    $.fn.closeModalAddFile = function() { 
        $('#addFileModal').modal('hide');
    }

    $.fn.selectall_cboxs = function() { 
        $(".multiple-cbox").prop('checked', true);
        $(".multiple-cbox").addClass('cbx-selected');
    }

    $.fn.deselectall_cboxs = function() { 
        $(".multiple-cbox").prop('checked', false);
        $(".multiple-cbox").removeClass('cbx-selected');
    }

    $.fn.set_cboxcount = function() {  
        var fcount = $('.m-item').length;
        var scount = $('.cbx-selected').length;
        if (scount==fcount && scount!=0) {
            $("#cbx_sall").prop('checked', true);
        } else {
            $("#cbx_sall").prop('checked', false);
        }
        $('#imgselect_count').html('('+scount+'/'+fcount+')');

        if (fcount==0) {
            $('#file_controls').addClass('d-none');
        } else {
            $('#file_controls').removeClass('d-none');
        }
    }

    $.fn.saveFileUpload = function() { 
        axios.post(baseurl+'libraries/files/save', {
            fileupload: $('#fileupload').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('FILE', 'ADD', response.data);
            } else {
            $.fn.showErrorResponse('FILE', 'ADD', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteFile = function() { 

        var files = ''; var len = $('.cbx-selected').length;

        $('.cbx-selected').each(function(i, obj) {
            files = files+$(this).data('mid');
            if(i != len-1) {
                files = files+'-';
            }
        });

        axios.post(baseurl+'libraries/files/delete', {
            files: files, 
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('FILE', 'DELETE', response.data);
            } else {
            $.fn.showErrorResponse('FILE', 'DELETE', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:jquery function definitions

    //begin:set response functions
    $.fn.showSuccessResponse = function(component, event, response) {
        
        if (component=='FILE') {
            if (event=='ADD') {
                $.fn.addFileElement(response.data);
                $.fn.closeModalAddFile();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='DELETE') {
                $.fn.deleteFileElement(response.data.links);
                $.fn.showPageAlert('success', response.message);
            } 
        }
        
    }
    
    $.fn.showErrorResponse = function(component, event, response) {
        
        if (component=='FILE') {
            if (event=='ADD') {
                $.fn.resetFormErrorsAddFile();
                if (typeof(response.message) != "undefined" && 
                response.message !== null) {
                $("#fileupload_er").html(response.message).removeClass('d-none');
                } 
            } else if (event=='DELETE') {
                $.fn.showErrorMessage(response.message);
            } 
        } 
        
    }
    //end:set response functions

    //begin:element functions
    $.fn.addFileElement = function(file) {
        
        var el = '<div id="m-item-'+file.id+'" class="col-sm-2 col-md-2 m-item" data-mpath="'+file.path+file.name+'">'+
            '<div class="custom-control custom-checkbox image-checkbox img-thumb-preview">'+
                '<input type="checkbox" class="multiple-cbox cbx_s custom-control-input" data-mid="'+file.id+'" id="img_cbx_'+file.id+'">'+
                '<label class="custom-control-label" for="img_cbx_'+file.id+'">'+
                    '<img src="'+file.path+file.name+'" alt="#" class="img-fluid">'+
                '</label>'+
                '<div class="media-g-txt-container">'+
                    '<p href="#" class="text-truncate fw-normal fs-12 fc-dark mb-0">'+file.name+'</p>'+
                    '<p href="#" class="text-truncate fw-normal fs-10 fc-light mb-0">'+file.createdat+'</p>'+
                    '<p href="#" class="text-truncate fw-normal fs-10 fc-light mb-0">'+file.size+' MB</p>'+
                '</div>'+
            '</div>'+
        '</div>';

        $('#file_container').append(el);

        $.fn.set_cboxcount();

        $(document).on('click', '.cbx_s', function() {
            if($(this).is(":checked")) {
                $(this).addClass('cbx-selected');
            } else {
                $(this).removeClass('cbx-selected');
            }
            $.fn.set_cboxcount();
        });

    }

    $.fn.deleteFileElement = function(links) {
        $('.m-item').each(function(i, obj) {
            var path  = $(this).data('mpath');

            if ($.inArray(path, links) >= 0) {
                $(this).remove();
            }
        });

        $.fn.set_cboxcount();
    }
    //end:element functions

    //begin:reset form functions
    $.fn.resetFormAddFile = function() {
        $.fn.resetFormErrorsAddFile();

        $("#fileupload").val('');

        $("#dz_filename").html('');
        $("#dz_filetype").html('');
        $("#dz_fileextn").html('');
        $("#dz_filesize").html('');
        $("#dz_filesizeunit").html('');

        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[0].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
          
        $('.dropzone').removeClass('dz-started');

        dz_fileupload.files = [];
        //to reset dropzone after adding files
    }
    //end:reset form functions

    //begin:reset form error functions
    $.fn.resetFormErrorsAddFile = function() {
        $("#fileupload_er").html('').addClass('d-none');  
    }
    //begin:reset form error functions

    //begin:jquery event triggers
    $('#btn_openModalAddFile').click(function() {
        $.fn.openModalAddFile();
    });

    $('#btn_closeModalAddFile').click(function() {
        $.fn.closeModalAddFile();
    });
    
    $('#btn_saveFileUpload').click(function() {
        $.fn.saveFileUpload();
    });

    $('#btn_deleteFile').click(function() {
        if ($('.cbx-selected').length > 0) {
            $.fn.deleteFile();
        } else {
            $.fn.showWarningMessage("Please select files for delete.");
            $.fn.set_cboxcount();
        }
    });

    $('#cbx_sall').change(function() {
        if($(this).is(":checked")) {
            $.fn.selectall_cboxs();
        } else {
            $.fn.deselectall_cboxs();
        }
        $.fn.set_cboxcount();
    });

    $('.cbx_s').click(function() {
        if($(this).is(":checked")) {
            $(this).addClass('cbx-selected');
        } else {
            $(this).removeClass('cbx-selected');
        }
        $.fn.set_cboxcount();
    });
    //end:jquery event triggers  

    //begin:init functions
    dz_fileupload = new Dropzone("#dz_fileupload", { 
        url: baseurl+"libraries/files/upload", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 10, // MB
        acceptedFiles: ".jpeg,.jpg,.png",
        addRemoveLinks: true,
        init: function() {
            
            this.on("success", function (file, response) {
            if (response.data.status == 200) {

                var filedata = response.data.filename+'|'+
                               response.data.filetype+'|'+
                               response.data.fileextn+'|'+
                               response.data.filesize;

                $("#fileupload").val(filedata);

                $("#dz_filename").html(response.data.filename);
                $("#dz_filetype").html(response.data.filetype);
                $("#dz_fileextn").html(response.data.fileextn);
                $("#dz_filesize").html(response.data.filesize);
                $("#dz_filesizeunit").html('MB');

            } else {
                $("#fileupload").val('');
                $("#dz_filename").html('');
                $("#dz_filetype").html('');
                $("#dz_fileextn").html('');
                $("#dz_filesize").html('');
                $("#dz_filesizeunit").html('');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                $("#fileupload").val('');
                $("#dz_filename").html('');
                $("#dz_filetype").html('');
                $("#dz_fileextn").html('');
                $("#dz_filesize").html('');
                $("#dz_filesizeunit").html('');
                $("#fileupload_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#fileupload").val('');
                $("#dz_filename").html('');
                $("#dz_filetype").html('');
                $("#dz_fileextn").html('');
                $("#dz_filesize").html('');
                $("#dz_filesizeunit").html('');
                $("#fileupload_er").html('').addClass('d-none'); 
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#fileupload").val('');
            //     $("#fileupload_er").html('').addClass('d-none');
            // });

        }
    }); 

    $.fn.set_cboxcount();
    //end:init functions
    
});