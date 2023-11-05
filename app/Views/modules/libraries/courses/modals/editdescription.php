<!-- Modal -->
<div class="modal fade" id="editDescriptionModal" tabindex="-1" aria-labelledby="editDescriptionModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editDescriptionModalLabel">Edit Description</h5>
                <button id="btn_closeModalEditDescription" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-editdescription" action="" class="">

                    <div class="form-group mb-12">
                        <!--begin::Input-->
                        <textarea name="editdescription_RTE" id="editdescription_RTE" class="form-control form-control-lg form-control-solid" style="min-width: 100%" placeholder="Type something about this course..."></textarea>  
                        <!--end::Input-->
                        <label id="editdescription_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                </form>
                    
            </div>
            <div class="modal-footer">
                <button data-actionid="0" id="btn_updateDescription" type="button" class="form-action-btn" tabindex="10">Save Changes</a>
            </div>
        </div>
    </div>
</div>

