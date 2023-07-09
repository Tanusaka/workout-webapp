"use strict";

let baseurl = $("#baseurl").attr('href');

// Class definition
var KTCourseCreate = function() {

    // Elements
    var form;
    var submitButton;

    var initDropZone = function() {

        if ($('#kt_crt_courseimage').length) {
            let dz_crtcourseimage = new Dropzone("#kt_crt_courseimage", { 
                url: baseurl+"libraries/courses/upload/image", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                init: function() {
                    var dz_courseimage = this;
                    this.on("success", function (file, response) {
    
                        if (response.data.status == 200) {
                            $("input[name='crt_courseimage']").val(response.data.filename);
                        } else {
                            $("input[name='crt_courseimage']").val('');
                        }
                        // response.image will be the relative path to your uploaded image.
                        // You could also use response.status to check everything went OK,
                        // maybe show an error msg from the server if not.
                    });
    
                }
            }); 
        }

    }

    var save_course = function(e) {
        
        // Handle form submit
        submitButton.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            submitButton.removeAttribute('data-kt-indicator');

            // Enable button
            submitButton.disabled = false;

            axios.post(baseurl+'libraries/courses/save', {
                coursename: form.querySelector('[name="course_name"]').value, 
                courseintro: form.querySelector('[name="course_intro"]').value, 
                coursetype: form.querySelector('[name="course_type"]:checked').value,
                courseimage: $("input[name='crt_courseimage']").val(),
                coursedescription: form.querySelector('[name="course_description"]').value,
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
                        
                        form.querySelector('[name="course_name"]').value= "";
                        form.querySelector('[name="course_intro"]').value= ""; 
                        form.querySelector('[name="course_description"]').value= ""; 

                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });

                } else {
                    Swal.fire({
                        text: response.data.message.coursename,
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

    // Public functions
    return {
        // Initialization
        init: function() {
            form = document.querySelector('#kt_create_course_form');
            submitButton = document.querySelector('#kt_create_course_submit');

            initDropZone();

            save_course(); // use for ajax submit
        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTCourseCreate.init();
});