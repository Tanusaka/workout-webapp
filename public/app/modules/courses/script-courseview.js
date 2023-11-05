"use strict";

$(document).ready(function() {

    var editdescription_RTE; 
    var lessondescription_RTE; 
    var editlessondescription_RTE;
    var dz_editcourseimage; 
    var dz_lessonmedia;
    var dz_editlessonmedia;

    var enrollmentpreview_DT;
    var enrollmentadd_DT;

    // //jquery function definitions
    $.fn.openModalEditCourse = function() { 

        axios.post(baseurl+'libraries/courses/get/course', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {
            
            $.fn.resetFormEditCourse();
            
            $('#btn_updateCourse').attr("data-actionid", response.data.data.id);
            $('#editcoursename').val(response.data.data.coursename);
            $('#editcourseintro').val(response.data.data.courseintro);
            $("#editcourselevel").val(response.data.data.courselevel).trigger("change");  
            $("#editcoursetype").val(response.data.data.coursetype).trigger("change");  
            $('#editCourseModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditCourse = function() { 
        $('#editCourseModal').modal('hide');
    }

    $.fn.openModalEditDescription = function() { 

        axios.post(baseurl+'libraries/courses/get/course', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetFormEditCourseDescription();

            $('#btn_updateDescription').attr("data-actionid", response.data.data.id);
            editdescription_RTE.setHTMLCode(response.data.data.coursedescription);
            $('#editDescriptionModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditDescription = function() { 
        $('#editDescriptionModal').modal('hide');
    }

    $.fn.openModalAddSection = function() { 
        $.fn.resetFormAddSection();
        $('#addSectionModal').modal('show');
    }

    $.fn.closeModalAddSection = function() { 
        $('#addSectionModal').modal('hide');
    }

    $.fn.openModalEditSection = function(sectionid) { 

        axios.post(baseurl+'libraries/courses/get/section', {
            sectionid: sectionid
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.resetFormEditSection();
            $('#btn_updateSection').data("actionid", response.data.data.id);
            $('#editsectionname').val(response.data.data.sectionname);
            $('#editSectionModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditSection = function() { 
        $('#editSectionModal').modal('hide');
    }

    $.fn.openModalDeleteSection = function(sectionid) {

        axios.post(baseurl+'libraries/courses/get/section', {
            sectionid: sectionid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#btn_deleteSection').data("actionid", response.data.data.id);
            $('#deleteSectionModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalDeleteSection = function() { 
        $('#deleteSectionModal').modal('hide');
    }

    $.fn.openModalAddLesson = function(sectionid) { 
        $.fn.resetFormAddLesson();
        $('#btn_addLesson').data("actionid", sectionid);
        $('#addLessonModal').modal('show');
    }

    $.fn.closeModalAddLesson = function() { 
        $('#addLessonModal').modal('hide');
    }

    $.fn.openModalEditLesson = function(lessonid) { 

        axios.post(baseurl+'libraries/courses/get/lesson', {
            lessonid: lessonid
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.resetFormEditLesson();
            $('#btn_updateLesson').data("actionid", response.data.data.id);
            $('#editlessonname').val(response.data.data.lessonname);
            $('#editlessonduration').val(response.data.data.lessonduration);
            editlessondescription_RTE.setHTMLCode(response.data.data.lessondescription);
            $('#editLessonModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditLesson = function() { 
        $('#editLessonModal').modal('hide');
    }

    $.fn.openModalDeleteLesson = function(lessonid) { 
        axios.post(baseurl+'libraries/courses/get/lesson', {
            lessonid: lessonid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#btn_deleteLesson').data("actionid", response.data.data.id);
            $('#deleteLessonModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalDeleteLesson = function() { 
        $('#deleteLessonModal').modal('hide');
    }

    $.fn.openModalViewLesson = function(lessonid) { 

        axios.post(baseurl+'libraries/courses/get/lesson', {
            lessonid: lessonid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#dsp_view_lessonname').text(response.data.data.lessonname);
            $('#dsp_view_lessonduration').html('Duration: '+ response.data.data.lessonduration);
            $('#dsp_view_lessondescription').html(response.data.data.lessondescription);
            $('#dsp_view_lessonmedia').attr("src", response.data.data.lessonmedia);
            $('#viewLessonModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalViewLesson = function() { 
        $('#viewLessonModal').modal('hide');
    }

    $.fn.openModalViewEnrollments = function() { 

        axios.post(baseurl+'libraries/courses/get/enrollments', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetDataTableEnrollmentPreview(response.data.data);
            $('#viewEnrollmentModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalViewEnrollments = function() { 
        $('#viewEnrollmentModal').modal('hide');
    }

    $.fn.openModalAddEnrollment = function() { 

        axios.post(baseurl+'libraries/courses/get/users/for/enroll', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetDataTableEnrollmentAdd(response.data.data);
            $('#addEnrollmentModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalAddEnrollment = function() { 
        $('#addEnrollmentModal').modal('hide');
    }

    $.fn.openModalEnrollWithPayment = function(data) { 

        var paymentPlan;
        if (data.paymentinfo.coursepriceplan=="OneTime") {
            paymentPlan = 'One Time';
        } else if (data.paymentinfo.coursepriceplan=="Monthly") {
            paymentPlan = 'Monthly';
        } else if (data.paymentinfo.coursepriceplan=="Yearly") {
            paymentPlan = 'Yearly';
        } else {
            paymentPlan = '';
        }

        $('#pi_coursename').html(data.paymentinfo.coursename);
        $('#pi_note').html('This is a paid course. In order to view the content of this course you have to pay the following amount as a '+paymentPlan+' payment.');
        $('#pi_amount').html('Total: '+data.paymentinfo.courseprice+' '+data.paymentinfo.coursecurrency);

        $('#enrollWithPaymentModal').modal('show');
            
    }

    $.fn.closeModalEnrollWithPayment = function() { 
        $('#enrollWithPaymentModal').modal('hide');
    }

    $.fn.openModalEditInstructor = function() { 

        axios.post(baseurl+'libraries/courses/get/instructors', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

                $.fn.resetFormEditCourseInstructor();

                $('#editinstructorprofile').empty();

                var editinstructorprofile = $('#editinstructorprofile');
                
                $.each(response.data.data.all_instructors, function(index, option) {
                    var optionelement = '';
                    if (response.data.data.current_instructor !=null && option.id==response.data.data.current_instructor.id) {
                        optionelement = new Option(option.firstname+' '+option.lastname, option.id, true, true);
                    } else {
                        optionelement = new Option(option.firstname+' '+option.lastname, option.id, false, false);
                    }
                    editinstructorprofile.append(optionelement).trigger('change');
                });

                editinstructorprofile.trigger({
                    type: 'select2:select',
                    params: {
                        data: response.data.data
                    }
                });

                $('#btn_updateInstructor').attr("data-actionid", $('#pagedata-container').data('pid'));
                $('#editInstructorModal').modal('show');
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalEditInstructor = function() { 
        $('#editInstructorModal').modal('hide');
    }
    
    

    //begin: course functions
    $.fn.updateCourse = function(id) { 
        axios.post(baseurl+'libraries/courses/update/course', {
            courseid: id,
            coursename: $('#editcoursename').val(),
            courseintro: $('#editcourseintro').val(),
            courselevel: $('#editcourselevel').val(),
            coursetype: $('#editcoursetype').val(),
            courseimage: $('#editcourseimage').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE', 'EDIT', response.data);
            } else {
            $.fn.showErrorResponse('COURSE', 'EDIT', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateCourseDescription = function(id) { 
        axios.post(baseurl+'libraries/courses/update/course/description', {
            courseid: id,
            coursedescription: editdescription_RTE.getHTMLCode(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE', 'EDIT_DESCRIPTION', response.data);
            } else {
            $.fn.showErrorResponse('COURSE', 'EDIT_DESCRIPTION', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateCourseInstructor = function(id) { 
        axios.post(baseurl+'libraries/courses/update/course/instructor', {
            courseid: id,
            instructorprofile: $('#editinstructorprofile').val()
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE', 'EDIT_INSTRUCTOR', response.data);
            } else {
            $.fn.showErrorResponse('COURSE', 'EDIT_INSTRUCTOR', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end: course functions

    //begin:section functions
    $.fn.addSection = function() { 
        axios.post(baseurl+'libraries/courses/save/section', {
            courseid: $('#pagedata-container').data('pid'),
            sectionname: $('#sectionname').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('SECTION', 'ADD', response.data);
            } else {
            $.fn.showErrorResponse('SECTION', 'ADD', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateSection = function(sectionid) { 
        axios.post(baseurl+'libraries/courses/update/section', {
            sectionid: sectionid,
            sectionname: $('#editsectionname').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('SECTION', 'EDIT', response.data);
            } else {
            $.fn.showErrorResponse('SECTION', 'EDIT', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteSection = function(sectionid) { 
        axios.post(baseurl+'libraries/courses/delete/section', {
            sectionid: sectionid,
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('SECTION', 'DELETE', response.data);
            } else {
            $.fn.showErrorResponse('SECTION', 'DELETE', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:section functions

    //begin:lesson functions
    $.fn.addLesson = function(sectionid) { 
        axios.post(baseurl+'libraries/courses/save/lesson', {
            sectionid: sectionid,
            lessonname: $('#lessonname').val(),
            lessonduration: $('#lessonduration').val(),
            lessondescription: lessondescription_RTE.getHTMLCode(),
            lessonmedia: $('#lessonmedia').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('LESSON', 'ADD', response.data);
            } else {
            $.fn.showErrorResponse('LESSON', 'ADD', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateLesson = function(lessonid) { 
        axios.post(baseurl+'libraries/courses/update/lesson', {
            lessonid: lessonid,
            lessonname: $('#editlessonname').val(),
            lessonduration: $('#editlessonduration').val(),
            lessondescription: editlessondescription_RTE.getHTMLCode(),
            lessonmedia: $('#editlessonmedia').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('LESSON', 'EDIT', response.data);
            } else {
            $.fn.showErrorResponse('LESSON', 'EDIT', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteLesson = function(lessonid) { 
        axios.post(baseurl+'libraries/courses/delete/lesson', {
            lessonid: lessonid,
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('LESSON', 'DELETE', response.data);
            } else {
            $.fn.showErrorResponse('LESSON', 'DELETE', response.data);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:lesson functions

    //begin:enrollment functions
    $.fn.addEnrollment = function(userid) {
        axios.post(baseurl+'libraries/courses/save/enrollment', {
            courseid: $('#pagedata-container').data('pid'),
            userid: userid,
        }).then(function (response) {
            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE_ENROLLMENT', 'ADD', response.data);
            $.fn.resetEnrollmentPreviewGroup();
            } else {
            $.fn.showErrorResponse('COURSE_ENROLLMENT', 'ADD', response.data);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteEnrollment = function(enrollmentid) {
        axios.post(baseurl+'libraries/courses/delete/enrollment', {
            enrollmentid: enrollmentid,
        }).then(function (response) {
            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE_ENROLLMENT', 'DELETE', response.data);
            $.fn.resetEnrollmentPreviewGroup();
            } else {
            $.fn.showErrorResponse('COURSE_ENROLLMENT', 'DELETE', response.data);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.resetEnrollmentPreviewGroup = function() {
        axios.post(baseurl+'libraries/courses/reset/enrollments', {
            courseid: $('#pagedata-container').data('pid'),
        }).then(function (response) {
            if (response.data.status==200) {

                $('#enrollmentpreview_group').empty();
                if (response.data.data.length > 0) {
                    $.each(response.data.data, function(index, datarow) {
                        $.fn.addEnrollmentPreiviewGroupElement(datarow);
                    });
                    $('#enrollmentpreview_group').append('<span id="btn_openModalViewEnrollments" ' +
                    'class="symbol-label fs-12 mt-2 text-wrap btn-link">&nbsp;&nbsp;View All...</span>');
                    
                    $(document).on('click', '#btn_openModalViewEnrollments', function() {
                        $.fn.openModalViewEnrollments();
                    });
                } else {
                    $('#enrollmentpreview_group').append('<span ' +
                    'class="symbol-label fs-12 mt-2 text-wrap btn-link">No data available in enrollments</span>');
                }
                
            } 
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.enrollNow = function(enrollmentid) {
        axios.post(baseurl+'libraries/courses/accept/enrollment', {
            enrollmentid: enrollmentid,
        }).then(function (response) {
            if (response.data.status==200) {
                location.reload(true);
            } else if (response.data.status==402) {
                $.fn.openModalEnrollWithPayment(response.data.data);
            } else {
                $.fn.showErrorMessage(response.data.message);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    
    // end:enrollment functions


    //begin:set response functions
    $.fn.showSuccessResponse = function(component, event, response) {
        
        if (component=='COURSE') {
            if (event=='EDIT') {
                $('#dsp_coursename').html(response.data.course.coursename);
                $('#dsp_courseintro').html(response.data.course.courseintro);
                $('#dsp_couseimage').attr("src", response.data.course.courseimage);
                $.fn.closeModalEditCourse();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='EDIT_DESCRIPTION') {
                $('#dsp_coursedescription').html(response.data.course.coursedescription);
                $.fn.closeModalEditDescription();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='EDIT_INSTRUCTOR') {
                var instructor = response.data.course.instructor;

                if ($('#card_body_content').length) {
                    $('#dsp_instructorname').html(instructor.firstname+' '+instructor.lastname);
                    $('#dsp_instructoremail').html(instructor.email);

                    if (instructor.profileimage == null) {
                        $('#dsp_instructorthumb').attr("src", "/avatar.png");
                    } else {
                        $('#dsp_instructorthumb').attr("src", ""+instructor.profileimage);
                    }

                    $('#dsp_instructordescription').html(instructor.description);
                } else {
                    $('#card_body_message').html('Instructor profile has been updated. Please Refresh the page to apply new changes.');
                }

                $.fn.closeModalEditInstructor();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='DELETE') {
                
            }
        } else if (component=='SECTION') {
            if (event=='ADD') {
                $.fn.addSectionElement(response.data.section);
                $.fn.closeModalAddSection();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='EDIT') {
                $('#accordion_button_'+response.data.section.id).text(response.data.section.sectionname);
                $.fn.closeModalEditSection();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='DELETE') {
                $.fn.removeSectionElement(response.data.section);
                $.fn.closeModalDeleteSection();
                $.fn.showPageAlert('success', response.message);
            }
        } else if (component=='LESSON') {
            if (event=='ADD') {
                $.fn.addLessonElement(response.data.lesson);
                $.fn.closeModalAddLesson();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='EDIT') {
                $('#dsp_lessonname_'+response.data.lesson.id).text(response.data.lesson.lessonname);
                $('#dsp_lessonduration_'+response.data.lesson.id).text(response.data.lesson.lessonduration);
                $.fn.closeModalEditLesson();
                $.fn.showPageAlert('success', response.message);
            } else if (event=='DELETE') {
                $.fn.removeLessonElement(response.data.lesson);
                $.fn.closeModalDeleteLesson();
                $.fn.showPageAlert('success', response.message);
            }
        } else if (component=='COURSE_ENROLLMENT') {
            if (event=='ADD') {
                $.fn.resetDataTableEnrollmentAdd(response.data);
                $.fn.showModalAlert('addenrollment', 'success', response.message);
            } else if (event=='DELETE') {
                $.fn.resetDataTableEnrollmentPreview(response.data);
                $.fn.showModalAlert('previewenrollment', 'success', response.message);
            }
        }
        
    }

    $.fn.showErrorResponse = function(component, event, response) {
        
        if (component=='COURSE') {
            if (event=='EDIT') {
                $.fn.resetFormErrorsEditCourse();
                if (typeof(response.message['coursename']) != "undefined" && 
                response.message['coursename'] !== null) {
                    $("#editcoursename_er").html(response.message['coursename']).removeClass('d-none');
                } 
                if (typeof(response.message['courseintro']) != "undefined" && 
                response.message['courseintro'] !== null) {
                    $("#editcourseintro_er").html(response.message['courseintro']).removeClass('d-none');
                } 
                if (typeof(response.message['courselevel']) != "undefined" && 
                response.message['courselevel'] !== null) {
                    $("#editcourselevel_er").html(response.message['courselevel']).removeClass('d-none');
                } 
                if (typeof(response.message['coursetype']) != "undefined" && 
                response.message['coursetype'] !== null) {
                    $("#editcoursetype_er").html(response.message['coursetype']).removeClass('d-none');
                } 
                if (typeof(response.message['courseimageid']) != "undefined" && 
                response.message['courseimageid'] !== null) {
                    $("#editcourseimage_er").html(response.message['courseimage']).removeClass('d-none');
                } 
            } else if (event=='EDIT_DESCRIPTION') {
                $.fn.resetFormErrorsEditCourseDescription();
                if (typeof(response.message['coursedescription']) != "undefined" && 
                response.message['coursedescription'] !== null) {
                    $("#editdescription_er").html(response.message['coursedescription']).removeClass('d-none');
                }
            } else if (event=='EDIT_INSTRUCTOR') {
                $.fn.resetFormErrorsEditCourseInstructor();
                if (typeof(response.message['instructorprofile']) != "undefined" && 
                response.message['instructorprofile'] !== null) {
                    $("#editinstructorprofile_er").html(response.message['instructorprofile']).removeClass('d-none');
                }
            } else if (event=='DELETE') {
                
            }

            
        } else if (component=='SECTION') {
            if (event=='ADD') {
                $.fn.resetFormErrorsAddSection();
                if (typeof(response.message['sectionname']) != "undefined" && 
                response.message['sectionname'] !== null) {
                $("#sectionname_er").html(response.message['sectionname']).removeClass('d-none');
                } 
            } else if (event=='EDIT') {
                $.fn.resetFormErrorsEditSection();
                if (typeof(response.message['sectionname']) != "undefined" && 
                response.message['sectionname'] !== null) {
                $("#editsectionname_er").html(response.message['sectionname']).removeClass('d-none');
                } 
            } else if (event=='DELETE') {
                $.fn.closeModalDeleteSection();
                $.fn.showPageAlert('danger', response.message);
            }
        } else if (component=='LESSON') {
            if (event=='ADD') {
                $.fn.resetFormErrorsAddLesson();
                if (typeof(response.message['lessonname']) != "undefined" && 
                response.message['lessonname'] !== null) {
                $("#lessonname_er").html(response.message['lessonname']).removeClass('d-none');
                } 
                if (typeof(response.message['lessonduration']) != "undefined" && 
                response.message['lessonduration'] !== null) {
                $("#lessonduration_er").html(response.message['lessonduration']).removeClass('d-none');
                } 
                if (typeof(response.message['lessondescription']) != "undefined" && 
                response.message['lessondescription'] !== null) {
                $("#lessondescription_er").html(response.message['lessondescription']).removeClass('d-none');
                }
                if (typeof(response.message['lessonmediaid']) != "undefined" && 
                response.message['lessonmediaid'] !== null) {
                $("#lessonmedia_er").html(response.message['lessonmediaid']).removeClass('d-none');
                } 
            } else if (event=='EDIT') {
                $.fn.resetFormErrorsEditLesson();
                if (typeof(response.message['lessonname']) != "undefined" && 
                response.message['lessonname'] !== null) {
                $("#editlessonname_er").html(response.message['lessonname']).removeClass('d-none');
                } 
                if (typeof(response.message['lessonduration']) != "undefined" && 
                response.message['lessonduration'] !== null) {
                $("#editlessonduration_er").html(response.message['lessonduration']).removeClass('d-none');
                } 
                if (typeof(response.message['lessondescription']) != "undefined" && 
                response.message['lessondescription'] !== null) {
                $("#editlessondescription_er").html(response.message['lessondescription']).removeClass('d-none');
                }
                if (typeof(response.message['lessonmediaid']) != "undefined" && 
                response.message['lessonmediaid'] !== null) {
                $("#editlessonmedia_er").html(response.message['lessonmediaid']).removeClass('d-none');
                } 
            } else if (event=='DELETE') {
                $.fn.closeModalDeleteLesson();
                $.fn.showPageAlert('danger', response.message);
            }
        } else if (component=='COURSE_ENROLLMENT') {
            if (event=='ADD') {
                $.fn.showModalAlert('addenrollment', 'danger', response.message);
            } else if (event=='DELETE') {
                $.fn.showModalAlert('previewenrollment', 'danger', response.message);
            }
        }
        
    }
    //end:set response functions

    //begin:reset form functions
    $.fn.resetFormEditCourse = function() {
        $.fn.resetFormErrorsEditCourse();  

        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[0].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
          
        $('.dropzone').removeClass('dz-started');

        dz_editcourseimage.files = [];
        //to reset dropzone after adding files
    }

    $.fn.resetFormEditCourseDescription = function() {
        $.fn.resetFormErrorsEditCourseDescription();  
    }

    $.fn.resetFormEditCourseInstructor = function() {
        $.fn.resetFormErrorsEditCourseInstructor();  
    }

    $.fn.resetFormAddSection = function() {
        $('#sectionname').val('');
        $.fn.resetFormErrorsAddSection();
    }

    $.fn.resetFormEditSection = function() {
        $.fn.resetFormErrorsEditSection();
    }

    $.fn.resetFormAddLesson = function() {

        $('#lessonname').val('');
        $('#lessonduration').val('');
        lessondescription_RTE.setHTMLCode('');
        $('#lessonmedia').val('');

        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[1].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
          
        $('.dropzone').removeClass('dz-started');

        dz_lessonmedia.files = [];
        //to reset dropzone after adding files

        $.fn.resetFormErrorsAddLesson();
    }

    $.fn.resetFormEditLesson = function() {
        $.fn.resetFormErrorsEditLesson();

        $('#editlessonmedia').val('');

        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[2].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
          
        $('.dropzone').removeClass('dz-started');

        dz_editlessonmedia.files = [];
        //to reset dropzone after adding files
    }
    //end:reset form functions

    //begin:reset form error functions
    $.fn.resetFormErrorsEditCourse = function() {
        $("#editcoursename_er").html('').addClass('d-none'); 
        $("#editcourseintro_er").html('').addClass('d-none');  
        $("#editcourselevel_er").html('').addClass('d-none');  
        $("#editcoursetype_er").html('').addClass('d-none');  
        $("#editcourseimage_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsEditCourseDescription = function() {
        $("#editdescription_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsEditCourseInstructor = function() {
        $("#editinstructorprofile_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsAddSection = function() {
        $("#sectionname_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsEditSection = function() {
        $("#editsectionname_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsAddLesson = function() {
        $("#lessonname_er").html('').addClass('d-none');  
        $("#lessonduration_er").html('').addClass('d-none'); 
        $("#lessondescription_er").html('').addClass('d-none'); 
        $("#lessonmedia_er").html('').addClass('d-none'); 
    }

    $.fn.resetFormErrorsEditLesson = function() {
        $("#editlessonname_er").html('').addClass('d-none');  
        $("#editlessonduration_er").html('').addClass('d-none'); 
        $("#editlessondescription_er").html('').addClass('d-none');  
        $("#editlessonmedia_er").html('').addClass('d-none'); 
    }
    //end:reset form error functions

    //begin:reset datatable functions
    $.fn.resetDataTableEnrollmentAdd = function(dataset) {


        $('#enrollmentadd_DT').DataTable().clear().destroy();
        $('#enrollmentadd_body').empty();

        $.each(dataset, function(index, datarow) {
            $.fn.addEnrollmentUserElement(datarow);
        });

        $('#enrollmentadd_DT_search').val('');

        enrollmentadd_DT = $('#enrollmentadd_DT').DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [],
            "destroy": true,
        });
        // enrollmentadd_DT.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        // });

        //use off to prevent calling the function multiples times on each initialization
        $(document).off().on('click', '.btn_addEnrollment', function() {
            $.fn.addEnrollment($(this).data('userid'));
        });
        
    }

    $.fn.resetDataTableEnrollmentPreview = function(dataset) {

        $('#enrollmentpreview_DT').DataTable().clear().destroy();
        $('#enrollmentpreview_body').empty();

        $.each(dataset, function(index, datarow) {
            $.fn.addEnrollmentPreiviewElement(datarow);
        });

        $('#enrollmentpreview_DT_search').val('');

        enrollmentpreview_DT = $('#enrollmentpreview_DT').DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [],
            "destroy": true,
        });
        // enrollmentpreview_DT.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        // });

        //use off to prevent calling the function multiples times on each initialization
        $(document).off().on('click', '.btn_deleteEnrollment', function() {
            $.fn.deleteEnrollment($(this).data('enrollmentid'));
        });

    }
    //end:reset datatable functions

    //begin:element functions
    $.fn.addSectionElement = function(section) {
        
        var el = '<div id="accordion_item_'+section.id+'" class="accordion-item" data-itemid="'+section.id+'">'+
        '<h2 id="section_panel_'+section.id+'" class="accordion-header">'+
        '<button id="accordion_button_'+section.id+'" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#section_panel_collapse_'+section.id+'" aria-expanded="true" aria-controls="section_panel_collapse_'+section.id+'">'+
            section.sectionname+
        '</button>'+
        '</h2>'+
        '<div id="section_panel_collapse_'+section.id+'" class="accordion-collapse collapse show" aria-labelledby="section_panel_'+section.id+'">'+
            
            '<div class="card-header border-0 pt-0">'+
                '<h3 class="card-title align-items-start flex-column"></h3>'+
                '<div class="card-toolbar">'+
                    '<button data-sectionid="'+section.id+'" type="button" class="btn_openModalAddLesson form-action-btn justify-content-end" tabindex="-1">Add Lesson</button>'+
                    '<button data-sectionid="'+section.id+'" type="button" class="btn_openModalEditSection form-action-btn justify-content-end" tabindex="-1">Edit Section</button>'+
                    '<button data-sectionid="'+section.id+'" type="button" class="btn_openModalDeleteSection form-action-btn justify-content-end" tabindex="-1">Delete Section</button>'+
                '</div>'+
            '</div>'+
    
            
            '<div class="accordion-body">'+
                '<ul id="lesson_group'+section.id+'" class="list-group" data-sectionid="'+section.id+'">'+
                    
                '</ul>'+
            '</div>'+
        '</div>'+
        '</div>';

        $('#course_content_accordion').append(el);

        $(document).on('click', '.btn_openModalAddLesson', function() {
            $.fn.openModalAddLesson($(this).data('sectionid'));
        });

        $(document).on('click', '.btn_openModalEditSection', function() {
            $.fn.openModalEditSection($(this).data('sectionid'));
        });

        $(document).on('click', '.btn_openModalDeleteSection', function() {
            $.fn.openModalDeleteSection($(this).data('sectionid'));
        });

    }

    $.fn.addLessonElement = function(lesson) {
        
        var el = '<li id="lesson_item_'+lesson.id+'" class="list-group-item" data-lessonid="'+lesson.id+'">'+
        
        '<div class="d-flex bd-highlight">'+
            '<div class="p-2 flex-grow-1 bd-highlight">'+
                '<div class="d-flex align-items-center">'+
                    '<div class="flex-shrink-0">'+
                        '<span><i class="fas fa-image fa-fw me-4"></i></span>'+
                    '</div>'+
                    '<div class="flex-grow-1 ms-3">'+
                        '<a data-lessonid="'+lesson.id+'" id="dsp_lessonname_'+lesson.id+'" class="btn_openModalViewLesson btn-link">'+lesson.lessonname+'</a>'+ 
                    '</div>'+
                '</div>'+
            '</div>'+
            '<div class="p-2 bd-highlight">'+
                '<span id="dsp_lessonduration_'+lesson.id+'" class="align-middle">'+lesson.lessonduration+'</span>'+
            '</div>'+
            
        '</div>'+

        '<div class="d-flex justify-content-end bd-highlight mb-3">'+
            '<div><a data-lessonid="'+lesson.id+'" class="btn_openModalEditLesson profile-action-btn">Edit</a></div>'+
            '<div><a data-lessonid="'+lesson.id+'" class="btn_openModalDeleteLesson profile-action-btn">Delete</a></div>'+
        '</div>'+



        '</li>'+
        '<div id="lesson_separator_'+lesson.id+'" class="separator separator-dashed col-md-12 my-5"></div>';

        $('#lesson_group_'+lesson.sectionid).append(el);

        $(document).on('click', '.btn_openModalViewLesson', function() {
            $.fn.openModalViewLesson($(this).data('lessonid'));
        });

        $(document).on('click', '.btn_openModalEditLesson', function() {
            $.fn.openModalEditLesson($(this).data('lessonid'));
        });

        $(document).on('click', '.btn_openModalDeleteLesson', function() {
            $.fn.openModalDeleteLesson($(this).data('lessonid'));
        });

    }

    $.fn.addEnrollmentUserElement = function(datarow) {

        var el = '<tr id="dt_enrolleuser_row_'+datarow.id+'" class="odd">'+
        '<td class="d-flex align-items-center">'+
            '<div class="symbol symbol-circle symbol-25px overflow-hidden me-3">';
        

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
        '<td>'+
        '<button data-userid="'+datarow.id+'" type="button" class="btn_addEnrollment form-action-btn justify-content-end" tabindex="-1">Add Enrollment</button>'+
        '</td>'+
        '</tr>';

        $('#enrollmentadd_body').append(el);
    }

    $.fn.addEnrollmentPreiviewElement = function(datarow) {
        var el = '<tr id="dt_enrollmentpreview_row_'+datarow.id+'" class="odd">'+
        '<td class="d-flex align-items-center">'+
            '<div class="symbol symbol-circle symbol-25px overflow-hidden me-3">';

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
                '<a href="configs/user-management/users/view/3" class="text-gray-800 text-hover-primary mb-1 fs-14">'+datarow.firstname+' '+datarow.lastname+'</a>'+
                '<span class="fs-12">'+datarow.rolename+'</span>'+
            '</div>'+
        '</td>'+
        '<td>'+
        '<button data-enrollmentid="'+datarow.id+'" type="button" class="btn_deleteEnrollment form-action-btn justify-content-end" tabindex="-1">Delete Enrollment</button>'+
        '</td>'+
        '</tr>';

        $('#enrollmentpreview_body').append(el);
    }

    $.fn.addEnrollmentPreiviewGroupElement = function(datarow) {
        var el = '';

        if (datarow.profileimage != null) {   
            el = el + '<div class="symbol symbol-35px symbol-circle mt-2" data-bs-toggle="tooltip" aria-label="'+datarow.firstname+' '+datarow.lastname+'" data-bs-original-title="'+datarow.firstname+' '+datarow.lastname+'">'+
                '<img src="'+datarow.profileimage+'" class="" alt="">'+
            '</div>';
        } else {
            el = el + '<div class="symbol symbol-35px symbol-circle mt-2" data-bs-toggle="tooltip" aria-label="'+datarow.firstname+' '+datarow.lastname+'" data-bs-original-title="'+datarow.firstname+' '+datarow.lastname+'">'+
                '<span class="symbol-label bg-primary text-inverse-primary fw-bold">'+datarow.firstname.charAt(0).toUpperCase()+'</span>'+
            '</div>';
        }

        $('#enrollmentpreview_group').append(el);
    }

    $.fn.removeSectionElement = function(section) {
        $("#accordion_item_"+section.id).remove();
    }

    $.fn.removeLessonElement = function(lesson) {
        $("#lesson_item_"+lesson.id).remove();
        $("#lesson_separator_"+lesson.id).remove();
    }
    
    //end:element functions

    // //jquery event triggers
    $('#btn_openModalEditCourse').click(function() {
        $.fn.openModalEditCourse();
    });

    $('#btn_closeModalEditCourse').click(function() {
        $.fn.closeModalEditCourse();
    });

    $('#btn_openModalEditDescription').click(function() {
        $.fn.openModalEditDescription();
    });

    $('#btn_closeModalEditDescription').click(function() {
        $.fn.closeModalEditDescription();
    });

    $('#btn_openModalAddSection').click(function() {
        $.fn.openModalAddSection();
    });

    $('#btn_closeModalAddSection').click(function() {
        $.fn.closeModalAddSection();
    });

    $('.btn_openModalEditSection').click(function() {
        $.fn.openModalEditSection($(this).data('sectionid'));
    });

    $('#btn_closeModalEditSection').click(function() {
        $.fn.closeModalEditSection();
    });

    $('.btn_openModalDeleteSection').click(function() {
        $.fn.openModalDeleteSection($(this).data('sectionid'));
    });

    $('.btn_closeModalDeleteSection').click(function() {
        $.fn.closeModalDeleteSection();
    });

    $('.btn_openModalAddLesson').click(function() {
        $.fn.openModalAddLesson($(this).data('sectionid'));
    });

    $('#btn_closeModalAddLesson').click(function() {
        $.fn.closeModalAddLesson();
    });

    $('.btn_openModalEditLesson').click(function() {
        $.fn.openModalEditLesson($(this).data('lessonid'));
    });

    $('#btn_closeModalEditLesson').click(function() {
        $.fn.closeModalEditLesson();
    });

    $('.btn_openModalDeleteLesson').click(function() {
        $.fn.openModalDeleteLesson($(this).data('lessonid'));
    });

    $('.btn_closeModalDeleteLesson').click(function() {
        $.fn.closeModalDeleteLesson();
    });

    $('.btn_openModalViewLesson').click(function() {
        $.fn.openModalViewLesson($(this).data('lessonid'));
    });

    $('#btn_closeModalViewLesson').click(function() {
        $.fn.closeModalViewLesson();
    });

    $('#btn_openModalViewEnrollments').click(function() {
        $.fn.openModalViewEnrollments();
    });

    $('#btn_closeModalViewEnrollment').click(function() {
        $.fn.closeModalViewEnrollments();
    });

    $('#btn_openModalAddEnrollment').click(function() {
        $.fn.openModalAddEnrollment();
    });

    $('#btn_closeModalAddEnrollment').click(function() {
        $.fn.closeModalAddEnrollment();
    });

    $('.btn_closeModalEnrollWithPayment').click(function() {
        $.fn.closeModalEnrollWithPayment();
    });

    $('#btn_openModalEditInstructor').click(function() {
        $.fn.openModalEditInstructor();
    });

    $('#btn_closeModalEditInstructor').click(function() {
        $.fn.closeModalEditInstructor();
    });
    



    $('#btn_updateCourse').click(function() {
        $.fn.updateCourse($(this).data('actionid'));
    });

    $('#btn_updateDescription').click(function() {
        $.fn.updateCourseDescription($(this).data('actionid'));
    });

    $('#btn_updateInstructor').click(function() {
        $.fn.updateCourseInstructor($(this).data('actionid'));
    });

    $('#btn_addSection').click(function() {
        $.fn.addSection();
    });

    $('#btn_updateSection').click(function() {
        $.fn.updateSection($(this).data('actionid'));
    });

    $('#btn_deleteSection').click(function() {
        $.fn.deleteSection($(this).data('actionid'));
    });

    $('#btn_addLesson').click(function() {
        $.fn.addLesson($(this).data('actionid'));
    });

    $('#btn_updateLesson').click(function() {
        $.fn.updateLesson($(this).data('actionid'));
    });

    $('#btn_deleteLesson').click(function() {
        $.fn.deleteLesson($(this).data('actionid'));
    });
    
    $('#btn_enrollnow').click(function() {
        $.fn.enrollNow($(this).data('actionid'));  
    });
    

    

    $('#editcoursename').keypress(function() {
        $("#editcoursename_er").html('').addClass('d-none'); 
    });

    $('#editcoursename').on('paste', function(e) {
        $("#editcoursename_er").html('').addClass('d-none'); 
    });

    $('#editcourseintro').keypress(function() {
        $("#editcourseintro_er").html('').addClass('d-none'); 
    });

    $('#editcourseintro').on('paste', function(e) {
        $("#editcourseintro_er").html('').addClass('d-none'); 
    });

    $('#editcourselevel').change(function() {
        $("#editcourselevel_er").html('').addClass('d-none'); 
    });

    $('#editcoursetype').change(function() {
        $("#editcoursetype_er").html('').addClass('d-none'); 
    });

    $('#editcourseimage').change(function() {
        $("#editcourseimage_er").html('').addClass('d-none'); 
    });

    $('#sectionname').keypress(function() {
        $("#sectionname_er").html('').addClass('d-none'); 
    });

    $('#sectionname').on('paste', function(e) {
        $("#sectionname_er").html('').addClass('d-none'); 
    });

    $('#editsectionname').keypress(function() {
        $("#editsectionname_er").html('').addClass('d-none'); 
    });

    $('#editsectionname').on('paste', function(e) {
        $("#editsectionname_er").html('').addClass('d-none'); 
    });

    $('#lessonname').keypress(function() {
        $("#lessonname_er").html('').addClass('d-none'); 
    });

    $('#lessonname').on('paste', function(e) {
        $("#lessonname_er").html('').addClass('d-none'); 
    });

    $('#lessonduration').keypress(function() {
        $("#lessonduration_er").html('').addClass('d-none'); 
    });

    $('#lessonduration').on('paste', function(e) {
        $("#lessonduration_er").html('').addClass('d-none'); 
    });

    $('#editlessonname').keypress(function() {
        $("#editlessonname_er").html('').addClass('d-none'); 
    });

    $('#editlessonname').on('paste', function(e) {
        $("#editlessonname_er").html('').addClass('d-none'); 
    });

    $('#editlessonduration').keypress(function() {
        $("#editlessonduration_er").html('').addClass('d-none'); 
    });

    $('#editlessonduration').on('paste', function(e) {
        $("#editlessonduration_er").html('').addClass('d-none'); 
    });

    $('#enrollmentpreview_DT_search').keyup(function(e) {
        enrollmentpreview_DT.search(e.target.value).draw();
    });

    $('#enrollmentadd_DT_search').keyup(function(e) {
        enrollmentadd_DT.search(e.target.value).draw();
    });
    

    
    

    //begin:init functions
    editdescription_RTE = new RichTextEditor("#editdescription_RTE",
    {
        toolbar: "basic",
        showFloatParagraph: false,
    }); 
    editdescription_RTE.attachEvent("change", function () {    
        $("#editdescription_er").html('').addClass('d-none'); 
    }); 

    lessondescription_RTE = new RichTextEditor("#lessondescription_RTE",
    {
        toolbar: "basic",
        showFloatParagraph: false,
    });
    lessondescription_RTE.attachEvent("change", function () {    
        $("#lessondescription_er").html('').addClass('d-none'); 
    }); 

    editlessondescription_RTE = new RichTextEditor("#editlessondescription_RTE",
    {
        toolbar: "basic",
        showFloatParagraph: false,
    });
    editlessondescription_RTE.attachEvent("change", function () {    
        $("#editlessondescription_er").html('').addClass('d-none'); 
    }); 

    dz_editcourseimage = new Dropzone("#dz_editcourseimage", { 
        url: baseurl+"libraries/courses/upload/courseimage", // Set the url for your upload script location
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

                $("#editcourseimage").val(filedata);
            } else {
                $("#editcourseimage").val('');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                $("#editcourseimage").val('');
                $("#editcourseimage_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#editcourseimage").val('');
                $("#editcourseimage_er").html('').addClass('d-none'); 
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#editcourseimage").val('');
            //     $("#editcourseimage_er").html('').addClass('d-none'); 
            // });

        }
    }); 

    dz_lessonmedia = new Dropzone("#dz_lessonmedia", { 
        url: baseurl+"libraries/courses/upload/lessonmedia", // Set the url for your upload script location
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

                $("#lessonmedia").val(filedata);
            } else {
                $("#lessonmedia").val('');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                $("#lessonmedia").val('');
                $("#lessonmedia_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#lessonmedia").val('');
                $("#lessonmedia_er").html('').addClass('d-none'); 
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#lessonmedia").val('');
            //     $("#lessonmedia_er").html('').addClass('d-none');
            // });

        }
    }); 

    dz_editlessonmedia = new Dropzone("#dz_editlessonmedia", { 
        url: baseurl+"libraries/courses/upload/lessonmedia", // Set the url for your upload script location
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

                               console.log(filedata);

                $("#editlessonmedia").val(filedata);
            } else {
                $("#editlessonmedia").val('');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                $("#editlessonmedia").val('');
                $("#editlessonmedia_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#editlessonmedia").val('');
                $("#editlessonmedia_er").html('').addClass('d-none'); 
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#editlessonmedia").val('');
            //     $("#editlessonmedia_er").html('').addClass('d-none');
            // });

        }
    }); 
    //end:init functions
    

});