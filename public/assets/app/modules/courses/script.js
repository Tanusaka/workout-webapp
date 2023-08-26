"use strict";

let baseurl = $("#baseurl").attr('href');

// Class definition
var tx = function () {

    var form_create_course = document.getElementById('kt_form_create_course');
    var tab_container = document.getElementById('kt_tab_container');

    var crt_courseeditor; var btn_save_course;

    var initDropZone = function() {

        if ($('#kt_crt_courseimage').length) {
        let dz_crtcourseimage = new Dropzone("#kt_crt_courseimage", { 
        url: baseurl+"libraries/courses/upload/image", // Set the url for your upload script location
        paramName: "file", // The name that will be used to transfer the file
        maxFiles: 1,
        maxFilesize: 10, // MB
        acceptedFiles: ".jpeg,.jpg,.png",
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

    var saveCourse = () => {

        // Handle form submit
        btn_save_course.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_save_course.removeAttribute('data-kt-indicator');

            // Enable button
            btn_save_course.disabled = false;

            var coursetype = '';

            if(form_create_course.querySelector('[name="crt_coursetype"]:checked')) {
                coursetype = form_create_course.querySelector('[name="crt_coursetype"]:checked').value;
            } 

            axios.post(baseurl+'libraries/courses/save', {
                coursename: form_create_course.querySelector('[name="crt_coursename"]').value, 
                courseintro: form_create_course.querySelector('[name="crt_courseintro"]').value, 
                coursetype: coursetype,
                courseimage: form_create_course.querySelector('[name="crt_courseimage"]').value, 
                coursedescription: form_create_course.querySelector('[name="crt_coursedescription"]').value,
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
                        
                        form_create_course.querySelector('[name="crt_coursename"]').value= "";
                        form_create_course.querySelector('[name="crt_courseintro"]').value= ""; 
                        form_create_course.querySelector('[name="crt_courseimage"]').value= ""; 
                        form_create_course.querySelector('[name="crt_coursedescription"]').value= ""; 
                        var radio = form_create_course.querySelector('[name="crt_coursetype"]:checked').checked = false;
                        
                        if (response.data.redirect) {
                            location.href = response.data.redirect;
                        }
                    });

                } else {

                    var message = '';

                    if (typeof(response.data.message['coursemediapath']) != "undefined" && 
                    response.data.message['coursemediapath'] !== null) {
                        message = response.data.message['coursemediapath'];
                    } else if (typeof(response.data.message['coursename']) != "undefined" && 
                    response.data.message['coursename'] !== null) {
                        message = response.data.message['coursename'];
                    } else if (typeof(response.data.message['courseintro']) != "undefined" && 
                    response.data.message['courseintro'] !== null) {
                        message = response.data.message['courseintro'];
                    } else if (typeof(response.data.message['coursetype']) != "undefined" && 
                    response.data.message['coursetype'] !== null) {
                        message = response.data.message['coursetype'];
                    } else if (typeof(response.data.message['coursedescription']) != "undefined" && 
                    response.data.message['coursedescription'] !== null) {
                        message = response.data.message['coursedescription'];
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


    // Public methods
    return {
        init: function () {

            if (form_create_course) {
                crt_courseeditor = new RichTextEditor("#kt_crt_courseeditor");    
                btn_save_course = document.querySelector('#kt_btn_save_course');

                initDropZone();
                saveCourse();
            }

            if (tab_container) {
                alert();
            }
            
        }
    }
}();


$(function() {

    tx.init();
    
});