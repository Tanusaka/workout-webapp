<!--begin::Messenger-->
<div class="card" id="chat_messenger">
    <!--begin::Card header-->
    <div class="card-header" id="chat_messenger_header">
        <!--begin::Title-->
        <div class="card-title">
            <!--begin::User-->
            <div class="d-flex justify-content-center flex-column me-3">
                <a id="chat_messanger_name" class="fs-4 fw-bold text-gray-900 text-hover-primary me-1 mb-2 lh-1"></a>

                <div id="chat_messanger_status" class="mb-0 lh-1">
                    
                </div>

            </div>
            <!--end::User-->
        </div>
        <!--end::Title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!-- <button id="btn_openModalChatSettings" data-actionid="0" class="btn btn-sm btn-icon btn-active-light-primary">
                <i class="ki-duotone ki-dots-square fs-3">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                </i>
            </button> -->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body" id="chat_messenger_body">
        <!--begin::Messages-->
        <div id="chat_messenger_thread" class="scroll-y me-n5 pe-5 h-300px h-lg-auto mx-height-228">
            
        
            
        </div>
        <!--end::Messages-->
    </div>
    <!--end::Card body-->
    <!--begin::Card footer-->
    <div class="card-footer pt-4" id="chat_messenger_footer">
        <!--begin::Input-->
        <textarea id="chat_messenger_text" class="form-control form-control-flush mb-3" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
        <!--end::Input-->
        <!--begin:Toolbar-->
        <div class="d-flex flex-stack">
            <!--begin::Actions-->
            <div class="d-flex align-items-center me-2">
                <!-- <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" aria-label="Coming soon" data-bs-original-title="Coming soon" data-kt-initialized="1">
                    <i class="ki-duotone ki-paper-clip fs-3"></i>
                </button> -->
                <!-- <button class="btn btn-sm btn-icon btn-active-light-primary me-1" type="button" data-bs-toggle="tooltip" aria-label="Coming soon" data-bs-original-title="Coming soon" data-kt-initialized="1">
                    <i class="ki-duotone ki-exit-up fs-3">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </button> -->
            </div>
            <!--end::Actions-->
            <!--begin::Send-->
            <button id="btn_sendMessage" class="btn btn-primary" type="button">Send</button>
            <!--end::Send-->
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Card footer-->
</div>
<!--end::Messenger-->