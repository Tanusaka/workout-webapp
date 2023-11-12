"use strict";

$(document).ready(function () {

    var chatadd_DT;

    //begin:function defenitions

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

        if (textMessage!=="") {
            axios.post(baseurl+'apps/chats/save/chat/personal/message', {
                chatid: id, 
                type: "text",
                message: textMessage
            }).then(function (response) {

                if (response.data.status==200) {
                $.fn.openChat(id);
                $('#chat_messenger_text').val('');
                } else {
                $('#chat_messenger_text').val('');
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
            $(document).off().on('click', '.btn_openchat', function() {

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
        $('#btn_openModalChatSettings').data("actionid", chat.id);
        $('#btn_sendMessage').data("actionid", chat.id);

        $('#chat_messenger_thread').empty();

        $.each(chat.messages, function(index, message) {
            $.fn.addChatMessageElement(message);
        });

        // //use off to prevent calling the function multiples times on each initialization
        // $(document).off().on('click', '.btn_openchat', function() {
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
        $(document).off().on('click', '.btn_chatnow', function() {
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
                    '<img src="'+datarow.chatimage+'" class="" alt="">'+
                '</div>';
            } else {
                el = el + '<div class="symbol symbol-45px symbol-circle">'+
                    '<span class="symbol-label bg-light-danger text-danger fs-6 fw-bolder">'+
                    datarow.name.charAt(0).toUpperCase()+
                    '</span>'+
                '</div>';
            }

            el = el + '<div class="ms-5">'+
                    '<a class="fs-5 fw-bold text-gray-900 text-hover-primary mb-2">'+datarow.name+'</a>'+
                    '<div class="fw-semibold text-muted">'+datarow.about+'</div>'+
                '</div>'+
            '</div>'+
            '<div class="d-flex flex-column align-items-end ms-2">'+
                '<span class="text-muted fs-7 mb-1">1 week</span>'+
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
                        '<span class="text-muted fs-7 mb-1">2 mins</span>'+
                    '</div>'+
                '</div>'+
                '<div class="p-5 rounded bg-light-info text-dark fw-semibold mw-lg-400px text-start" data-kt-element="message-text">'+message.content+'</div>'+
            '</div>'+
        '</div>';

        $('#chat_messenger_thread').append(el);
    }

    $.fn.addChatMessageOutElement = function(message) {

        var el = '<div class="d-flex justify-content-end mb-10">'+
            '<div class="d-flex flex-column align-items-end">'+
                '<div class="d-flex align-items-center mb-2">'+
                    '<div class="me-3">'+
                        '<span class="text-muted fs-7 mb-1">5 mins</span>'+
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
       
        el = el + '</div>'+
                '<div class="p-5 rounded bg-light-primary text-dark fw-semibold mw-lg-400px text-end" data-kt-element="message-text">'+message.content+'</div>'+
            '</div>'+
        '</div>';

        $('#chat_messenger_thread').append(el);
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

    $('#btn_sendMessage').click(function() {
        $.fn.sendMessage($(this).data('actionid'));
    });

    $('#chatadd_DT_search').keyup(function(e) {
        chatadd_DT.search(e.target.value).draw();
    });
    //end:jQuery event triggers
    

    //begin:init functions
    $.fn.connectToChatServer();
    $.fn.refreshChats();
    //end:init functions
});