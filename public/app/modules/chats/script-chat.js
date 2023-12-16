"use strict";

$(document).ready(function () {

    var chatadd_DT; var tooltipTriggerList; var dz_chatattchments;

    //begin:function defenitions

    $.fn.initToolTips = function() {
        tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        });
    }

    $.fn.connectToChatServer = function() {
        var conn = new WebSocket('ws://localhost:8892');
        conn.onopen = function(e) {
            console.log("Connection established..!");
        }

        conn.onmessage = function(e) {
            console.log(e.data);
        }
    }

    $.fn.refreshChats = function() {
        axios.post(baseurl+'apps/chats/get/all', {
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.resetChatList(response.data.data);
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.openChat = function(id) {
        axios.post(baseurl+'apps/chats/get/chat', {
            chatid: id
        }).then(function (response) {

            if (response.data.status==200) {
            $.fn.openChatView(response.data.data);
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.openModalAddChat = function() { 

        axios.post(baseurl+'apps/chats/get/chat/personal/connections', {
            courseid: $('#pagedata-container').data('pid')
        }).then(function (response) {

            if (response.data.status==200) {

            $.fn.resetDataTableAddChat(response.data.data);
            $('#addChatModal').modal('show');
            
            } else {
            $.fn.showErrorMessage(response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }

    $.fn.closeModalAddChat = function() { 
        $('#addChatModal').modal('hide');
    }

    $.fn.openModalChatSettings = function(id) { 
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
                $.fn.deleteChat(id);
            }
        });
    }

    $.fn.deleteChat = function(id) {
        // axios.post(baseurl+'configs/users/delete/connection', {
        //     id: id
        // }).then(function (response) {

        //     if (response.data.status==200) {
        //     $.fn.resetDataTableConnectionPreview(response.data.data.connections);
        //     $.fn.showPageAlert('success', response.data.message);
        //     } else {
        //     $.fn.showErrorMessage(response.data.message);
        //     }

        // }).catch(function (error) {
        //     $.fn.showException(error);
        // });
    }

    $.fn.sendMessage = function(id) {

        var textMessage = $('#chat_messenger_text').val();
        var attachments = $('#chat_messenger_attchments').val();

        console.log(attachments);

        if (textMessage!=="" || attachments!=="") {
            axios.post(baseurl+'apps/chats/save/chat/personal/message', {
                chatid: id, 
                type: "text",
                message: textMessage,
                attachments: attachments
            }).then(function (response) {

                if (response.data.status==200) {
                $.fn.openChat(id);
                $('#chat_messenger_text').val('');
                $('#chat_messenger_attchments').val('');
                } else {
                $('#chat_messenger_text').val('');
                $('#chat_messenger_attchments').val('');
                }

            }).catch(function (error) {
                $.fn.showException(error);
            });
        }
        
    }
    //end:function defenitions

    //begin:reset functions
    $.fn.resetChatList = function(dataset) {

        $('#chat_list_conatiner').empty();

        if (dataset.length>0) {

            $.each(dataset, function(index, datarow) {
                $.fn.addChatListElement(datarow);
            });

            //use off to prevent calling the function multiples times on each initialization
            $(document).on('click', '.btn_openchat', function() {

                $('#chat_list_conatiner div.chat-active').removeClass('chat-active');
                $(this).addClass('chat-active');

                $.fn.openChat($(this).data('actionid'));
            });

            //get first elment of chatlist opened
            var firstchat = $('.btn_openchat').first();
            $.fn.openChat(firstchat.attr('data-actionid'));
            firstchat.addClass('chat-active');

            $('#chatlist_container').removeClass('d-none');
            $('#chatpreview_container').removeClass('d-none');
            

        } else {
            $('#chatlist_container').addClass('d-none');
            $('#chatpreview_container').addClass('d-none');
        }
    }

    $.fn.openChatView = function(chat) {

        $('#chat_messanger_name').html(chat.name);

        $('#chat_messanger_status').empty();
        $('#chat_status_'+chat.id).removeClass('bg-success bg-secondary');

        if (chat.active=="1") {
            $('#chat_status_'+chat.id).addClass('bg-success');
            $('#chat_messanger_status').append('<span class="badge badge-success badge-circle w-10px h-10px me-1"></span><span class="fs-7 fw-semibold text-muted">Online</span>');
        } else { 
            $('#chat_status_'+chat.id).addClass('bg-secondary');
            $('#chat_messanger_status').append('<span class="badge badge-secondary badge-circle w-10px h-10px me-1"></span><span class="fs-7 fw-semibold text-muted">Offline</span>');
        }
        
        $('#btn_openModalChatSettings').data("actionid", chat.id);
        $('#btn_sendMessage').data("actionid", chat.id);

        $('#chat_messenger_thread').empty();

        var threadHeight = parseInt($('#chat_messenger_thread').height());
        console.log(threadHeight);

        $.each(chat.messages, function(index, message) {
            $.fn.addChatMessageElement(message);
            threadHeight = threadHeight + parseInt($('#chat_messenger_thread').height());
        });


        $('#chat_messenger_thread').animate({scrollTop: threadHeight});

        // //use off to prevent calling the function multiples times on each initialization
        // $(document).on('click', '.btn_openchat', function() {
        //     $.fn.openChat($(this).data('actionid'));
        // });

    }

    $.fn.createChat = function(userid) {
        axios.post(baseurl+'apps/chats/save/chat/personal', {
            userid: userid
        }).then(function (response) {

            if (response.data.status==200) {
            
                // $.fn.addSectionElement(response.data.section);
                $.fn.closeModalAddChat();
                location.reload(true);

            } else {
                $.fn.showModalAlert('addchat', 'danger', response.data.message);
            }

        }).catch(function (error) {
            $.fn.showException(error);
        });
    }
    //end:reset functions

    //begin:reset datatable functions
    $.fn.resetDataTableAddChat = function(dataset) {

        $('#chatadd_DT').DataTable().clear().destroy();
        $('#chatadd_body').empty();

        $.each(dataset, function(index, datarow) {
            $.fn.addChatAddElement(datarow);
        });

        $('#chatadd_DT_search').val('');

        chatadd_DT = $('#chatadd_DT').DataTable({
            "info": false,
            'order': [],
            "pageLength": 10,
            "bPaginate": false,
            "lengthChange": false,
            'columnDefs': [],
            "destroy": true,
        });
        // chatadd_DT.on('draw', function () {
            // initToggleToolbar();
            // handleDeleteRows();
            // toggleToolbars();
        // });

        //use off to prevent calling the function multiples times on each initialization
        $(document).on('click', '.btn_chatnow', function() {
            $.fn.createChat($(this).data('chatconnectionid'));
        });

    }
    //end:reset datatable functions

    //begin:element functions
    $.fn.addChatListElement = function(datarow) {

        var el = '<div id="chat_'+datarow.id+'" data-actionid="'+datarow.id+'" class="btn_openchat d-flex flex-stack py-4 chat_list_item">'+
            '<div class="d-flex align-items-center">';

            if (datarow.chatimage != null) {   
                el = el + '<div class="symbol symbol-45px symbol-circle">'+
                    '<img src="'+datarow.chatimage+'" class="" alt="">';
                    if (datarow.active=="1") {
                        el = el + '<div id="chat_status_'+datarow.id+'" class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>';
                    } else {
                        el = el + '<div id="chat_status_'+datarow.id+'" class="symbol-badge bg-secondary start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>';
                    }
                el = el + '</div>';
            } else {
                el = el + '<div class="symbol symbol-45px symbol-circle">'+
                    '<span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">'+
                    datarow.name.charAt(0).toUpperCase()+
                    '</span>';
                    if (datarow.active=="1") {
                        el = el + '<div id="chat_status_'+datarow.id+'" class="symbol-badge bg-success start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>';
                    } else {
                        el = el + '<div id="chat_status_'+datarow.id+'" class="symbol-badge bg-secondary start-100 top-100 border-4 h-8px w-8px ms-n2 mt-n2"></div>';
                    }
                el = el + '</div>';
            }

            el = el + '<div class="ms-5">'+
                    '<a class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">'+datarow.name+'</a>'+
                    '<div class="fw-semibold text-muted">'+datarow.about+'</div>'+
                '</div>'+
            '</div>'+
            '<div class="d-flex flex-column align-items-end ms-2">'+
                '<span class="text-muted fs-7 mb-1"></span>'+
            '</div>'+
        '</div>';

        // el = el + '<div class="separator separator-dashed"></div>';

        $('#chat_list_conatiner').append(el);
    }

    $.fn.addChatMessageElement = function(message) {
        if(message.sentbyme==1) {
            $.fn.addChatMessageOutElement(message);
        } else {
            $.fn.addChatMessageInElement(message);
        }
    }

    $.fn.addChatMessageInElement = function(message) {

        var el = '<div class="d-flex justify-content-start mb-10">'+
            '<div class="d-flex flex-column align-items-start">'+
                '<div class="d-flex align-items-center mb-2">';
                    
        if (message.senderimage != null) {   
            el = el + '<div class="symbol symbol-35px symbol-circle">'+
                '<img src="'+message.senderimage+'" class="" alt="">'+
            '</div>';
        } else {
            el = el + '<div class="symbol symbol-35px symbol-circle">'+
                '<span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">'+
                message.sendername.charAt(0).toUpperCase()+
                '</span>'+
            '</div>';
        }
                
        el = el + '<div class="ms-3">'+
                        '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary me-1">'+message.sendername+'</a>'+
                    '</div>'+
                '</div>';

        
        el = el + '<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start mb-2">'+message.content+'</div>';
            
        el = el + '</div></div>';

        $('#chat_messenger_thread').append(el);

        $(document).on('click', '.chat-attachment-preview-item', function() {
            $.fn.previewAttachment($(this));
        });
    }

    $.fn.addChatMessageOutElement = function(message) {

        var el = '<div class="d-flex justify-content-end mb-10">'+
            '<div class="d-flex flex-column align-items-end">'+
                '<div class="d-flex align-items-center mb-2">'+
                    '<div class="me-3">'+
                        '<a href="#" class="fs-5 fw-bold text-gray-900 text-hover-primary ms-1">You</a>'+
                    '</div>';

        if (message.senderimage != null) {   
            el = el + '<div class="symbol symbol-35px symbol-circle">'+
                '<img src="'+message.senderimage+'" class="" alt="">'+
            '</div>';
        } else {
            el = el + '<div class="symbol symbol-35px symbol-circle">'+
                '<span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">'+
                message.sendername.charAt(0).toUpperCase()+
                '</span>'+
            '</div>';
        }
       
        el = el + '</div>';
        
        el = el + '<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end mb-2">'+message.content+'</div>';
                
        el = el + '</div></div>';

        $('#chat_messenger_thread').append(el);

        

        $(document).on('click', '.chat-attachment-preview-item', function() {
            $.fn.previewAttachment($(this));
        });
    }

    $.fn.previewAttachment = function(attachment) {

        var el = '';

        $('#chatAttachmentPreviewBody').empty();

        if (attachment.data('attachmenttype')=='image') {
            el = el+'<img class="" src="'+attachment.data('attachmentpath')+'"></img>';
        } else if (attachment.data('attachmenttype')=='video') {
            el = el+'<div class="ratio ratio-16x9"><iframe src="'+attachment.data('attachmentpath')+'" title="'+attachment.data('attachmenttype')+'" allowfullscreen sandbox></iframe></div>';
        } else {
            el = el+'<div class="ratio ratio-16x9"><iframe src="'+attachment.data('attachmentpath')+'" title="'+attachment.data('attachmenttype')+'" allowfullscreen></iframe></div>';
        }

        $('#chatAttachmentPreviewBody').append(el);

        $('#viewChatAttchmentModal').modal('show');
    }

    $.fn.addChatAddElement = function(datarow) {
        var el = '<tr id="dt_chatconnection_row_'+datarow.connid+'" class="odd">'+
        '<td class="d-flex text-start">'+
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
        '<td class="text-end">'+
        '<button data-chatconnectionid="'+datarow.connid+'" type="button" class="btn_chatnow form-action-btn" tabindex="-1">Chat Now</button>'+
        '</td>'+
        '</tr>';

        $('#chatadd_body').append(el);
    }
    //end:element functions

    //begin:jQuery event triggers
    $('#btn_openModalAddChat').click(function() {
        $.fn.openModalAddChat();
    });

    $('#btn_closeModalAddChat').click(function() {
        $.fn.closeModalAddChat();
    });

    $('#btn_openModalChatSettings').click(function() {
        $.fn.openModalChatSettings($(this).data('actionid'));
    });

    //disable on click for dropzone wrapper click event
    $('.img-dropzone-wrapper').click(function(e) {
        $(".dz-hidden-input").prop("disabled",true);
    });

    $('#btn_uploadAttachments').click(function() {

        //enable on click for dropzone wrapper click event
        $(".dz-hidden-input").prop("disabled",false);

        $("#dz_chatattchments").addClass('d-none');

        dz_chatattchments.hiddenFileInput.click();

        //to reset dropzone after adding files
        //array index should be change base on number of dropzones in the page
        $('.dropzone')[0].dropzone.files.forEach(function(file) { 
            file.previewElement.remove(); 
        });
        
        $('.dropzone').removeClass('dz-started');

        dz_chatattchments.files = [];
        //to reset dropzone after adding files
        
    });

    $('#btn_sendMessage').click(function() {
        $("#dz_chatattchments").addClass('d-none');
        $.fn.sendMessage($(this).data('actionid'));
    });

    $('#chatadd_DT_search').keyup(function(e) {
        chatadd_DT.search(e.target.value).draw();
    });
    //end:jQuery event triggers
    

    //begin:init functions
    dz_chatattchments = new Dropzone("#dz_chatattchments", { 
        url: baseurl+"apps/chats/upload/attachments", // Set the url for your upload script location
        paramName: "files", // The name that will be used to transfer the file
        parallelUploads: 3,
        uploadMultiple: true,
        maxFiles: 3,
        maxFilesize: 10, // MB
        thumbnailWidth: 120,
        thumbnailHeight: 120,
        acceptedFiles: "image/*,audio/*,video/*,application/pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx",
        addRemoveLinks: false,
        clickable: true,
        init: function() {
            
            this.on("success", function (file, response) {
            if (response.data.status == 200) {

                var filedata = ''; var fileCount = response.data.uploadedFiles.length;

                response.data.uploadedFiles.forEach(function (file, i) {
                    filedata = filedata + 
                    file.filename+'|'+
                    file.filetype+'|'+
                    file.fileextn+'|'+
                    file.filesize;

                    if (i < fileCount-1) {
                        filedata = filedata + '-';
                    }
                });

                $("#chat_messenger_attchments").val(filedata);
                $("#dz_chatattchments").removeClass('d-none');

            } else {
                $("#chat_messenger_attchments").val('');
                $("#dz_chatattchments").addClass('d-none');
            }
            // response.image will be the relative path to your uploaded image.
            // You could also use response.status to check everything went OK,
            // maybe show an error msg from the server if not.
            });

            this.on("removedfile", function (files) {
                console.log(files);
                $("#chat_messenger_attchments").val('');
                $("#chat_messenger_attchments_er").html('').addClass('d-none'); 
            });

            this.on("addedfiles", function (files) {
                $("#chat_messenger_attchments").val('');
                $("#chat_messenger_attchments_er").html('').addClass('d-none'); 
            });

            this.on("maxfilesexceeded", function (file) {
                this.removeFile(file);
            });

            // for select multiple files but add only one file 
            // enable this code and remove maxFiles config
            // this.on("addedfile", function() {
            //     if (this.files[1]!=null){
            //         this.removeFile(this.files[0]);
            //     }
            //     $("#chat_messenger_attchments").val('');
            //     $("#chat_messenger_attchments_er").html('').addClass('d-none');
            // });

        }
    }); 

    

    $.fn.connectToChatServer();
    $.fn.refreshChats();
    $.fn.initToolTips();
    //end:init functions
});