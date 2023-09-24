"use strict";

let baseurl = $("#baseurl").attr('href');
let dz_media;

$(document).ready(function() {

    //jquery function definitions
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
    }

    $.fn.int_dropzone = function() {  
        if ($('#dz_media').length) {
            dz_media = new Dropzone("#dz_media", { 
                url: baseurl+"libraries/media/upload", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 10, // MB
                acceptedFiles: ".jpeg,.jpg,.png",
                addRemoveLinks: true,
                init: function() {
                    this.on("maxfilesexceeded", function(file) {
                        this.removeAllFiles();
                        this.addFile(file);
                    
                    });
                    this.on("removedfile", function (file) {
                        $("#dz_filename").html('');
                        $("#dz_filetype").html('');
                        $("#dz_fileextn").html('');
                        $("#dz_filesize").html('');
                        $("#dz_filesizeunit").html('');
                    });
                    this.on("success", function (file, response) {
                        if (response.data.status == 200) {
                            $("#dz_filename").html(response.data.filename);
                            $("#dz_filetype").html(response.data.filetype);
                            $("#dz_fileextn").html(response.data.fileextn);
                            $("#dz_filesize").html(response.data.filesize);
                            $("#dz_filesizeunit").html('MB');
                        } else {
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
    
                }
            }); 
        }
    }
    $.fn.reset_dropzone = function() {  
        dz_media.removeAllFiles(true);
        $("#dz_filename").html('');
        $("#dz_filetype").html('');
        $("#dz_fileextn").html('');
        $("#dz_filesize").html('');
        $("#dz_filesizeunit").html('');
    }
    
      

    //jquery event triggers
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

    $('#btn_dlt_media').click(function() {
        if ($('.cbx-selected').length > 0) {
            
            var list = new Array();

            $('.cbx-selected').each(function(i, obj) {
                //var itemid = $(this).data('mid');
                //$("#m-item-"+itemid).remove();
                list.push( $(this).data('mid') );
            });

            axios.post(baseurl+'libraries/media/delete', {
                files: list, 
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
                    if (response.data.redirect) {
                        location.href = response.data.redirect;
                    }
                });

            } else {
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
        $.fn.set_cboxcount();
    });

    $('#btn_sav_media').click(function() {

        if ($('#dz_filename').text()!='') {

            axios.post(baseurl+'libraries/media/save', {
                filename: $('#dz_filename').text(), 
                filetype: $('#dz_filetype').text(), 
                fileextn: $('#dz_fileextn').text(), 
                filesize: $('#dz_filesize').text(),
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
                    if (response.data.redirect) {
                        location.href = response.data.redirect;
                    }
                });

            } else {

            }

            }).catch(function (error) {
                
            });

        }
    });

    $('#btn_close_modal_amm').click(function() {
        $('#addMediaModal').modal('hide');
        $.fn.reset_dropzone();
    });

    $('.dz-remove').click(function() {
        $.fn.reset_dropzone();
    });
    
    



    //init functions
    $.fn.set_cboxcount();
    $.fn.int_dropzone();


});