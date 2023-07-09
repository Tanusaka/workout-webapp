"use strict";

let baseurl = $("#baseurl").attr('href');

// Class definition
var KTCourseView = function() {

    // Elements

    

    var tabpanes;
    
    var tab_course_overview;
    var tab_course_content;
    var tab_course_instructor;
    var tab_course_reviews;
    var tab_course_followers;
    var tab_course_activity;
    var tab_course_settings;

    var tabpane_course_overview;
    var tabpane_course_content;
    var tabpane_course_instructor;
    var tabpane_course_reviews;
    var tabpane_course_followers;
    var tabpane_course_activity;
    var tabpane_course_settings;

    var course_overview_body;
    var course_content_body;

    

    var form_update_course;
    var form_update_course_submit;

    var form_add_section;
    var form_add_section_submit;

    var form_update_section;
    var form_update_section_submit;

    var form_add_content;
    var form_add_lesson_submit;

    var form_update_content;
    var form_update_lesson_submit;


    var getid = function() {
        const url = document.URL;
        var id = url.substring(url.lastIndexOf('/') + 1);

        return id;
    }

    var popupError = function(response) {
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
    }

    var initDropZone = function() {

        if ($('#kt_edt_courseimage').length) {
            let dz_edtcourseimage = new Dropzone("#kt_edt_courseimage", { 
                url: baseurl+"libraries/courses/upload/image", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                init: function() {
                    var dz_courseimage = this;
                    this.on("success", function (file, response) {
    
                        if (response.data.status == 200) {
                            $("input[name='edt_courseimage']").val(response.data.filename);
                        } else {
                            $("input[name='edt_courseimage']").val('');
                        }
                        // response.image will be the relative path to your uploaded image.
                        // You could also use response.status to check everything went OK,
                        // maybe show an error msg from the server if not.
                    });
                    this.on("removedfile", function (file) {
                        //triggers wher removeing file
                        $("input[name='edt_courseimage']").val('');
                    });
                    this.on("maxfilesexceeded", function(file) {
                        
                        Swal.fire({
                            text: "Sorry, multiple files are not allowed.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {                            
                            
                        });

                        this.removeAllFiles();
                    });
    
                }
            }); 
        }

        if ($('#kt_crt_lessonmedia').length) {
            let dz_crtlessonmedia = new Dropzone("#kt_crt_lessonmedia", { 
                url: baseurl+"libraries/courses/content/section/lesson/upload", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                init: function() {
                    var dz_courseimage = this;
                    this.on("success", function (file, response) {
                        if (response.data.status == 200) {
                            $("input[name='crt_lessonmedia']").val(response.data.filename);
                        } else {
                            $("input[name='crt_lessonmedia']").val('');
                        }
                    });
                    this.on("removedfile", function (file) {
                        //triggers wher removeing file
                        $("input[name='crt_lessonmedia']").val('');
                    });
                    this.on("maxfilesexceeded", function(file) {
                        
                        Swal.fire({
                            text: "Sorry, multiple files are not allowed.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {                            
                            
                        });

                        this.removeAllFiles();
                    });
                }
            }); 
        }

        if ($('#kt_edt_lessonmedia').length) {
            let dz_crtlessonmedia = new Dropzone("#kt_edt_lessonmedia", { 
                url: baseurl+"libraries/courses/content/section/lesson/upload", // Set the url for your upload script location
                paramName: "file", // The name that will be used to transfer the file
                maxFiles: 1,
                maxFilesize: 10, // MB
                addRemoveLinks: true,
                init: function() {
                    var dz_courseimage = this;
                    this.on("success", function (file, response) {
                        if (response.data.status == 200) {
                            $("input[name='edt_lessonmedia']").val(response.data.filename);
                        } else {
                            $("input[name='edt_lessonmedia']").val('');
                        }
                    });
                    this.on("removedfile", function (file) {
                        //triggers wher removeing file
                        $("input[name='edt_lessonmedia']").val('');
                    });
                    this.on("maxfilesexceeded", function(file) {
                        
                        Swal.fire({
                            text: "Sorry, multiple files are not allowed.",
                            icon: "error",
                            buttonsStyling: false,
                            confirmButtonText: "Ok, got it!",
                            customClass: {
                                confirmButton: "btn btn-primary"
                            }
                        }).then(function() {                            
                            
                        });

                        this.removeAllFiles();
                    });
    
                }
            }); 
        }

    }

    

    var getSectionHeader = function(section, permissions) {
        var header =
        '<div class="card-header p-0 mb-5">'+
            '<h3 class="card-title align-items-start flex-column">'+
                '<span class="card-label fw-bold text-dark">'+section.sectionname+'</span>'+
                '<span class="text-gray-400 mt-1 fw-semibold fs-6">7 lectures • 11min total length</span>'+
            '</h3>';

        if (permissions.write=='1') {
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
                '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px pt-2 pb-2" data-kt-menu="true" style="">'+
                    '<div class="menu-item px-3">'+
                        '<a data-id="'+section.id+'"'+' href="#" class="modal_addcontent menu-link px-3">New Lesson</a>'+
                    '</div>'+
                    '<div class="separator mb-3 opacity-75"></div>'+
                    '<div class="menu-item px-3">'+
                        '<a data-id="'+section.id+'"'+' href="#" class="modal_editsection menu-link px-3">Edit Section</a>'+
                    '</div>'+
                    //'<div class="menu-item px-3">'+
                    //    '<a data-id="'+section.id+'"'+' href="#" class="modal_deletesection menu-link px-3">Delete Section</a>'+
                    //'</div>'+
                '</div>'+
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
                        '<a data-id="'+lesson.id+'"'+' href="#" class="modal_viewcontent text-gray-800 text-hover-primary"><i class="fa fa-video me-1 text-warning fs-5"></i> '+lesson.lessonname+'</a>'+
                    '</div>'+
                    '<div class="d-flex align-items-center">'+
                        '<div class="me-6">'+
                            '<span class="text-gray-800">'+lesson.lessonduration+'</span>'+
                        '</div>';
        if (permissions.write=='1') {
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
                '<div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px pt-2 pb-2" data-kt-menu="true" style="">'+
                    '<div class="menu-item px-3">'+
                        '<a data-id="'+lesson.id+'"'+' href="#" class="modal_editcontent menu-link px-3">Edit Lesson</a>'+
                    '</div>'+
                    //'<div class="menu-item px-3">'+
                    //    '<a href="#" class="menu-link px-3">Delete Content</a>'+
                    //'</div>'+
                '</div>'+
            '</div>';
        }

       body = body + '</div>'+
                '</div>'+
            '</div>'+
        '</div>';

        return body;
    }

    var refreshOverviewTab = function() {
        axios.post(baseurl+'libraries/courses/get/overview', {
            course_id: getid(), 
        }).then(function (response) {

            if (response.data.status==200) {

                var htmlContent = '';

                htmlContent += '<section class="tab_section">';
                htmlContent += '<div class="tab_section_header m-0"><h3 class="text-dark mb-10">Description</h3></div>';
                htmlContent += '<div class="tab_section_body m-0">';
                htmlContent += '<div class="fs-5 fw-semibold text-gray-600">';
                htmlContent += '<p id="kt_overview" class="mb-8">'+response.data.data+'</p>';
                htmlContent += '</div>';
                htmlContent += '</div>';
                htmlContent += '</section>';

                course_overview_body.innerHTML = htmlContent;
                showTabContent('kt_course_overview');

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
                        location.href = '';
                    }
                });
            }
        }).catch(function (error) {
            popupError(response);
        });
    }

    var refreshContentTab = function() {
        axios.post(baseurl+'libraries/courses/get/contents', {
            course_id: getid(), 
        }).then(function (response) {
            if (response.data.status==200) {

                var htmlContent = '';
                
                response.data.data.forEach( section => {
                    htmlContent += '<section class="tab_section">';
                    htmlContent += getSectionHeader(section, response.data.permissions);

                    KTMenu.createInstances();

                    section.lessons.forEach( lesson => {
                        htmlContent += getSectionBody(lesson, response.data.permissions);
                    });

                    htmlContent += '</section>';
                });
  
                
                course_content_body.innerHTML = htmlContent;

                //initialize modal for view each course content
                initModalViewContent();
                //initialize menu items for each course content
                KTMenu.createInstances();
                //initialize modal for add each course content
                initModalAddLesson();
                //initialize modal for edit each course content
                initModalEditLesson();
                //initialize modal for edit each course section
                initModalEditSection();

                

                showTabContent('kt_course_content');
            } else {

            }
        }).catch(function (error) {
            popupError(response);
        });
    }

    var refreshInstructorTab = function() {
        showTabContent('kt_course_instructor');
    }

    var refreshReviewsTab = function() {
        showTabContent('kt_course_reviews');
    }

    var refreshFollowersTab = function() {
        showTabContent('kt_course_followers');
    }

    var refreshActivityTab = function() {
        showTabContent('kt_course_activity');
    }

    var refreshSettingsTab = function() {
        axios.post(baseurl+'libraries/courses/get/settings', {
            course_id: getid(), 
        }).then(function (response) {
            if (response.data.status==200) {
      
                $("input[name='courseid']").val(response.data.data.courseid);
                $("input[name='course_name']").val(response.data.data.coursename);
                $("input[name='course_intro']").val(response.data.data.courseintro);
                $("#course_description").val(response.data.data.coursedescription);
                $("input[name=course_type][value=" + response.data.data.coursetype + "]").prop('checked', true);


                var mediapath = response.data.data.coursemediapath;
                var media = mediapath.substring(mediapath.lastIndexOf('/') + 1);

                // $("#kt_edt_preview_courseimage").css('background-image', 'url('+mediapath+')');
                $("input[name='edt_courseimage']").val('');

                // if (mediapath == "") {
                //     $("#kt_edt_preview_courseimage_wrapper").hide();
                //     $("#kt_edt_courseimage").show();
                // } else {
                //     $("#kt_edt_courseimage").hide();
                //     $("#kt_edt_preview_courseimage_wrapper").show();
                // }

                Dropzone.forElement('#kt_edt_courseimage').removeAllFiles(true);

                $("#kt_edt_courseimage").show();
                
                showTabContent('kt_course_settings');

            } else {

            }
        }).catch(function (error) {
            popupError(response);
        });
    }

    var updateCourse = function() {
        // Hide loading indication
        form_update_course_submit.removeAttribute('data-kt-indicator');

        // Enable button
        form_update_course_submit.disabled = false;

        axios.post(baseurl+'libraries/courses/update', {
            courseid: getid(),
            coursename: form_update_course.querySelector('[name="course_name"]').value, 
            courseintro: form_update_course.querySelector('[name="course_intro"]').value, 
            coursetype: form_update_course.querySelector('[name="course_type"]:checked').value,
            coursedescription: form_update_course.querySelector('[name="course_description"]').value,
            courseimage: $("input[name='edt_courseimage']").val()
        }).then(function (response) {

            if (response.data.status==200) {
                $('#prof_course_title').text(response.data.data.data.coursename);
                $('#prof_course_subtitle').text(response.data.data.data.courseintro);

                var courseimagepath = response.data.data.data.coursemediapath;
                // var media = mediapath.substring(mediapath.lastIndexOf('/') + 1);

                $('#prof_course_covermedia').attr("src", courseimagepath);

                // $("#kt_edt_preview_courseimage").css('background-image', 'url('+mediapath+')');
                $("input[name='edt_courseimage']").val('');


                Dropzone.forElement('#kt_edt_courseimage').removeAllFiles(true);
                // if (mediapath == "") {
                //     $("#kt_edt_preview_courseimage_wrapper").hide();
                //     $("#kt_edt_courseimage").show();
                // } else {
                //     $("#kt_edt_courseimage").hide();
                //     $("#kt_edt_preview_courseimage_wrapper").show();
                // }

                $("#kt_edt_courseimage").show();

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
                    location.href = '';
                }
            });
        });

    }

    var saveSection = function() {
        // Hide loading indication
        
        form_add_section_submit.removeAttribute('data-kt-indicator');

        // Enable button
        form_add_section_submit.disabled = false;

        axios.post(baseurl+'libraries/courses/content/section/save', {
            courseid: getid(),
            sectionname: form_add_section.querySelector('[name="section_name"]').value, 
        }).then(function (response) {

            if (response.data.status==200) {
                $('#modal_addsection').modal('hide');
                refreshContentTab();
            } else {
                Swal.fire({
                    text: response.data.message.sectionname,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    if (response.data.redirect) {
                        location.href = '';
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
                if (response.data.redirect) {
                    location.href = '';
                }
            });
        });

    }

    var updateSection = function() {
        // Hide loading indication
        
        form_update_section_submit.removeAttribute('data-kt-indicator');

        // Enable button
        form_update_section_submit.disabled = false;

        axios.post(baseurl+'libraries/courses/content/section/update', {
            sectionid: form_update_section.querySelector('[name="section_id"]').value, 
            sectionname: form_update_section.querySelector('[name="section_name"]').value, 
        }).then(function (response) {

            if (response.data.status==200) {
                $('#modal_editsection').modal('hide');
                refreshContentTab();
            } else {
                Swal.fire({
                    text: response.data.message.sectionname,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    if (response.data.redirect) {
                        location.href = '';
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
                if (response.data.redirect) {
                    location.href = '';
                }
            });
        });

    }

    var saveLesson = function() {
        // Hide loading indication
        
        form_add_lesson_submit.removeAttribute('data-kt-indicator');

        // Enable button
        form_add_lesson_submit.disabled = false;

        axios.post(baseurl+'libraries/courses/content/section/lesson/save', {
            sectionid: form_add_content.querySelector('[name="acf_section_id"]').value, 
            lessonname: form_add_content.querySelector('[name="content_name"]').value, 
            lessonmedia: $("input[name='crt_lessonmedia']").val(),
            lessonduration: "30:00",
            lessondescription: $("#content_description").val()
        }).then(function (response) {

            if (response.data.status==200) {
                $('#modal_addcontent').modal('hide');
                refreshContentTab();
            } else {
                Swal.fire({
                    text: response.data.message.lessonname,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    if (response.data.redirect) {
                        location.href = '';
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
                if (response.data.redirect) {
                    location.href = '';
                }
            });
        });

    }

    var updateLesson = function() {
        // Hide loading indication
        
        form_update_lesson_submit.removeAttribute('data-kt-indicator');

        // Enable button
        form_update_lesson_submit.disabled = false;

        axios.post(baseurl+'libraries/courses/content/section/lesson/update', {
            lessonid: form_update_content.querySelector('[name="content_id"]').value, 
            lessonname: form_update_content.querySelector('[name="content_name"]').value, 
            lessonmedia: $("input[name='edt_lessonmedia']").val(),
            lessonduration: "30:00",
            lessondescription: $("#ecf_content_description").val()
        }).then(function (response) {

            if (response.data.status==200) {
                $('#modal_editcontent').modal('hide');
                refreshContentTab();
            } else {
                Swal.fire({
                    text: response.data.message.lessonname,
                    icon: "error",
                    buttonsStyling: false,
                    confirmButtonText: "Ok, got it!",
                    customClass: {
                        confirmButton: "btn btn-primary"
                    }
                }).then(function() {                            
                    if (response.data.redirect) {
                        location.href = '';
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
                if (response.data.redirect) {
                    location.href = '';
                }
            });
        });

    }

    //openModals
    var openModalViewContent = function(id) {
        
        var title = $('#modal_viewcontent_title');
        var media = $('#modal_viewcontent_media');
        var description = $('#modal_viewcontent_description');


        axios.post(baseurl+'libraries/courses/content/section/lesson/get', {
            lessonid: id, 
        }).then(function (response) {
            if (response.data.status==200) {
   
                title.text(response.data.data.lessonname);
                media.attr("src","https://www.youtube.com/embed/TWdDZYNqlg4");
                description.text("We’ve been focused on making the from v4 to v5 but we have also not been afraid to step away been focused on from v4 to v5 speaker approachable making focused a but from a step away afraid to step away been focused Writing a blog post is a little like driving; you can study the highway code (or read articles telling you how to write a blog post) for months, but nothing can prepare you for the real thing like getting behind the wheel");

                $('#modal_viewcontent').modal('show');

            } else {

            }
        }).catch(function (error) {
            popupError(response);
        });
    }

    var openModalAddLesson = function(id) {
        $("input[name='acf_section_id']").val(id);
        $("input[name='crt_lessonmedia']").val(''),
        Dropzone.forElement('#kt_crt_lessonmedia').removeAllFiles(true);
        $('#modal_addcontent').modal('show');
    }

    var openModalEditLesson = function(id) {

        axios.post(baseurl+'libraries/courses/content/section/lesson/get', {
            lessonid: id, 
        }).then(function (response) {
            if (response.data.status==200) {
   
                $("input[name='content_id']").val(response.data.data.id);
                $("input[name='content_name']").val(response.data.data.lessonname);
                $("#ecf_content_description").val(response.data.data.lessondescription);
                $("input[name='edt_lessonmedia']").val(''),
                Dropzone.forElement('#kt_edt_lessonmedia').removeAllFiles(true);
                $('#modal_editcontent').modal('show');

            } else {

            }
        }).catch(function (error) {
            popupError(response);
        });

        
    }

    var openModalEditSection = function(id) {

        axios.post(baseurl+'libraries/courses/content/section/get', {
            sectionid: id, 
        }).then(function (response) {
            if (response.data.status==200) {
   
                $("input[name='section_id']").val(response.data.data.id);
                $("input[name='section_name']").val(response.data.data.sectionname);
                $('#modal_editsection').modal('show');

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
                        location.href = '';
                    }
                });
            }
        }).catch(function (error) {
            popupError(response);
        });
        
    }


    //eventListners
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

    var navigateToCourseInstructor = function(e) {
        tab_course_instructor.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshInstructorTab();
        });
    }

    var navigateToCourseReviews = function(e) {
        tab_course_reviews.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshReviewsTab();
        });
    }

    var navigateToCourseFollowers = function(e) {
       tab_course_followers.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshFollowersTab();
        });
    }

    var navigateToCourseActivity = function(e) {
        tab_course_activity.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshActivityTab();
        });
    }

    var navigateToCourseSettings = function(e) {
        tab_course_settings.addEventListener('click', function (e) {
            // Prevent button default action
            e.preventDefault();
            refreshSettingsTab();
        });
    }

    //initialize modal for view each course content
    var initModalViewContent = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_viewcontent = document.querySelectorAll('.modal_viewcontent');
        
        Array.from(modal_viewcontent).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openModalViewContent(element.getAttribute("data-id"));
            });
        });
    }

    var initModalAddLesson = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_addcontent = document.querySelectorAll('.modal_addcontent');
        
        Array.from(modal_addcontent).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openModalAddLesson(element.getAttribute("data-id"));
            });
        });
    }
    
    var initModalEditLesson = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_editcontent = document.querySelectorAll('.modal_editcontent');
        
        Array.from(modal_editcontent).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openModalEditLesson(element.getAttribute("data-id"));
            });
        });
    }

    var initModalEditSection = function(e) {
        //add Event Listner Click for all elements with same class name
        var modal_editsection = document.querySelectorAll('.modal_editsection');
        
        Array.from(modal_editsection ).forEach(function(element) {
            element.addEventListener('click', function (e) {
                // Prevent button default action
                e.preventDefault();
                openModalEditSection(element.getAttribute("data-id"));
            });
        });
    }
 
    var intitUpdateButton = function(e) {
        // Handle form submit
        form_update_course_submit.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();
            updateCourse();
        });
    }

    var intitAddSectionButton = function(e) {
        // Handle form submit
        form_add_section_submit.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();
            saveSection();
        });
    }

    var intitUpdateSectionButton = function(e) {
        // Handle form submit
        form_update_section_submit.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();
            updateSection();
        });
    }

    var initAddLessonButton = function(e) {
        // Handle form submit
        form_add_lesson_submit.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();
            saveLesson();
        });
    }

    var initUpdateLessonButton = function(e) {
        // Handle form submit
        form_update_lesson_submit.addEventListener('click', function (e) {

            // Prevent button default action
            e.preventDefault();
            updateLesson();
        });
    }

    var showTabContent = function(tabid) {
        tabpanes.forEach(tabpane => {
            if (tabpane.classList.contains('active', 'show')) {
                tabpane.classList.remove('active', 'show');
            }
        });

        if (tabid=="kt_course_content") {
            tabpane_course_content.classList.add('active', 'show');
        } else if (tabid=="kt_course_instructor") {
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

    // Public functions
    return {
        // Initialization
        init: function() {

            tabpanes = document.querySelectorAll('.tab-pane');

            tab_course_overview = document.querySelector('#navigator_course_overview');
            tab_course_content = document.querySelector('#navigator_course_content');
            tab_course_instructor = document.querySelector('#navigator_course_instructor');
            tab_course_reviews = document.querySelector('#navigator_course_reviews');
            tab_course_followers = document.querySelector('#navigator_course_followers');
            tab_course_activity = document.querySelector('#navigator_course_activity');
            tab_course_settings = document.querySelector('#navigator_course_settings');

            tabpane_course_overview = document.querySelector('#kt_course_overview');
            tabpane_course_content = document.querySelector('#kt_course_content');
            tabpane_course_instructor = document.querySelector('#kt_course_instructor');
            tabpane_course_reviews = document.querySelector('#kt_course_reviews');
            
            if ($('#kt_course_followers').length) {
                tabpane_course_followers = document.querySelector('#kt_course_followers');
                navigateToCourseFollowers();
            }

            if ($('#kt_course_activity').length) {
                tabpane_course_activity = document.querySelector('#kt_course_activity');
                navigateToCourseActivity();
            }

            if ($('#kt_course_settings').length) {
                tabpane_course_settings = document.querySelector('#kt_course_settings');
                navigateToCourseSettings();
            }
            
            
            if ($('#kt_course_overview_body').length) {
                course_overview_body = document.querySelector('#kt_course_overview_body');
            }

            if ($('#kt_course_content_body').length) {
                course_content_body = document.querySelector('#kt_course_content_body');
            }

            if ($('#kt_update_course_form').length) {
                form_update_course = document.querySelector('#kt_update_course_form');
            }
            
            if ($('#kt_update_course_submit').length) {
                form_update_course_submit = document.querySelector('#kt_update_course_submit');
                intitUpdateButton(); 
            }

            if ($('#kt_add_section_form').length) {
                form_add_section = document.querySelector('#kt_add_section_form');
            }
            
            if ($('#kt_add_section_submit').length) {
                form_add_section_submit = document.querySelector('#kt_add_section_submit');
                intitAddSectionButton();
            }
            
            if ($('#kt_update_section_form').length) {
                form_update_section = document.querySelector('#kt_update_section_form');
            }

            if ($('#kt_update_section_submit').length) {
                form_update_section_submit = document.querySelector('#kt_update_section_submit');
                intitUpdateSectionButton();
            }
            
            if ($('#kt_add_content_form').length) {
                form_add_content = document.querySelector('#kt_add_content_form');
            }

            if ($('#kt_add_content_submit').length) {
                form_add_lesson_submit = document.querySelector('#kt_add_content_submit');
                initAddLessonButton();
            }

            if ($('#kt_update_content_form').length) {
                form_update_content = document.querySelector('#kt_update_content_form');
            }
            
            if ($('#kt_update_content_submit').length) {
                form_update_lesson_submit = document.querySelector('#kt_update_content_submit');
                initUpdateLessonButton();
            }
            

            initDropZone();

            navigateToCourseOverview();
            navigateToCourseContent();
            navigateToCourseInstructor();
            navigateToCourseReviews();
        
            refreshOverviewTab();

        }
    };
}();

// On document ready
KTUtil.onDOMContentLoaded(function() {
    KTCourseView.init();
});

$(document).ready(function(){

    $(function() {

        function removeCourseImage() {

            axios.post(baseurl+'libraries/courses/remove/image', {
                courseid: $("input[name='courseid']").val(), 
            }).then(function (response) {

                if (response.data.status==200) {
                    var imagepath = '';

                    $("#kt_edt_preview_courseimage").css('background-image', 'url('+imagepath+')');
                    $("input[name='coursemedia']").val(imagepath);
                    $('#prof_course_covermedia').attr("src", imagepath);

                    if (imagepath == "") {
                        $("#kt_edt_preview_courseimage_wrapper").hide();
                        $("#kt_edt_courseimage").show();
                    } else {
                        $("#kt_edt_courseimage").hide();
                        $("#kt_edt_preview_courseimage_wrapper").show();
                    }
                    

                } else {
                    Swal.fire({
                        text: "Sorry, looks like there are some errors detected in removing image, please try again.",
                        icon: "error",
                        buttonsStyling: false,
                        confirmButtonText: "Ok, got it!",
                        customClass: {
                            confirmButton: "btn btn-primary"
                        }
                    }).then(function() {                            
                        if (response.data.redirect) {
                            location.href = '';
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
                    if (response.data.redirect) {
                        location.href = '';
                    }
                });
            });
        }

        $('#kt_edt_preview_courseimage_remove').on('click', function(){
            removeCourseImage();
        });
        
        // $.fn.openModal = function() {
        //     alert("sdsd");
        //     return this;
        // }
        

        $('#modal_addsection').on('show.bs.modal', function(e) {
            $("input[name='section_name']").val('');
        });

        $('#modal_addcontent').on('show.bs.modal', function(e) {
            $("input[name='content_name']").val('');
            $("#content_description").val('');
        });


    });
});