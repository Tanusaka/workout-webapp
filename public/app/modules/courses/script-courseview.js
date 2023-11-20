"use strict";

$(document).ready(function() {

    var editdescription_RTE; 
    var lessondescription_RTE; 
    var editlessondescription_RTE;
    var dz_editcourseimage; 
    var dz_lessonmedia;
    var dz_editlessonmedia;

    var enrollments_DT;
    var enrollmentadd_DT;

    // //jquery function definitions
    $.fn.openModalEditSettings = function() { 
        $.fn.refreshSettingsGeneralTab();
        $('#editSettingsModal').modal('show');
    }

    $.fn.closeModalEditSettings = function() { 
        $('#editSettingsModal').modal('hide');
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

    $.fn.openModalViewLesson = function(lessonid) { 

        axios.post(baseurl+'libraries/courses/get/lesson', {
            lessonid: lessonid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#dsp_view_lessonname').text(response.data.data.lessonname);
            $('#dsp_view_lessonduration').html('Duration: '+ response.data.data.lessonduration);
            $('#dsp_view_lessondescription').html(response.data.data.lessondescription);
            $.fn.addMediaPreviewElement(response.data.data);

            $('#btn_prevLesson').attr("data-actionid", response.data.data.id);
            $('#btn_nextLesson').attr("data-actionid", response.data.data.id);

            $('#viewLessonModal').modal('show');
            } else if (response.data.status==402) {
                $.fn.openModalViewPayment(response.data.data);
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

    $.fn.openModalEnrollNow = function() {
        $.fn.resetFormEnrollNowCoupon();
        $('#enrollNowModal').modal('show');
    }

    $.fn.closeModalEnrollNow = function() { 
        $('#enrollNowModal').modal('hide');
    }

    $.fn.openModalViewPayment = function(data) { 

        var paymentPlan;
        if (data.coursepriceplan=="OneTime") {
            paymentPlan = 'One Time';
        } else if (data.coursepriceplan=="Monthly") {
            paymentPlan = 'Monthly';
        } else if (data.coursepriceplan=="Yearly") {
            paymentPlan = 'Yearly';
        } else {
            paymentPlan = '';
        }

        $('#pi_coursename').html(data.coursename);
        $('#item_note').html('This is a paid course. In order to view the content of this course you have to pay the following amount.');
        $('#item_payment_type').html(paymentPlan);
        $('#item_next_payment_date').html('N/A');
        $('#item_name').html(data.coursename);
        $('#item_price').html(data.courseprice+' '+data.coursecurrency);
        $('#item_total_price').html('<strong>'+data.courseprice+' '+data.coursecurrency+'</strong>');

        var courseid = data.courseid; var orderamount = data.courseprice; var ordercurrency = data.coursecurrency;

        $('#paypal-button-container').empty();
        
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            style: {
                layout: 'horizontal',
                color:  'gold',
                shape:  'rect',
                label:  'pay',
                tagline: true,
                height: 35,
            },

            // Call your server to set up the transaction
            createOrder: function(data, actions) {
                
                $('#btn_closeModalViewPayment').addClass('d-none');

                return fetch(baseurl+'libraries/courses/payment/create/order', {
                    method: 'post',
                    body: JSON.stringify({amount: orderamount, currency: ordercurrency})
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    return orderData.id;
                });
            },

            // Call your server to finalize the transaction
            onApprove: function(data, actions) {
                return fetch(baseurl+'libraries/courses/payment/capture/order', {
                    method: 'post',
                    body: JSON.stringify({id: data.orderID, courseid: courseid})
                }).then(function(res) {
                    return res.json();
                }).then(function(orderData) {
                    // Three cases to handle:
                    //   (1) Recoverable INSTRUMENT_DECLINED -> call actions.restart()
                    //   (2) Other non-recoverable errors -> Show a failure message
                    //   (3) Successful transaction -> Show confirmation or thank you

                    // This example reads a v2/checkout/orders capture response, propagated from the server
                    // You could use a different API or structure for your 'orderData'
                    var errorDetail = Array.isArray(orderData.details) && orderData.details[0];

                    if (errorDetail && errorDetail.issue === 'INSTRUMENT_DECLINED') {
                        return actions.restart(); // Recoverable state, per:
                        // https://developer.paypal.com/docs/checkout/integration-features/funding-failure/
                    }

                    if (errorDetail) {
                        var msg = 'Sorry, your transaction could not be processed.';
                        if (errorDetail.description) msg += '\n\n' + errorDetail.description;
                        if (orderData.debug_id) msg += ' (' + orderData.debug_id + ')';
                        return alert(msg); // Show a failure message (try to avoid alerts in production environments)
                    }

                    // Successful capture! For demo purposes:
                    // console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));
                    // var transaction = orderData.purchase_units[0].payments.captures[0];
                    // alert('Transaction '+ transaction.status + ': ' + transaction.id + '\n\nSee console for all available details');

                    // Replace the above to show a success message within this page, e.g.
                    const element = document.getElementById('paypal-button-container');
                    element.innerHTML = '';
                    element.innerHTML = '<div class="d-flex bd-highlight">'+
                    '<div class="flex-grow-1">'+
                        '<div class="modal-alert">'+
                            '<div class="alert alert-success text-center fade show" role="alert">'+
                                '<div>Your payment was successful..!</div>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                   ' <div class="p-2 p-t-6">'+
                        '<a href="'+baseurl+'libraries/courses/view/'+courseid+'" class="btn btn-sm fw-bold btn-primary">Start Course</a>'+
                    '</div>'+
                    '</div>';
                    // Or go to another URL:  actions.redirect('thank_you.html');
                });
            }, 
            onCancel(data) {
                $('#btn_closeModalViewPayment').removeClass('d-none');
            },
            onError(err) {
                // For example, redirect to a specific error page
                location.reload(true);
              }
        }).render('#paypal-button-container');

        $('#btn_closeModalViewPayment').removeClass('d-none');
        $('#viewPaymentModal').modal('show');
            
    }

    $.fn.closeModalViewPayment = function() { 
        location.reload(true);
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

    $.fn.generateEnrollmentCouponCode = function() { 
        axios.post(baseurl+'libraries/courses/generate/enrollment/coupon/code', {

        }).then(function (response) {

            if (response.data.status==200) {
            $("#enrollcouponcode_er").html('').addClass('d-none'); 
            $('#enrollcouponcode').val(response.data.data);
            } else {
            $("#enrollcouponcode_er").html('Unable to generate the coupon code. Please try again.').removeClass('d-none');
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.updateEnrollmentCouponCode = function() { 
        axios.post(baseurl+'libraries/courses/update/enrollment/coupon/code', {
            courseid: $('#pagedata-container').data('pid'),
            couponcode: $('#enrollcouponcode').val(),
            maxattempts: $('#enrollmaxattempts').val(),
            couponstatus: $('#enrollcouponstatus').val(),
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE_ENROLLMENT', 'UPDATE_COUPON', response.data);
            } else {
            $.fn.showErrorResponse('COURSE_ENROLLMENT', 'UPDATE_COUPON', response.data);
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

    $.fn.updateCourseStatus = function(state) { 

        axios.post(baseurl+'libraries/courses/update/course/status', {
            courseid: $('#pagedata-container').data('pid'),
            status: state
        }).then(function (response) {

            if (response.data.status==200) {
                $('#chnagestatus').prop('checked', state);
                $.fn.showSuccessMessage(response.data.message, false);
            } else if (response.data.status==400) { 
                $('#chnagestatus').prop('checked', !state);
                $.fn.showWarningMessage(response.data.message, false);
            } else {
                $('#chnagestatus').prop('checked', !state);
                $.fn.showErrorMessage(response.data.message, false);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteCourse = function() { 

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
                axios.post(baseurl+'libraries/courses/delete/course', {
                    courseid: $('#pagedata-container').data('pid'),
                }).then(function (response) {
        
                    if (response.data.status==200) {
                        $.fn.showSuccessMessage(response.data.message, false, baseurl+'libraries/courses');
                    } else if (response.data.status==400) { 
                        $.fn.showWarningMessage(response.data.message, false);
                    } else {
                        $.fn.showErrorMessage(response.data.message, false);
                    }
        
                }).catch(function (error) {
                    $.fn.showException(error);
                });
            }
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
        });
    }
    //end:section functions

    //begin:lesson functions
    $.fn.addLesson = function(sectionid) { 
        axios.post(baseurl+'libraries/courses/save/lesson', {
            courseid: $('#pagedata-container').data('pid'),
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
        });
    }

    $.fn.viewPreviousLesson = function(lessonid) { 
        axios.post(baseurl+'libraries/courses/get/lesson/previous', {
            courseid: $('#pagedata-container').data('pid'),
            currentid: lessonid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#dsp_view_lessonname').text(response.data.data.lessonname);
            $('#dsp_view_lessonduration').html('Duration: '+ response.data.data.lessonduration);
            $('#dsp_view_lessondescription').html(response.data.data.lessondescription);
            $.fn.addMediaPreviewElement(response.data.data);

            $('#btn_prevLesson').attr("data-actionid", response.data.data.id);
            $('#btn_nextLesson').attr("data-actionid", response.data.data.id);
            } else {
            $.fn.showErrorMessage(response.data.messages, false);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.viewNextLesson = function(lessonid) { 
        axios.post(baseurl+'libraries/courses/get/lesson/next', {
            courseid: $('#pagedata-container').data('pid'),
            currentid: lessonid
        }).then(function (response) {

            if (response.data.status==200) {
            $('#dsp_view_lessonname').text(response.data.data.lessonname);
            $('#dsp_view_lessonduration').html('Duration: '+ response.data.data.lessonduration);
            $('#dsp_view_lessondescription').html(response.data.data.lessondescription);
            $.fn.addMediaPreviewElement(response.data.data);

            $('#btn_prevLesson').attr("data-actionid", response.data.data.id);
            $('#btn_nextLesson').attr("data-actionid", response.data.data.id);
            } else {
            $.fn.showErrorMessage(response.data.messages, false);
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
            } else {
            $.fn.showErrorResponse('COURSE_ENROLLMENT', 'ADD', response.data);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.deleteEnrollment = function(enrolledid) {
        axios.post(baseurl+'libraries/courses/delete/enrollment', {
            enrollmentid: enrolledid,
        }).then(function (response) {
            if (response.data.status==200) {
            $.fn.showSuccessResponse('COURSE_ENROLLMENT', 'DELETE', response.data);
            } else {
            $.fn.showErrorResponse('COURSE_ENROLLMENT', 'DELETE', response.data);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.enrollNow = function() {
        axios.post(baseurl+'libraries/courses/accept/enrollment', {
            courseid: $('#pagedata-container').data('pid'),
            couponcode: $('#enrollnowcouponcode').val(),
        }).then(function (response) {
            if (response.data.status==200) {
                location.reload(true);
            } else if (response.data.status==402) {
                $('#course_enrollments').empty();
                $.fn.closeModalEnrollNow();
                $.fn.openModalViewPayment(response.data.data);
            } else {
                $.fn.showErrorResponse('COURSE_ENROLLMENT', 'ACCEPT_COUPON', response.data);
            }
        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    // end:enrollment functions

    //begin:tab functions
    $.fn.refreshSettingsGeneralTab = function() { 

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
            $.fn.showTabContent('settingsGeneral');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });

    }

    $.fn.refreshSettingsEnrollmentsTab = function() { 

        axios.post(baseurl+'libraries/courses/get/enrollments', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetFormEditEnrollmentCoupon(response.data.data.coupon);
            $.fn.resetDataTableEnrollments(response.data.data.enrollments);
            $.fn.showTabContent('settingsEnrollments');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.refreshSettingsPaymentsTab = function() { 

        $.fn.showTabContent('settingsPayments');

    }


    $.fn.showTabContent = function(id) {
        $('.tab-link').each(function(i, obj) {
        if ( $(this).is(".active") ) {
        $(this).removeClass("active");
        }
        });

        $('.tab-pane').each(function(i, obj) {
        if ( $(this).is(".active.show") ) {
        $(this).removeClass("active show");
        }
        });

        $('#tab_content').animate({ scrollTop: 0 }, 'fast');

        $("#tabbtn_"+id).addClass("active");
        $("#tabcontent_"+id).addClass("active show");
    }
    //end:tab functions


    //begin:set response functions
    $.fn.showSuccessResponse = function(component, event, response) {
        
        if (component=='COURSE') {
            if (event=='EDIT') {
                $('#dsp_coursename').html(response.data.course.coursename);
                $('#dsp_courseintro').html(response.data.course.courseintro);
                $('#dsp_couseimage').attr("src", response.data.course.courseimage);
                $.fn.resetFormEditCourse();
                $.fn.showModalAlert('editsettings', 'success', response.message);
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
                        $('#dsp_instructorthumb').attr("src", "assets/images/avatar.png");
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
                $.fn.showPageAlert('success', response.message);
            }
        } else if (component=='COURSE_ENROLLMENT') {
            if (event=='ADD') {
                $.fn.resetDataTableEnrollments(response.data);
            } else if (event=='DELETE') {
                $.fn.resetDataTableEnrollments(response.data);
            } else if (event=='UPDATE_COUPON') {
                $.fn.showModalAlert('editsettings', 'success', response.message);
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
                $.fn.showPageAlert('danger', response.message);
            }
        } else if (component=='COURSE_ENROLLMENT') {
            if (event=='ADD') {
                $.fn.showModalAlert('editsettings', 'danger', response.message);
            } else if (event=='DELETE') {
                $.fn.showModalAlert('editsettings', 'danger', response.message);
            } else if (event=='UPDATE_COUPON') {
                $.fn.resetFormErrorsEditEnrollmentCoupon();
                if (typeof(response.message['couponcode']) != "undefined" && 
                response.message['couponcode'] !== null) {
                    $("#enrollcouponcode_er").html(response.message['couponcode']).removeClass('d-none');
                }
                if (typeof(response.message['maxattempts']) != "undefined" && 
                response.message['maxattempts'] !== null) {
                    $("#enrollmaxattempts_er").html(response.message['maxattempts']).removeClass('d-none');
                }
                if (typeof(response.message['couponstatus']) != "undefined" && 
                response.message['couponstatus'] !== null) {
                    $("#enrollcouponstatus_er").html(response.message['couponstatus']).removeClass('d-none');
                }
            } else if (event=='ACCEPT_COUPON') {
                $.fn.resetFormErrorsEnrollNowCoupon();
                if (typeof(response.message['couponcode']) != "undefined" && 
                response.message['couponcode'] !== null) {
                    $("#enrollnowcouponcode_er").html(response.message['couponcode']).removeClass('d-none');
                }
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

    $.fn.resetFormEditEnrollmentCoupon = function(data) {
        
        if (typeof(data) != "undefined" && data !== null) {
            $('#enrollcouponcode').val(data.couponcode);
            $('#enrollmaxattempts').val(data.maxattempts);
            $("#enrollcouponstatus").val(data.status).trigger("change"); 
        } else {
            $('#enrollcouponcode').val('');
            $('#enrollmaxattempts').val('');
            $("#enrollcouponstatus").val('').trigger("change"); 
        }

        $.fn.resetFormErrorsEditEnrollmentCoupon();
    }

    $.fn.resetFormEnrollNowCoupon = function() {
        $('#enrollnowcouponcode').val('');
        $.fn.resetFormErrorsEnrollNowCoupon();
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

    $.fn.resetFormErrorsEditEnrollmentCoupon = function() {
        $("#enrollcouponcode_er").html('').addClass('d-none'); 
        $("#enrollmaxattempts_er").html('').addClass('d-none');  
        $("#enrollcouponstatus_er").html('').addClass('d-none');  
    }

    $.fn.resetFormErrorsEnrollNowCoupon = function() {
        $("#enrollnowcouponcode_er").html('').addClass('d-none');
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
    $.fn.resetDataTableEnrollments = function(dataset) {

        $('#enrollments_DT').DataTable().clear().destroy();
        $('#enrollments_body').empty();

        $.each(dataset, function(index, datarow) {
            $.fn.addEnrollmentElement(datarow);
        });

        $('#enrollments_DT_search').val('');

        enrollments_DT = $('#enrollments_DT').DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "lengthChange": false,
            'columnDefs': [],
            "destroy": true,
        });
        // enrollments_DT.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        // });

        //attach click event to buttons
        $(".btn_addEnrollment").on("click", function() {
            $.fn.addEnrollment($(this).data('userid'));
        });

        $(".btn_deleteEnrollment").on("click", function() {
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
            
            '<div class="card-header border-0">'+
                '<h3 class="card-title align-items-start flex-column"></h3>'+
                '<div class="card-toolbar">'+
                    '<button data-sectionid="'+section.id+'" type="button" class="btn_openModalAddLesson form-action-btn justify-content-end" tabindex="-1">Add Lesson</button>'+
                    '<button data-sectionid="'+section.id+'" type="button" class="btn_openModalEditSection form-action-btn justify-content-end" tabindex="-1">Edit Section</button>'+
                    '<button data-sectionid="'+section.id+'" type="button" class="btn_deleteSection form-action-btn justify-content-end" tabindex="-1">Delete Section</button>'+
                '</div>'+
            '</div>'+
    
            
            '<div class="accordion-body">'+
                '<ul id="lesson_group_'+section.id+'" class="list-group" data-sectionid="'+section.id+'">'+
                    
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

        $(document).on('click', '.btn_deleteSection', function() {
            $.fn.deleteSection($(this).data('sectionid'));
        });

    }

    $.fn.addLessonElement = function(lesson) {

        var el = '<li id="lesson_item_'+lesson.id+'" class="list-group-item" data-lessonid="'+lesson.id+'">'+
        
        '<div class="d-flex bd-highlight">'+
            '<div class="p-2 flex-grow-1 bd-highlight">'+
                '<div class="d-flex align-items-center">'+
                    '<div class="flex-shrink-0">';

        if (lesson.type=='image') {
            el = el + '<span><i class="fas fa-image fa-fw me-4"></i></span>';
        } else if (lesson.type=='video') {
            el = el + '<span><i class="fas fa-video fa-fw me-4"></i></span>';
        } else {
            el = el + '<span></span>';
        }  

        el = el + '</div>'+
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
            '<div><a data-lessonid="'+lesson.id+'" class="btn_deleteLesson profile-action-btn">Delete</a></div>'+
        '</div>'+

        '</li>';
        

        $('#lesson_group_'+lesson.sectionid).append(el);

        $(document).on('click', '.btn_openModalViewLesson', function() {
            $.fn.openModalViewLesson($(this).data('lessonid'));
        });

        $(document).on('click', '.btn_openModalEditLesson', function() {
            $.fn.openModalEditLesson($(this).data('lessonid'));
        });

        $(document).on('click', '.btn_deleteLesson', function() {
            $.fn.deleteLesson($(this).data('lessonid'));
        });

    }

    $.fn.addEnrollmentElement = function(datarow) {

        var el = '<tr id="dt_enrollment_row_'+datarow.id+'" class="odd">'+
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
        '<td class="text-end">';

        if (datarow.enrolled=="1") {
            el = el + '<span>Enrolled On: '+datarow.enrolleddate+'</span> <button data-enrollmentid="'+datarow.enrolledid+'" type="button" class="btn_deleteEnrollment btn-close" aria-label="Close"></button>';
        } else {
            el = el + '<button data-userid="'+datarow.id+'" type="button" class="btn_addEnrollment form-action-btn justify-content-end" tabindex="-1">Add Enrollment</button>';
        }
        
        el = el + '</td>'+
        '</tr>';

        $('#enrollments_body').append(el);
    }

    $.fn.addMediaPreviewElement = function(data) {

        var el = '';

        $('#dsp_mediafile').empty();

        if (data.type=='image') {
            el = '<img id="dsp_view_lessonmedia" src="'+data.lessonmedia+'" alt="image">';
        } else if (data.type=='video') {
            el = '<div class="ratio ratio-16x9">'+
                '<iframe src="'+data.lessonmedia+'" title="'+data.type+'" allowfullscreen sandbox></iframe>'+
            '</div>';
        } else {
            el = el + '<div id="dsp_nocontent" class="fs-6">This lesson content type is not supported with this applicaiotn</div>';
        }

        $('#dsp_mediafile').append(el);
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
    $('#btn_openModalEditSettings').click(function() {
        $.fn.openModalEditSettings();
    });

    $('#btn_closeModalEditSettings').click(function() {
        $.fn.closeModalEditSettings();
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

    $('.btn_openModalViewLesson').click(function() {
        $.fn.openModalViewLesson($(this).data('lessonid'));
    });

    $('#btn_closeModalViewLesson').click(function() {
        $.fn.closeModalViewLesson();
    });

    $('#btn_closeModalViewPayment').click(function() {
        $.fn.closeModalViewPayment();
    });

    $('#btn_openModalEditInstructor').click(function() {
        $.fn.openModalEditInstructor();
    });

    $('#btn_closeModalEditInstructor').click(function() {
        $.fn.closeModalEditInstructor();
    });

    $('#btn_openModalEnrollNow').click(function() {
        $.fn.openModalEnrollNow();
    });

    $('#btn_closeModalEnrollNow').click(function() {
        $.fn.closeModalEnrollNow();
    });
    
    $('#tabbtn_settingsGeneral').click(function() {
        $.fn.refreshSettingsGeneralTab();
    });

    $('#tabbtn_settingsEnrollments').click(function() {
        $.fn.refreshSettingsEnrollmentsTab();
    });

    $('#tabbtn_settingsPayments').click(function() {
        $.fn.refreshSettingsPaymentsTab();
    });



    $('#btn_updateCourse').click(function() {
        $.fn.updateCourse($(this).data('actionid'));
    });

    $('#btn_generateEnrollmentCouponCode').click(function() {
        $.fn.generateEnrollmentCouponCode();
    });

    $('#btn_updateEnrollmentCouponCode').click(function() {
        $.fn.updateEnrollmentCouponCode();
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

    $('.btn_deleteSection').click(function() {
        $.fn.deleteSection($(this).data('sectionid'));
    });

    $('#btn_addLesson').click(function() {
        $.fn.addLesson($(this).data('actionid'));
    });

    $('#btn_updateLesson').click(function() {
        $.fn.updateLesson($(this).data('actionid'));
    });

    $('.btn_deleteLesson').click(function() {
        $.fn.deleteLesson($(this).data('lessonid'));
    });
    
    $('#btn_enrollnow').click(function() {
        $.fn.enrollNow();  
    });
    
    $('#btn_prevLesson').click(function() {
        //$.fn.viewPreviousLesson($(this).attr("data-actionid"));  
    });

    $('#btn_nextLesson').click(function() {
        //$.fn.viewNextLesson($(this).attr("data-actionid"));  
    });

    $('#btn_deleteCourse').click(function() {
        $.fn.deleteCourse();
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

    $('#enrollcouponcode').keypress(function() {
        $("#enrollcouponcode_er").html('').addClass('d-none'); 
    });

    $('#enrollcouponcode').on('paste', function(e) {
        $("#enrollcouponcode_er").html('').addClass('d-none'); 
    });

    $('#enrollmaxattempts').keypress(function() {
        $("#enrollmaxattempts_er").html('').addClass('d-none'); 
    });

    $('#enrollmaxattempts').on('paste', function(e) {
        $("#enrollmaxattempts_er").html('').addClass('d-none'); 
    });

    $('#enrollmaxattempts').change(function() {
        $("#enrollmaxattempts_er").html('').addClass('d-none'); 
    });

    $('#enrollcouponstatus').change(function() {
        $("#enrollcouponstatus_er").html('').addClass('d-none'); 
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

    $('#enrollnowcouponcode').keypress(function() {
        $("#enrollnowcouponcode_er").html('').addClass('d-none'); 
    });

    $('#enrollnowcouponcode').on('paste', function(e) {
        $("#enrollnowcouponcode_er").html('').addClass('d-none'); 
    });

    $('#chnagestatus').change(function() {
        $.fn.updateCourseStatus($(this).is(':checked'));
    });

    $('#enrollments_DT_search').keyup(function(e) {
        enrollments_DT.search(e.target.value).draw();
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
        acceptedFiles: "image/*",
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
        acceptedFiles: "image/*,audio/*,video/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
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
        acceptedFiles: "image/*,audio/*,video/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
        addRemoveLinks: true,
        init: function() {
            
            this.on("success", function (file, response) {
            if (response.data.status == 200) {

                var filedata = response.data.filename+'|'+
                               response.data.filetype+'|'+
                               response.data.fileextn+'|'+
                               response.data.filesize;

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