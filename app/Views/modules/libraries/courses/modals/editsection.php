<!-- Modal -->
<div class="modal fade" id="editSectionModal" tabindex="-1" aria-labelledby="editSectionModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSectionModalLabel">Edit Section</h5>
                <button id="btn_closeModalEditSection" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form id="form-editsection" action="" class="">

            <div class="form-group mb-12">
                <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Name:</label>
                <input id="editsectionname" class="form-control ap-inp-field" placeholder="Type a name for section..." name="editsectionname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                <label id="editsectionname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
            </div>

            </form>
                    
            </div>
            <div class="modal-footer">
                <button data-actionid="0" id="btn_updateSection" type="button" class="form-action-btn" tabindex="3">Save Changes</a>
            </div>
        </div>
    </div>
</div>