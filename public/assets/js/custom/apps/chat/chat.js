"use strict";

let baseurl = $("#baseurl").attr('href');
let linked_user = $("#kt_chat_receiver").attr('user');
alert(linked_user);
// Class definition
var KTAppChat = function () {
	// Private functions
	var handeSend = function (element) {
		if (!element) {
			return;
		}

		// Handle send
		KTUtil.on(element, '[data-kt-element="input"]', 'keydown', function(e) {
			if (e.keyCode == 13) {
				handeMessaging(element);
				e.preventDefault();

				return false;
			}
		});

		KTUtil.on(element, '[data-kt-element="send"]', 'click', function(e) {
			handeMessaging(element);
		});
	}

	var handeMessaging = function(element) {
		var messages = element.querySelector('[data-kt-element="messages"]');
		var input = element.querySelector('[data-kt-element="input"]');
		
        if (input.value.length === 0 ) {
            return;
        }

		var messageOutTemplate = messages.querySelector('[data-kt-element="template-out"]');
		var messageInTemplate = messages.querySelector('[data-kt-element="template-in"]');
		var message;
		
		

		// Check axios library docs: https://axios-http.com/docs/intro 
		axios.post(baseurl+'apps/chats/save', {
			receiver_id: linked_user, 
			message_text: input.value
		}).then(function (response) {
			if (response.data.status==200) {
	
				// Show  outgoing message
				message = messageOutTemplate.cloneNode(true);
				message.classList.remove('d-none');
				message.querySelector('[data-kt-element="message-text"]').innerText = input.value;		
				input.value = '';
				messages.appendChild(message);
				messages.scrollTop = messages.scrollHeight;

			} else {
				// Show error popup. For more info check the plugin's official documentation: https://sweetalert2.github.io/
				Swal.fire({
					text: response.data.message,
					icon: "error",
					buttonsStyling: false,
					confirmButtonText: "Ok, got it!",
					customClass: {
						confirmButton: "btn btn-primary"
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
			});
		});
		
		/*
		setTimeout(function() {			
			// Show example incoming message
			message = messageInTemplate.cloneNode(true);			
			message.classList.remove('d-none');
			message.querySelector('[data-kt-element="message-text"]').innerText = 'Thank you for your awesome support!';
			messages.appendChild(message);
			messages.scrollTop = messages.scrollHeight;
		}, 2000); */
	}

	// Public methods
	return {
		init: function(element) {
			handeSend(element);
        }
	};
}();

// On document ready
KTUtil.onDOMContentLoaded(function () {
	// Init inline chat messenger
    KTAppChat.init(document.querySelector('#kt_chat_messenger'));

	// Init drawer chat messenger
	KTAppChat.init(document.querySelector('#kt_drawer_chat_messenger'));

	var messages = document.querySelector('[data-kt-element="messages"]');
	messages.scrollTop = messages.scrollHeight;

});
