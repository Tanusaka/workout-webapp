"use strict";

let baseurl = $("#baseurl").attr('href');

// Class definition
var tx = function () {

    var form_create_course = document.getElementById('kt_form_create_course');
    var form_edit_course = document.getElementById('kt_form_edit_course');
    var form_delete_course = document.getElementById('kt_form_delete_course');

    var form_create_section = document.getElementById('kt_form_create_section');
    var form_edit_section = document.getElementById('kt_form_edit_section');

    var form_create_lesson = document.getElementById('kt_form_create_lesson');
    var form_edit_lesson = document.getElementById('kt_form_edit_lesson');

    var form_create_review = document.getElementById('kt_form_create_review');

    var tab_container = document.getElementById('kt_tab_container');

    var btn_save_course; var btn_update_course; var btn_delete_course;

    var crt_courseeditor; var edt_courseeditor; var tabpanes;

    var crt_lessoneditor; var edt_lessoneditor;

    var btn_save_section; var btn_update_section; var btn_save_lesson; var btn_update_lesson;
    var btn_save_instructor; var btn_save_review; var btn_save_follower;

    var tab_course_overview; var tab_course_content; var tab_course_instructor; var tab_course_reviews;
    var tab_course_followers; var tab_course_activity; var tab_course_settings;

    var tabpane_course_overview; var tabpane_course_content; var tabpane_course_instructor; var tabpane_course_reviews;
    var tabpane_course_followers; var tabpane_course_activity; var tabpane_course_settings;

    var addsection_modal = document.getElementById('kt_modal_addsection');
    var editsection_modal = document.getElementById('kt_modal_editsection');
    var addlesson_modal = document.getElementById('kt_modal_addlesson');
    var editlesson_modal = document.getElementById('kt_modal_editlesson');
    var viewlesson_modal = document.getElementById('kt_modal_viewlesson');
    var addinstructor_modal = document.getElementById('kt_modal_addinstructor');
    var addreview_modal = document.getElementById('kt_modal_addreview');
    var addfollower_modal = document.getElementById('kt_modal_addfollower');

    var bs_modal_addsection; var bs_modal_editsection; var bs_modal_addlesson; var bs_modal_editlesson; var bs_modal_viewlesson;
    var bs_modal_addinstructor; var bs_modal_addreview; var bs_modal_addfollower;

    var popupError = function(message) {
        Swal.fire({
            text: message,
            icon: "error",
            buttonsStyling: false,
            confirmButtonText: "Ok, got it!",
            customClass: {
                confirmButton: "btn btn-primary"
            }
        }).then(function() {                            
            
        });
    }

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

        // if ($('#kt_crt_lessonmedia').length) {
        // let dz_crtlessonmedia = new Dropzone("#kt_crt_lessonmedia", { 
        //     url: baseurl+"libraries/courses/content/section/lesson/upload", // Set the url for your upload script location
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 1,
        //     maxFilesize: 10, // MB
        //     addRemoveLinks: true,
        //     init: function() {
        //         var dz_courseimage = this;
        //         this.on("success", function (file, response) {
        //             if (response.data.status == 200) {
        //                 $("input[name='crt_lessonmedia']").val(response.data.filename);
        //             } else {
        //                 $("input[name='crt_lessonmedia']").val('');
        //             }
        //         });
        //         this.on("removedfile", function (file) {
        //             //triggers wher removeing file
        //             $("input[name='crt_lessonmedia']").val('');
        //         });
        //         this.on("maxfilesexceeded", function(file) {
        //             popupError("Sorry, multiple files are not allowed");
        //             this.removeAllFiles();
        //         });
        //     }
        // }); 
        // }

        // if ($('#kt_edt_lessonmedia').length) {
        // let dz_crtlessonmedia = new Dropzone("#kt_edt_lessonmedia", { 
        //     url: baseurl+"libraries/courses/content/section/lesson/upload", // Set the url for your upload script location
        //     paramName: "file", // The name that will be used to transfer the file
        //     maxFiles: 1,
        //     maxFilesize: 10, // MB
        //     addRemoveLinks: true,
        //     init: function() {
        //         var dz_courseimage = this;
        //         this.on("success", function (file, response) {
        //             if (response.data.status == 200) {
        //                 $("input[name='edt_lessonmedia']").val(response.data.filename);
        //             } else {
        //                 $("input[name='edt_lessonmedia']").val('');
        //             }
        //         });
        //         this.on("removedfile", function (file) {
        //             //triggers wher removeing file
        //             $("input[name='edt_lessonmedia']").val('');
        //         });
        //         this.on("maxfilesexceeded", function(file) {
        //             popupError("Sorry, multiple files are not allowed.");
        //             this.removeAllFiles();
        //         });

        //     }
        // }); 
        // }
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

    var updateCourse = () => {
        // Handle form submit
        btn_update_course.addEventListener('click', function (e) {
     
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_update_course.removeAttribute('data-kt-indicator');

            // Enable button
            btn_update_course.disabled = false;

            var courseid    = form_edit_course.querySelector('[name="edt_courseid"]').value;
            var coursename  = form_edit_course.querySelector('[name="edt_coursename"]').value;
            var courseintro = form_edit_course.querySelector('[name="edt_courseintro"]').value;
            var coursetype  = '';

            if(form_edit_course.querySelector('[name="edt_coursetype"]:checked')) {
                coursetype = form_edit_course.querySelector('[name="edt_coursetype"]:checked').value;
            } 

            axios.post(baseurl+'libraries/courses/update', {
                courseid: courseid,
                coursename: coursename, 
                courseintro: courseintro, 
                coursetype: coursetype,
                coursedescription: edt_courseeditor.getHTMLCode(),
            }).then(function (response) {

                if (response.data.status==200) {

                    var prof_course_title = document.querySelector('#prof_course_title');
                    var prof_course_subtitle = document.querySelector('#prof_course_subtitle');

                    Swal.fire({
                        text: response.data.message,
                        icon: "success",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {   
                       
                        prof_course_title.innerHTML = coursename;
                        prof_course_subtitle.innerHTML = courseintro;
                        
                    });

                } else {

                    var message = '';

                    if (typeof(response.data.message['coursename']) != "undefined" && 
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

    var deleteCourse = () => {
        // Handle form submit
        btn_delete_course.addEventListener('click', function (e) {
     
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_delete_course.removeAttribute('data-kt-indicator');

            // Enable button
            btn_delete_course.disabled = false;

            Swal.fire({
                text: "Are you sure you would like to delete?",
                icon: "warning",
                showCancelButton: true,
                buttonsStyling: false,
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, return",
                customClass: {
                    confirmButton: "btn btn-primary",
                    cancelButton: "btn btn-active-light"
                }
            }).then(function (result) {
                if (result.value) {
                    
                    axios.post(baseurl+'libraries/courses/delete', {
                        id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
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
                                window.location.replace(baseurl+'libraries/courses');
                            });
            
                        } else {
                            
                            var message = '';
            
                            if (typeof(response.data.message['id']) != "undefined" && 
                            response.data.message['id'] !== null) {
                                message = response.data.message['id'];
                            } else {
                                message = response.data.message;
                            }
            
                            popupError(message);
                        }
            
                    }).catch(function (error) {
                        popupError(error);
                    });

                } else if (result.dismiss === 'cancel') {
                    Swal.fire({
                        text: "Course has not been deleted!.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary",
                        }
                    });
                }
            });

        });
    }

    var saveCourseSection = () => {
        // Handle form submit
        btn_save_section.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_save_section.removeAttribute('data-kt-indicator');

            // Enable button
            btn_save_section.disabled = false;

            axios.post(baseurl+'libraries/courses/content/section/save', {
                courseid: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
                sectionname: form_create_section.querySelector('[name="crt_sectionname"]').value, 
            }).then(function (response) {
       
                if (response.data.status==200) {
                    $('#kt_modal_addsection').modal('hide');
                    resetAddSectionModal();
                    refreshContentTab();
                } else {
                    popupError(response.data.message.sectionname);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });
    }

    var updateCourseSection = () => {

        // Handle form submit
        btn_update_section.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_update_section.removeAttribute('data-kt-indicator');

            // Enable button
            btn_update_section.disabled = false;

            axios.post(baseurl+'libraries/courses/content/section/update', {
                sectionid: form_edit_section.querySelector('[name="edt_sectionid"]').value, 
                sectionname: form_edit_section.querySelector('[name="edt_sectionname"]').value, 
            }).then(function (response) {
    
                if (response.data.status==200) {
                    $('#kt_modal_editsection').modal('hide');
                    resetEditSectionModal();
                    refreshContentTab();
                } else {
                    popupError(response.data.message.sectionname);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });

    }

    var deleteCourseSection = (id) => {
        axios.post(baseurl+'libraries/courses/content/section/delete', {
            id: id, 
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
                    refreshContentTab();
                });

            } else {
                
                var message = '';

                if (typeof(response.data.message['id']) != "undefined" && 
                response.data.message['id'] !== null) {
                    message = response.data.message['id'];
                } else {
                    message = response.data.message;
                }

                popupError(message);
            }

        }).catch(function (error) {
            popupError(error);
        });
    }

    var saveCourseSectionLesson = () => {

        // Handle form submit
        btn_save_lesson.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_save_lesson.removeAttribute('data-kt-indicator');

            // Enable button
            btn_save_lesson.disabled = false;

            axios.post(baseurl+'libraries/courses/content/section/lesson/save', {

                sectionid: form_create_lesson.querySelector('[name="crt_lessonsectionid"]').value, 
                lessonname: form_create_lesson.querySelector('[name="crt_lessonname"]').value, 
                // lessonmedia: form_create_lesson.querySelector('[name="crt_lessonmedia"]').value, 
                // lessonduration: form_create_lesson.querySelector('[name="crt_lessonduration"]').value, 
                lessondescription: crt_lessoneditor.getHTMLCode(),

            }).then(function (response) {
       
                if (response.data.status==200) {
                    $('#kt_modal_addlesson').modal('hide');
                    resetAddLessonModal();
                    refreshContentTab();
                } else {
                    var message = '';
                    
                    if (typeof(response.data.message['lessonname']) != "undefined" && 
                    response.data.message['lessonname'] !== null) {
                        message = response.data.message['lessonname'];
                    } else if (typeof(response.data.message['lessonmediapath']) != "undefined" && 
                    response.data.message['lessonmediapath'] !== null) {
                        message = response.data.message['lessonmediapath'];
                    } else if (typeof(response.data.message['lessonduration']) != "undefined" && 
                    response.data.message['lessonduration'] !== null) {
                        message = response.data.message['lessonduration'];
                    } else if (typeof(response.data.message['lessondescription']) != "undefined" && 
                    response.data.message['lessondescription'] !== null) {
                        message = response.data.message['lessondescription'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }
                    popupError(message);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });

    }

    var updateCourseSectionLesson = () => {

        // Handle form submit
        btn_update_lesson.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_update_lesson.removeAttribute('data-kt-indicator');

            // Enable button
            btn_update_lesson.disabled = false;

            axios.post(baseurl+'libraries/courses/content/section/lesson/update', {
                lessonid: form_edit_lesson.querySelector('[name="edt_lessonid"]').value, 
                lessonname: form_edit_lesson.querySelector('[name="edt_lessonname"]').value, 
                //lessonmedia: form_edit_lesson.querySelector('[name="edt_lessonmedia"]').value, 
                //lessonduration: form_edit_lesson.querySelector('[name="edt_lessonduration"]').value, 
                lessondescription: edt_lessoneditor.getHTMLCode(),
            }).then(function (response) {
    
                if (response.data.status==200) {
                    $('#kt_modal_editlesson').modal('hide');
                    resetEditLessonModal();
                    refreshContentTab();
                } else {
                    var message = '';
                    
                    if (typeof(response.data.message['lessonname']) != "undefined" && 
                    response.data.message['lessonname'] !== null) {
                        message = response.data.message['lessonname'];
                    } else if (typeof(response.data.message['lessonmediapath']) != "undefined" && 
                    response.data.message['lessonmediapath'] !== null) {
                        message = response.data.message['lessonmediapath'];
                    } else if (typeof(response.data.message['lessonduration']) != "undefined" && 
                    response.data.message['lessonduration'] !== null) {
                        message = response.data.message['lessonduration'];
                    } else if (typeof(response.data.message['lessondescription']) != "undefined" && 
                    response.data.message['lessondescription'] !== null) {
                        message = response.data.message['lessondescription'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }
                    popupError(message);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });

    }

    var deleteCourseSectionLesson = (id) => {
        axios.post(baseurl+'libraries/courses/content/section/lesson/delete', {
            id: id, 
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
                    refreshContentTab();
                });

            } else {
                
                var message = '';

                if (typeof(response.data.message['id']) != "undefined" && 
                response.data.message['id'] !== null) {
                    message = response.data.message['id'];
                } else {
                    message = response.data.message;
                }

                popupError(message);
            }

        }).catch(function (error) {
            popupError(error);
        });
    }

    var saveInstructor = () => {

        // Handle form submit
        btn_save_instructor.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_save_instructor.removeAttribute('data-kt-indicator');

            // Enable button
            btn_save_instructor.disabled = false;

            axios.post(baseurl+'libraries/courses/instructors/save', {
                courseid: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
                userid: $('#instructor_selector').val(), 
                type: $('#instructortype_selector').val()
            }).then(function (response) {
       
                if (response.data.status==200) {
                    $('#kt_modal_addinstructor').modal('hide');
                    resetAddInstructorModal();
                    refreshInstructorTab();
                } else {
                    var message = '';
                    
                    if (typeof(response.data.message['userid']) != "undefined" && 
                    response.data.message['userid'] !== null) {
                        message = response.data.message['userid'];
                    } else if (typeof(response.data.message['type']) != "undefined" && 
                    response.data.message['type'] !== null) {
                        message = response.data.message['type'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }
                    popupError(message);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });

    }

    var deleteInstructor = (id) => {
        
        axios.post(baseurl+'libraries/courses/instructors/delete', {
            id: id, 
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
                    refreshInstructorTab();
                });

            } else {
                
                var message = '';

                if (typeof(response.data.message['id']) != "undefined" && 
                response.data.message['id'] !== null) {
                    message = response.data.message['id'];
                } else {
                    message = response.data.message;
                }

                popupError(message);
            }

        }).catch(function (error) {
            popupError(error);
        });
    }

    var saveReview = () => {
        // Handle form submit
        btn_save_review.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_save_review.removeAttribute('data-kt-indicator');

            // Enable button
            btn_save_review.disabled = false;

            axios.post(baseurl+'libraries/courses/reviews/save', {
                courseid: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
                review: form_create_review.querySelector('[name="crt_review"]').value,
                rating: $('#crt_rating_selector').val(), 
            }).then(function (response) {
       
                if (response.data.status==200) {
                    $('#kt_modal_addreview').modal('hide');
                    resetAddReviewModal();
                    refreshReviewTab();
                } else {
                    var message = '';
                    
                    if (typeof(response.data.message['review']) != "undefined" && 
                    response.data.message['review'] !== null) {
                        message = response.data.message['review'];
                    } else if (typeof(response.data.message['rating']) != "undefined" && 
                    response.data.message['rating'] !== null) {
                        message = response.data.message['rating'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }
                    popupError(message);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });
    }

    var deleteReview = (id) => {
        axios.post(baseurl+'libraries/courses/reviews/delete', {
            id: id, 
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
                    refreshReviewTab();
                });

            } else {
                
                var message = '';

                if (typeof(response.data.message['id']) != "undefined" && 
                response.data.message['id'] !== null) {
                    message = response.data.message['id'];
                } else {
                    message = response.data.message;
                }

                popupError(message);
            }

        }).catch(function (error) {
            popupError(error);
        });
    }

    var saveFollower = () => {
        // Handle form submit
        btn_save_follower.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();

            // Hide loading indication
            btn_save_follower.removeAttribute('data-kt-indicator');

            // Enable button
            btn_save_follower.disabled = false;

            axios.post(baseurl+'libraries/courses/followers/save', {
                courseid: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
                userid: $('#follower_selector').val(), 
                type: $('#followertype_selector').val(),
            }).then(function (response) {
       
                if (response.data.status==200) {
                    $('#kt_modal_addfollower').modal('hide');
                    resetAddFollowerModal();
                    refreshFollowerTab();
                } else {
                    var message = '';
                    
                    if (typeof(response.data.message['userid']) != "undefined" && 
                    response.data.message['userid'] !== null) {
                        message = response.data.message['userid'];
                    } else if (typeof(response.data.message['type']) != "undefined" && 
                    response.data.message['type'] !== null) {
                        message = response.data.message['type'];
                    } else {
                        message = 'Sorry, looks like there are some missing fields, please fill all required fields.';
                    }
                    popupError(message);
                }

            }).catch(function (error) {
                popupError(error);

            });

        });
    }

    var deleteFollower = (id) => {
        axios.post(baseurl+'libraries/courses/followers/delete', {
            id: id, 
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
                    refreshFollowerTab();
                });

            } else {
                
                var message = '';

                if (typeof(response.data.message['id']) != "undefined" && 
                response.data.message['id'] !== null) {
                    message = response.data.message['id'];
                } else {
                    message = response.data.message;
                }

                popupError(message);
            }

        }).catch(function (error) {
            popupError(error);
        });
    }

    var refreshOverviewTab = function() {
        axios.post(baseurl+'libraries/courses/get/overview', {
            course_id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
        }).then(function (response) {

            if (response.data.status==200) {

                if ($('#kt_course_overview_body').length) {
                    var course_overview_tagline = document.querySelector('#kt_course_overview_tagline');
                    var course_overview_body = document.querySelector('#kt_course_overview_body');
                    
                    course_overview_tagline.innerHTML = "Published on "+response.data.data.createdat+" by "+response.data.data.createdby;
                    course_overview_body.innerHTML = response.data.data.description;
                }

                showTabContent('kt_course_overview');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
    }

    var refreshContentTab = function() {

        axios.post(baseurl+'libraries/courses/get/contents', {
            course_id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
        }).then(function (response) {

            if (response.data.status==200) {

                if ($('#kt_course_content_body').length) {
                    var course_content_tagline = document.querySelector('#kt_course_content_tagline');
                    var course_content_body = document.querySelector('#kt_course_content_body');

                    var htmlContent = ''; var sectionCount = 0; var lessonCount = 0;

                    response.data.data.forEach( section => {
                        htmlContent += '<section class="tab_section">';
                        htmlContent += getSectionHeader(section, response.data.permissions);

                        section.lessons.forEach( lesson => {
                            htmlContent += getSectionBody(lesson, response.data.permissions);
                            lessonCount++;
                        });

                        sectionCount++;

                        htmlContent += '</section>';
                    });

                    course_content_tagline.innerHTML = sectionCount+" Sections • "+lessonCount+" Lessons";
                    course_content_body.innerHTML = htmlContent;
                }

                //re-initialize KTMenu instances after binding dynamically
                KTMenu.createInstances();
                
                initEditSectionModal();
                initAddLessonModal();
                initEditLessonModal();
                initViewLessonModal();

                opt_deletesection

                //add Event Listner Click for all elements with same class name
                var opt_deletesection = document.querySelectorAll('.opt_deletesection');
                
                Array.from(opt_deletesection).forEach(function(element) {
                    element.addEventListener('click', function (e) {
                        // Prevent button default action
                        e.preventDefault();
                        Swal.fire({
                            text: "Are you sure you would like to delete?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                deleteCourseSection(element.getAttribute("data-id"));			
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Section has not been deleted!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                        
                    });
                });

                //add Event Listner Click for all elements with same class name
                var opt_deletelesson = document.querySelectorAll('.opt_deletelesson');
                
                Array.from(opt_deletelesson).forEach(function(element) {
                    element.addEventListener('click', function (e) {
                        // Prevent button default action
                        e.preventDefault();
                        Swal.fire({
                            text: "Are you sure you would like to delete?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                deleteCourseSectionLesson(element.getAttribute("data-id"));			
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Lesson has not been deleted!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                        
                    });
                });
                
                showTabContent('kt_course_content');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
    }

    var refreshInstructorTab = function() {

        axios.post(baseurl+'libraries/courses/get/instructors', {
            course_id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
        }).then(function (response) {

            if (response.data.status==200) {

                if ($('#kt_course_instructor_body').length) {
                    var course_instructor_tagline = document.querySelector('#kt_course_instructor_tagline');
                    var course_instructor_body = document.querySelector('#kt_course_instructor_body');
                    
                    var htmlContent = ''; var instructorCount = 0;

                    response.data.data.forEach( instructor => {
                        htmlContent += '<section class="tab_section"><div class="card"><div class="card-body p-0 pt-5">';
                        htmlContent += getInstructorCard(instructor, response.data.permissions);
                        htmlContent += '</div></div></section>';
                        instructorCount++;
                    });

                    course_instructor_tagline.innerHTML = instructorCount+" Instructors";
                    course_instructor_body.innerHTML = htmlContent;
                }

                //re-initialize KTMenu instances after binding dynamically
                KTMenu.createInstances();

                //add Event Listner Click for all elements with same class name
                var opt_deleteinstructor = document.querySelectorAll('.opt_deleteinstructor');
                
                Array.from(opt_deleteinstructor).forEach(function(element) {
                    element.addEventListener('click', function (e) {
                        // Prevent button default action
                        e.preventDefault();
                        Swal.fire({
                            text: "Are you sure you would like to delete?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                deleteInstructor(element.getAttribute("data-id"));			
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Instructor has not been deleted!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                        
                    });
                });
                
                showTabContent('kt_course_instructors');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
        
    }

    var refreshReviewTab = function() {
     
        axios.post(baseurl+'libraries/courses/get/reviews', {
            course_id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
        }).then(function (response) {

            if (response.data.status==200) {

                if ($('#kt_course_review_body').length) {
                    var course_review_tagline = document.querySelector('#kt_course_review_tagline');
                    var course_review_body = document.querySelector('#kt_course_review_body');
                    var course_review_stat = document.querySelector('#kt_course_review_stat');
                    
                    var htmlContent = ''; var reviewCount = 0;

                    response.data.data.forEach( review => {
                        htmlContent += '<section class="tab_section">';
                        htmlContent += getReviewCard(review, response.data.permissions);
                        htmlContent += '</section>';
                        reviewCount++;
                    });

                    course_review_tagline.innerHTML = reviewCount+" Reviews";
                    course_review_stat.innerHTML = reviewCount;
                    course_review_body.innerHTML = htmlContent;
                }

                //re-initialize KTMenu instances after binding dynamically
                KTMenu.createInstances();

                //add Event Listner Click for all elements with same class name
                var opt_deletereview = document.querySelectorAll('.opt_deletereview');
                
                Array.from(opt_deletereview).forEach(function(element) {
                    element.addEventListener('click', function (e) {
                        // Prevent button default action
                        e.preventDefault();
                        Swal.fire({
                            text: "Are you sure you would like to delete?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                deleteReview(element.getAttribute("data-id"));			
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Review has not been deleted!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                        
                    });
                });
                
                showTabContent('kt_course_reviews');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
        
    }

    var refreshFollowerTab = function() {
        axios.post(baseurl+'libraries/courses/get/followers', {
            course_id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
        }).then(function (response) {

            if (response.data.status==200) {

                if ($('#kt_course_follower_body').length) {
                    var course_follower_tagline = document.querySelector('#kt_course_follower_tagline');
                    var course_follower_body = document.querySelector('#kt_course_follower_body');
                    var course_follower_stat = document.querySelector('#kt_course_follower_stat');

                    var htmlContent = ''; var followerCount = 0;

                    response.data.data.forEach( follower => {
                        htmlContent += '<section class="tab_section"><div class="card"><div class="card-body p-0 pt-5">';
                        htmlContent += getFollowerCard(follower, response.data.permissions);
                        htmlContent += '</div></div></section>';
                        followerCount++;
                    });

                    course_follower_tagline.innerHTML = followerCount+" Followers";
                    course_follower_stat.innerHTML = followerCount;
                    course_follower_body.innerHTML = htmlContent;
                }

                //re-initialize KTMenu instances after binding dynamically
                KTMenu.createInstances();

                //add Event Listner Click for all elements with same class name
                var opt_deletefollower = document.querySelectorAll('.opt_deletefollower');
                
                Array.from(opt_deletefollower).forEach(function(element) {
                    element.addEventListener('click', function (e) {
                        // Prevent button default action
                        e.preventDefault();
                        Swal.fire({
                            text: "Are you sure you would like to delete?",
                            icon: "warning",
                            showCancelButton: true,
                            buttonsStyling: false,
                            confirmButtonText: "Yes, delete it!",
                            cancelButtonText: "No, return",
                            customClass: {
                                confirmButton: "btn btn-primary",
                                cancelButton: "btn btn-active-light"
                            }
                        }).then(function (result) {
                            if (result.value) {
                                deleteFollower(element.getAttribute("data-id"));			
                            } else if (result.dismiss === 'cancel') {
                                Swal.fire({
                                    text: "Follower has not been deleted!.",
                                    icon: "error",
                                    buttonsStyling: false,
                                    confirmButtonText: "Ok, got it!",
                                    customClass: {
                                        confirmButton: "btn btn-primary",
                                    }
                                });
                            }
                        });
                        
                    });
                });
                
                showTabContent('kt_course_followers');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
    }

    var refreshActivityTab = function() {
        
    }

    var refreshSettingsTab = function() {
        axios.post(baseurl+'libraries/courses/get/settings', {
            course_id: document.URL.substring(document.URL.lastIndexOf('/') + 1), 
        }).then(function (response) {

            if (response.data.status==200) {

                form_edit_course.querySelector('[name="edt_courseid"]').value= response.data.data.courseid;
                form_edit_course.querySelector('[name="edt_coursename"]').value= response.data.data.coursename;
                form_edit_course.querySelector('[name="edt_courseintro"]').value= response.data.data.courseintro;
                $("input[name=edt_coursetype][value=" + response.data.data.coursetype + "]").prop('checked', true);
                edt_courseeditor.setHTMLCode(response.data.data.coursedescription);
                
                showTabContent('kt_course_settings');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
    }

    var resetAddSectionModal = function() {
        form_create_section.querySelector('[name="crt_sectionname"]').value= "";
    }

    var resetEditSectionModal = function() {
        form_edit_section.querySelector('[name="edt_sectionname"]').value= "";
        
    }

    var resetAddLessonModal = function() {
        form_create_lesson.querySelector('[name="crt_lessonsectionid"]').value= "";
        form_create_lesson.querySelector('[name="crt_lessonname"]').value= "";
        // form_create_lesson.querySelector('[name="crt_lessonmedia"]').value= "";
        // form_create_lesson.querySelector('[name="crt_lessonduration"]').value= "";
        crt_lessoneditor.setText("");   
        // Dropzone.forElement('#kt_crt_lessonmedia').removeAllFiles(true);
    }

    var resetEditLessonModal = function() {
        form_edit_lesson.querySelector('[name="edt_lessonid"]').value= "";
        form_edit_lesson.querySelector('[name="edt_lessonname"]').value= "";
        //form_edit_lesson.querySelector('[name="edt_lessonmedia"]').value= "";
        //form_edit_lesson.querySelector('[name="edt_lessonduration"]').value= "";
        edt_lessoneditor.setText("");   
        //Dropzone.forElement('#kt_edt_lessonmedia').removeAllFiles(true);
    }

    var resetViewLessonModal = function() {

    }

    var resetAddInstructorModal = function() {
        $('#instructor_selector').val('').select2();
        $('#instructortype_selector').val('').select2();
        setDataToInstructorsForCourse();
    }

    var resetAddReviewModal = function() {
        form_create_review.querySelector('[name="crt_review"]').value="";
        $('#crt_rating_selector').val('').select2();
    }

    var resetAddFollowerModal = function() {
        $('#follower_selector').val('').select2();
        $('#followertype_selector').val('').select2();
        setDataToFollowersForCourse();
    }

    var navigateToCourseOverview = function(e) {

        tab_course_overview.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshOverviewTab();
        });
    }

    var navigateToCourseContent = function(e) {

        tab_course_content.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshContentTab();
        });
    }

    var navigateToCourseInstructor  = function(e) {

        tab_course_instructor.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshInstructorTab();
        });
    }

    var navigateToCourseReviews  = function(e) {

        tab_course_reviews.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshReviewTab();
        });
    }

    var navigateToCourseFollowers  = function(e) {

        tab_course_followers.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshFollowerTab();
        });
    }

    var navigateToCourseActivity  = function(e) {

        tab_course_activity.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshActivityTab();
        });
    }

    var navigateToCourseSettings  = function(e) {

        tab_course_settings.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshSettingsTab();
        });
    }

    var initEditSectionModal = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_editsection = document.querySelectorAll('.modal_editsection');
        
        Array.from(modal_editsection).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openEditSectionModal(element.getAttribute("data-id"));
            });
        });
    }

    var openEditSectionModal = function(id) {

        axios.post(baseurl+'libraries/courses/content/section/get', {
            sectionid: id, 
        }).then(function (response) {
            if (response.data.status==200) {
   
                form_edit_section.querySelector('[name="edt_sectionid"]').value= response.data.data.id;
                form_edit_section.querySelector('[name="edt_sectionname"]').value= response.data.data.sectionname;
                $('#kt_modal_editsection').modal('show');

            } else {
                popupError(response.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
        
    }

    var initAddLessonModal = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_addlesson = document.querySelectorAll('.modal_addlesson');
        
        Array.from(modal_addlesson).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openAddLessonModal(element.getAttribute("data-id"));
            });
        });
    }
   
    var openAddLessonModal = function(id) {
        form_create_lesson.querySelector('[name="crt_lessonsectionid"]').value= id;
        // form_create_lesson.querySelector('[name="crt_lessonmedia"]').value= "";
        // Dropzone.forElement('#kt_crt_lessonmedia').removeAllFiles(true);
        $('#kt_modal_addlesson').modal('show');
    }

    var initEditLessonModal = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_editlesson = document.querySelectorAll('.modal_editlesson');
        
        Array.from(modal_editlesson).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openEditLessonModal(element.getAttribute("data-id"));
            });
        });
    }

    var openEditLessonModal = function(id) {
        axios.post(baseurl+'libraries/courses/content/section/lesson/get', {
            lessonid: id, 
        }).then(function (response) {
            if (response.data.status==200) {
   
                form_edit_lesson.querySelector('[name="edt_lessonid"]').value= response.data.data.id;
                form_edit_lesson.querySelector('[name="edt_lessonname"]').value= response.data.data.lessonname;
                //form_edit_lesson.querySelector('[name="edt_lessonmedia"]').value= "";
                //form_edit_lesson.querySelector('[name="edt_lessonduration"]').value= response.data.data.lessonduration;
                edt_lessoneditor.setHTMLCode(response.data.data.lessondescription);
                //Dropzone.forElement('#kt_edt_lessonmedia').removeAllFiles(true);
                $('#kt_modal_editlesson').modal('show');

            } else {
                popupError(response.data.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
    }

    var initViewLessonModal = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_viewlesson = document.querySelectorAll('.modal_viewlesson');
        
        Array.from(modal_viewlesson).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openViewLessonModal(element.getAttribute("data-id"));
            });
        });
    }

    var openViewLessonModal = function(id) {
        axios.post(baseurl+'libraries/courses/content/section/lesson/get', {
            lessonid: id, 
        }).then(function (response) {
            if (response.data.status==200) {
   
                // form_edit_lesson.querySelector('[name="edt_lessonid"]').value= response.data.data.id;
                // form_edit_lesson.querySelector('[name="edt_lessonname"]').value= response.data.data.lessonname;
                // form_edit_lesson.querySelector('[name="edt_lessonmedia"]').value= "";
                // form_edit_lesson.querySelector('[name="edt_lessonduration"]').value= response.data.data.lessonduration;
                // edt_lessoneditor.setHTMLCode(response.data.data.lessondescription);
                // Dropzone.forElement('#kt_edt_lessonmedia').removeAllFiles(true);
                $('#modal_view_lessonname').html(response.data.data.lessonname);
                $('#modal_view_lessoncontent').html(response.data.data.lessondescription);
                $('#kt_modal_viewlesson').modal('show');

            } else {
                popupError(response.data.data.message);
            }
        }).catch(function (error) {
            popupError(error);
        });
    }

    var closeAddSectionModal = () => {
        var closeButton = addsection_modal.querySelector('[data-kt-addsection-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            bs_modal_addsection.hide();	
            resetAddSectionModal();
        });
    }

    var closeEditSectionModal = () => {
        var closeButton = editsection_modal.querySelector('[data-kt-editsection-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_editsection.hide();	
            resetEditSectionModal();
        });
    }

    var closeAddLessonModal = () => {
        var closeButton = addlesson_modal.querySelector('[data-kt-addlesson-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_addlesson.hide();	
            resetAddLessonModal();
        });
    }

    var closeEditLessonModal = () => {
        var closeButton = editlesson_modal.querySelector('[data-kt-editlesson-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_editlesson.hide();	
            resetEditLessonModal();
        });
    }

    var closeViewLessonModal = () => {
        var closeButton = viewlesson_modal.querySelector('[data-kt-viewlesson-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_viewlesson.hide();	
            resetViewLessonModal();
        });
    }

    var closeAddInstructorModal = () => {
        var closeButton = addinstructor_modal.querySelector('[data-kt-addinstructor-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_addinstructor.hide();	
            resetAddInstructorModal();
        });
    }

    var closeAddReviewModal = () => {
        var closeButton = addreview_modal.querySelector('[data-kt-addreview-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_addreview.hide();	
            resetAddReviewModal();
        });
    }

    var closeAddFollowerModal = () => {
        var closeButton = addfollower_modal.querySelector('[data-kt-addfollower-modal-action="close"]');
        closeButton.addEventListener('click', e => {
            e.preventDefault();
            
            bs_modal_addfollower.hide();	
            resetAddFollowerModal();
        });
    }

    var setDataToInstructorsForCourse = () => {
        var courseid = document.URL.substring(document.URL.lastIndexOf('/') + 1);
        $('#instructor_selector').select2({
            ajax: {
                url: baseurl+'libraries/courses/instructors/forcourse/'+courseid,
                dataType: 'json'
            }
        });
    }

    var setDataToFollowersForCourse = () => {
        var courseid = document.URL.substring(document.URL.lastIndexOf('/') + 1);
        $('#follower_selector').select2({
            ajax: {
                url: baseurl+'libraries/courses/followers/forcourse/'+courseid,
                dataType: 'json'
            }
        });
    }

    var initTabs = function() {
        tabpanes = document.querySelectorAll('.tab-pane');

        if ($('#navigator_course_overview').length && $('#kt_course_overview').length) {
            tab_course_overview = document.querySelector('#navigator_course_overview');
            tabpane_course_overview = document.querySelector('#kt_course_overview');
            navigateToCourseOverview();
        }

        if ($('#navigator_course_content').length && $('#kt_course_content').length) {
            tab_course_content = document.querySelector('#navigator_course_content');
            tabpane_course_content = document.querySelector('#kt_course_content');
            navigateToCourseContent();
        }

        if ($('#navigator_course_instructor').length && $('#kt_course_instructor').length) {
            tab_course_instructor = document.querySelector('#navigator_course_instructor');
            tabpane_course_instructor = document.querySelector('#kt_course_instructor');
            navigateToCourseInstructor();
        }

        if ($('#navigator_course_reviews').length && $('#kt_course_reviews').length) {
            tab_course_reviews = document.querySelector('#navigator_course_reviews');
            tabpane_course_reviews = document.querySelector('#kt_course_reviews');
            navigateToCourseReviews();
        }

        if ($('#navigator_course_followers').length && $('#kt_course_followers').length) {
            tab_course_followers = document.querySelector('#navigator_course_followers');
            tabpane_course_followers = document.querySelector('#kt_course_followers');
            navigateToCourseFollowers();
        }

        if ($('#navigator_course_activity').length && $('#kt_course_activity').length) {
            tab_course_activity = document.querySelector('#navigator_course_activity');
            tabpane_course_activity = document.querySelector('#kt_course_activity');
            navigateToCourseActivity();
        }
        
        if ($('#navigator_course_settings').length && $('#kt_course_settings').length) {
            tab_course_settings = document.querySelector('#navigator_course_settings');
            tabpane_course_settings = document.querySelector('#kt_course_settings');
            navigateToCourseSettings();
        }

        if (addsection_modal) {
            btn_save_section = document.querySelector('#kt_btn_save_section');
            saveCourseSection();
            bs_modal_addsection = new bootstrap.Modal(addsection_modal);
            closeAddSectionModal();
        }

        if (editsection_modal) {
            btn_update_section = document.querySelector('#kt_btn_update_section');
            updateCourseSection();
            bs_modal_editsection = new bootstrap.Modal(editsection_modal);
            closeEditSectionModal();
        }
        
        if (addlesson_modal) {
            crt_lessoneditor = new RichTextEditor("#kt_crt_lessoneditor", {
                toolbar: "basic",
            });   
            btn_save_lesson = document.querySelector('#kt_btn_save_lesson');
            saveCourseSectionLesson();
            bs_modal_addlesson = new bootstrap.Modal(addlesson_modal);
            closeAddLessonModal();
        }
        
        if (editlesson_modal) {
            edt_lessoneditor = new RichTextEditor("#kt_edt_lessoneditor", {
                toolbar: "basic",
            });   
            btn_update_lesson = document.querySelector('#kt_btn_update_lesson');
            updateCourseSectionLesson();
            bs_modal_editlesson = new bootstrap.Modal(editlesson_modal);
            closeEditLessonModal();
        }

        if (viewlesson_modal) {
            bs_modal_viewlesson = new bootstrap.Modal(viewlesson_modal);
            closeViewLessonModal();
        }

        if (addinstructor_modal) {
            setDataToInstructorsForCourse();
            btn_save_instructor = document.querySelector('#kt_btn_save_instructor');
            saveInstructor();
            bs_modal_addinstructor = new bootstrap.Modal(addinstructor_modal);
            closeAddInstructorModal();
        }

        if (addreview_modal) {
            btn_save_review = document.querySelector('#kt_btn_save_review');
            saveReview();
            bs_modal_addreview = new bootstrap.Modal(addreview_modal);
            closeAddReviewModal();
        }

        if (addfollower_modal) {
            setDataToFollowersForCourse();
            btn_save_follower = document.querySelector('#kt_btn_save_follower');
            saveFollower();
            bs_modal_addfollower = new bootstrap.Modal(addfollower_modal);
            closeAddFollowerModal();
        }

        refreshOverviewTab();
       
    }

    var showTabContent = function(tabid) {
        tabpanes.forEach(tabpane => {
            if (tabpane.classList.contains('active', 'show')) {
                tabpane.classList.remove('active', 'show');
            }
        });

        if (tabid=="kt_course_content") {
            tabpane_course_content.classList.add('active', 'show');
        } else if (tabid=="kt_course_instructors") {
            tabpane_course_instructor.classList.add('active', 'show');
        } else if (tabid=="kt_course_reviews") {
            tabpane_course_reviews.classList.add('active', 'show');
        } else if (tabid=="kt_course_followers") {
            tabpane_course_followers.classList.add('active', 'show');
        } else if (tabid=="kt_course_activity") {
            tabpane_course_activity.classList.add('active', 'show');
        } else if (tabid=="kt_course_settings") {
            tabpane_course_settings.classList.add('active', 'show');
        } else {
            tabpane_course_overview.classList.add('active', 'show');
        }
    }

    var getSectionHeader = function(section, permissions) {
        var header =
        '<div class="card-header p-0 mb-5">'+
            '<h3 class="card-title align-items-start flex-column">'+
                '<span class="card-label fw-bold text-dark">'+section.sectionname+'</span>'+
                '<span class="text-muted mt-1 fw-semibold fs-7">'+section.lessons.length+' Lessons</span>'+
            '</h3>';

        if (permissions.write=='1' || permissions.delete=='1') {
            header = header +
            '<div class="card-toolbar">'+
                '<button id="kt-open" class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">'+
                    '<i class="ki-duotone ki-dots-square fs-1">'+
                        '<span class="path1"></span>'+
                        '<span class="path2"></span>'+
                        '<span class="path3"></span>'+
                        '<span class="path4"></span>'+
                    '</i>'+
                '</button>'+
                '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px pt-2 pb-2" data-kt-menu="true" style="">';
                    
                    if (permissions.write=='1') {
                        header = header +
                        '<div class="menu-item px-3">'+
                            '<a data-id="'+section.id+'"'+' href="#" class="modal_addlesson menu-link px-3">New Lesson</a>'+
                        '</div>'+
                        '<div class="separator mb-3 opacity-75"></div>'+
                        '<div class="menu-item px-3">'+
                            '<a data-id="'+section.id+'"'+' href="#" class="modal_editsection menu-link px-3">Edit Section</a>'+
                        '</div>';
                    }

                    if (permissions.delete=='1') {
                        header = header +
                        '<div class="menu-item px-3">'+
                           '<a data-id="'+section.id+'"'+' href="#" class="opt_deletesection menu-link px-3">Delete Section</a>'+
                        '</div>';
                    }

                    header = header + '</div>'+
            '</div>';
        }

        header = header + '</div>';

        return header;
    }

    var getSectionBody = function(lesson, permissions) {
        var body =
        '<div class="card-body p-0 pt-3">'+
            '<div class="d-flex align-items-sm-center mb-7">'+
                '<div class="d-flex flex-row-fluid align-items-center flex-wrap my-lg-0">'+
                    '<div class="flex-grow-1 my-lg-0 my-2 me-2">'+
                        '<a href="" data-id="'+lesson.id+'"'+' class="modal_viewlesson text-gray-800 text-hover-primary"><i class="fa fa-video me-1 text-warning fs-5"></i> '+lesson.lessonname+'</a>'+
                    '</div>'+
                    '<div class="d-flex align-items-center">'+
                        '<div class="me-6">'+
                            '<span class="text-gray-800"></span>'+
                        '</div>';
        if (permissions.write=='1' || permissions.delete=='1') {
            body = body +
            '<div class="card-toolbar">'+
                '<button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">'+
                    '<i class="ki-duotone ki-dots-square fs-1">'+
                        '<span class="path1"></span>'+
                        '<span class="path2"></span>'+
                        '<span class="path3"></span>'+
                        '<span class="path4"></span>'+
                    '</i>'+
                '</button>'+
                '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px pt-2 pb-2" data-kt-menu="true" style="">';
                    
                    if (permissions.write=='1') {
                        body = body + '<div class="menu-item px-3">'+
                        '<a data-id="'+lesson.id+'"'+' href="#" class="modal_editlesson menu-link px-3">Edit Lesson</a>'+
                        '</div>';
                    }

                    if (permissions.delete=='1') {
                        body = body + '<div class="menu-item px-3">'+
                        '<a data-id="'+lesson.id+'"'+' href="#" class="opt_deletelesson menu-link px-3">Delete Lesson</a>'+
                        '</div>';
                    }

                    body = body +'</div>'+
            '</div>';
        }

       body = body + '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        return body;
    }

    var getInstructorCard = function(instructor, permissions) {

        var card = 
        '<div class="d-flex flex-stack">'+

            '<div class="symbol symbol-40px me-5">'+
                '<img src="assets/media/avatars/300-1.jpg" class="h-50 align-self-center" alt="" />'+
            '</div>'+

            '<div class="d-flex align-items-center flex-row-fluid flex-wrap">'+
                '<div class="flex-grow-1 me-2">'+
                    '<a data-id="'+instructor.id+'"'+' href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">'+instructor.firstname+' '+instructor.lastname+'</a>'+
                    '<span class="text-muted fw-semibold d-block fs-7">'+instructor.type+' Instructor</span>'+
                '</div>';
                if (permissions.delete=='1') {
                    card = card +
                    '<div class="my-0">'+
                        '<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">'+
                            '<i class="ki-duotone ki-category fs-6">'+
                                '<span class="path1"></span>'+
                                '<span class="path2"></span>'+
                                '<span class="path3"></span>'+
                                '<span class="path4"></span>'+
                            '</i>'+
                        '</button>'+
                        '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">'+
                            '<div class="menu-item px-3">'+
                                '<a data-id="'+instructor.id+'"'+' href="#" class="opt_deleteinstructor menu-link px-3">Delete Instructor</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                }
            card = card + '</div>'+
        '</div>'+
        '<div class="separator separator-dashed my-4"></div>';

        return card;
    }

    var getReviewCard = function(review, permissions) {
        var card = 
        '<div class="card mb-5 mb-xxl-8">'+
            '<div class="card-body p-0 pt-5">'+
                '<div class="d-flex align-items-center mb-5">'+

                    '<div class="d-flex align-items-center flex-grow-1">'+
                        '<div class="symbol symbol-45px me-5">'+
                            '<img src="assets/media/avatars/300-1.jpg" alt="" />'+
                        '</div>'+
                        '<div class="d-flex flex-column">'+
                            '<a data-id="'+review.id+'"'+' href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">'+review.firstname+' '+review.lastname +'</a>'+
                            '<span class="text-gray-400 fw-bold">';

                            for (let index = 0; index < review.rating; index++) {
                                card = card + '<i class="fa fa-star me-1 text-warning fs-5"></i>';
                                
                            }

                            card = card + '</span>'+
                        '</div>'+
                    '</div>';

                    if (permissions.delete=='1') {
                        card = card +
                        '<div class="my-0">'+
                            '<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">'+
                                '<i class="ki-duotone ki-category fs-6">'+
                                    '<span class="path1"></span>'+
                                    '<span class="path2"></span>'+
                                    '<span class="path3"></span>'+
                                    '<span class="path4"></span>'+
                                '</i>'+
                            '</button>'+
                            '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">'+
                                '<div class="menu-item px-3">'+
                                    '<a data-id="'+review.id+'"'+' href="#" class="opt_deletereview menu-link px-3">Delete Review</a>'+
                                '</div>'+
                            '</div>'+
                        '</div>';
                    }
                    
                    card = card +'</div>'+
                    '<div class="mb-5">'+
                    '<p class="text-gray-800 fw-normal mb-5">'+review.review+'</p>'+
                    '</div>'+
                '<div class="separator mb-4"></div>'+
            '</div>'+
        '</div>';

        return card;
    }

    var getFollowerCard = function(follower, permissions) {
        var card = 
        '<div class="d-flex flex-stack">'+

            '<div class="symbol symbol-40px me-5">'+
                '<img src="assets/media/avatars/300-11.jpg" class="h-50 align-self-center" alt="" />'+
            '</div>'+

            '<div class="d-flex align-items-center flex-row-fluid flex-wrap">'+
                '<div class="flex-grow-1 me-2">'+
                    '<a data-id="'+follower.id+'"'+' href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">'+follower.firstname+' '+follower.lastname+'</a>'+
                    '<span class="text-muted fw-semibold d-block fs-7">'+follower.type+' Enrollment</span>'+
                '</div>';
                if (permissions.delete=='1') {
                    card = card +
                    '<div class="my-0">'+
                        '<button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">'+
                            '<i class="ki-duotone ki-category fs-6">'+
                                '<span class="path1"></span>'+
                                '<span class="path2"></span>'+
                                '<span class="path3"></span>'+
                                '<span class="path4"></span>'+
                            '</i>'+
                        '</button>'+
                        '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">'+
                            '<div class="menu-item px-3">'+
                                '<a data-id="'+follower.id+'"'+' href="#" class="opt_deletefollower menu-link px-3">Delete Follower</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>';
                }
            card = card + '</div>'+
        '</div>'+
        '<div class="separator separator-dashed my-4"></div>';

        return card;
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
                initTabs();
                initDropZone();
            }

            if (form_edit_course) {
                edt_courseeditor = new RichTextEditor("#kt_edt_courseeditor"); 
                btn_update_course = document.querySelector('#kt_btn_update_course');
                updateCourse();
            }

            if (form_delete_course) {
                btn_delete_course = document.querySelector('#kt_btn_delete_course');
                deleteCourse();
            }
            
        }
    }
}();


$(function() {

    tx.init();
    
});