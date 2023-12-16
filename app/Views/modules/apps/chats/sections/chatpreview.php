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


        <!--begin::Dropzone-->
        <div class="dropzone img-dropzone-wrapper d-none" id="dz_chatattchments">
        <!--begin::Message-->
        <div class="dz-message needsclick">
            <!--begin::Icon-->
            <i class="ki-duotone ki-file-up fs-3hx text-primary">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <!--end::Icon-->
            <!--begin::Info-->
            <div class="ms-4">
                <h4 class="fw-bold text-gray-900 mb-1 fs-14">Drop files here or click to upload.</h4>
                <span class="fw-semibold text-muted"></span>
            </div>
            <!--end::Info-->
        </div>
        </div>
        <!--end::Dropzone-->
        <div class="inp-hidden">
            <!--begin::Input-->
            <input id="chat_messenger_attchments" type="hidden" class="inp-hidden-txt" name="chat_messenger_attchments" placeholder="" value="">
            <!--end::Input-->
        </div>
        
        <!--begin:Toolbar-->
        <div class="d-flex justify-content-end mt-4">
            <!--begin::Input-->
            <textarea id="chat_messenger_text" class="form-control form-control-flush mb-3 mr-10" rows="1" data-kt-element="input" placeholder="Type a message"></textarea>
            <!--end::Input-->
            <!--begin::Actions-->
            <button id="btn_uploadAttachments" class="btn btn-icon btn-active-light-primary" type="button">
                <i class="ki-duotone ki-paper-clip fs-3"></i>
            </button>
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


<?= $this->include('modules/apps/chats/modals/viewattachment') ?>