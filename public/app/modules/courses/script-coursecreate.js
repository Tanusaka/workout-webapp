"use strict";

$(document).ready(function() {

    var description_RTE;
    var dz_courseimage;

    //begin:course functions
    $.fn.saveCourse = function() {         
        axios.post(baseurl+'libraries/courses/save/course', {
            coursename: $('#coursename').val(),
            courseintro: $('#courseintro').val(),
            coursedescription: description_RTE.getHTMLCode(),
            courselevel: $('#courselevel').val(),
            coursetype: $('#coursetype').val(),
            courseimage: $('#courseimage').val(),
            instructorprofile: $('#instructorprofile').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE', 'ADD', response.data);
            } else {
            $.fn.showErrorResponse('COURSE', 'ADD', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:course functions

    //begin:response functions
    $.fn.showSuccessResponse = function(component, event, response) {
        if (component=='COURSE') {
            if (event=='ADD') {
                $.fn.resetFormCreateCourse();
                $.fn.showPageAlert('success', response.message);
            }
        } 
    }

    $.fn.showErrorResponse = function(component, event, response) {
        
        if (component=='COURSE') {
            if (event=='ADD') {
                $.fn.resetFormErrorsCreateCourse();
                if (typeof(response.message['coursename']) != "undefined" && 
                response.message['coursename'] !== null) {
                $("#coursename_er").html(response.message['coursename']).removeClass('d-none');
                } 
                if (typeof(response.message['courseintro']) != "undefined" && 
                response.message['courseintro'] !== null) {
                $("#courseintro_er").html(response.message['courseintro']).removeClass('d-none');
                }
                if (typeof(response.message['coursedescription']) != "undefined" && 
                response.message['coursedescription'] !== null) {
                $("#description_er").html(response.message['coursedescription']).removeClass('d-none');
                }
                if (typeof(response.message['courselevel']) != "undefined" && 
                response.message['courselevel'] !== null) {
                $("#courselevel_er").html(response.message['courselevel']).removeClass('d-none');
                } 
                if (typeof(response.message['coursetype']) != "undefined" && 
                response.message['coursetype'] !== null) {
                $("#coursetype_er").html(response.message['coursetype']).removeClass('d-none');
                } 
                if (typeof(response.message['courseimageid']) != "undefined" && 
                response.message['courseimageid'] !== null) {
                $("#courseimage_er").html(response.message['courseimageid']).removeClass('d-none');
                } 
                if (typeof(response.message['instructorprofile']) != "undefined" && 
                response.message['instructorprofile'] !== null) {
                $("#instructorprofile_er").html(response.message['instructorprofile']).removeClass('d-none');
                } 
            } 
        }
        
    }
    //end:response functions

    //begin:reset form functions
    $.fn.resetFormCreateCourse = function() {
        $("#coursename").val('');
        $("#courseintro").val('');
        description_RTE.setHTMLCode('');
        $("#courselevel").val("").trigger("change");   
        $("#coursetype").val("").trigger("change");   
        $("#courseimage").val('');

        if ( !$('#instructorprofile').data('disabled') ) {
            $("#instructorprofile").val("").trigger("change");   
        }
        
        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[0].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
          
        $('.dropzone').removeClass('dz-started');

        dz_courseimage.files = [];
        //to reset dropzone after adding files

        $.fn.resetFormErrorsCreateCourse();
    }
    //end:reset form functions

    //begin:reset form error functions
    $.fn.resetFormErrorsCreateCourse = function() {
        $("#coursename_er").html('').addClass('d-none');  
        $("#courseintro_er").html('').addClass('d-none');  
        $("#description_er").html('').addClass('d-none');  
        $("#courselevel_er").html('').addClass('d-none');  
        $("#coursetype_er").html('').addClass('d-none');  
        $("#courseimage_er").html('').addClass('d-none');  
        $("#instructorprofile_er").html('').addClass('d-none');  
    }
    //end:reset form error functions

    //begin:event trigger functions
    $('#btn_saveCourse').click(function() {
        $.fn.saveCourse();
    });

    $('#coursename').keypress(function() {
        $("#coursename_er").html('').addClass('d-none'); 
    });

    $('#coursename').on('paste', function(e) {
        $("#coursename_er").html('').addClass('d-none'); 
    });

    $('#courseintro').keypress(function() {
        $("#courseintro_er").html('').addClass('d-none'); 
    });

    $('#courseintro').on('paste', function(e) {
        $("#courseintro_er").html('').addClass('d-none'); 
    });

    $('#courselevel').change(function() {
        $("#courselevel_er").html('').addClass('d-none'); 
    });

    $('#coursetype').change(function() {
        $("#coursetype_er").html('').addClass('d-none'); 
    });

    $('#courseimage').change(function() {
        $("#courseimage_er").html('').addClass('d-none'); 
    });

    $('#instructorprofile').change(function() {
        $("#instructorprofile_er").html('').addClass('d-none'); 
    });


    //end:event trigger functions

    //begin:init functions
    description_RTE = new RichTextEditor("#description_RTE",
    {
        toolbar: "basic",
        showFloatParagraph: false,
    });
    description_RTE.attachEvent("change", function () {    
        $("#description_er").html('').addClass('d-none'); 
    }); 

    dz_courseimage = new Dropzone("#dz_courseimage", { 
        url: baseurl+"libraries/courses/upload/courseimage", // Set the url for your upload script location
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

                $("#courseimage").val(filedata);
            } else {
                $("#courseimage").val('');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                $("#courseimage").val('');
                $("#courseimage_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#courseimage").val('');
                $("#courseimage_er").html('').addClass('d-none'); 
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#courseimage").val('');
            //     $("#courseimage_er").html('').addClass('d-none');
            // });

        }
    }); 
    //end:init functions

});