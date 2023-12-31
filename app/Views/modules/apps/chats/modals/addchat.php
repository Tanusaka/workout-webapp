<!-- Modal -->
<div class="modal fade" id="addChatModal" tabindex="-1" aria-labelledby="addChatModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <div>
                    <h5 class="modal-title" id="addChatModalLabel">New Chat</h5>
                </div>
                
                <button id="btn_closeModalAddChat" type="button" class="btn_closeModalAddChat btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="modal-alert">
                    <div id="modal_addchat_alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
                        <div id="modal_addchat_alertmessage"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>

                <div class="table-search-bar">
                    <!--begin::Search-->
                    <div class="d-flex align-items-center position-relative my-1">
                        <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                        <input id="chatadd_DT_search" type="text" data-kt-user-table-filter="search" class="form-control form-control-solid ps-13 ap-inp-field" placeholder="Search connections for chat" autocomplete="off" autocorrect="off" spellcheck="false" />
                    </div>
                    <!--end::Search-->
                </div>

                <table class="table align-middle table-row-dashed" id="chatadd_DT">
                <thead>
                    <tr class="text-start text-muted fw-bold text-truncate fw-sb fs-12 text-uppercase bg-table-header">
                        <th class="min-w-125px">User</th>
                        <th class="min-w-125px">Action</th>
                    </tr>
                </thead>
                <tbody id="chatadd_body" class="text-gray-600 fw-semibold">

                    
                </tbody>
                </table>       
            </div>

        </div>
    </div>
</div>