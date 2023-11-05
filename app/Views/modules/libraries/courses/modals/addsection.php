<!-- Modal -->
<div class="modal fade" id="addSectionModal" tabindex="-1" aria-labelledby="addSectionModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSectionModalLabel">Add Section</h5>
                <button id="btn_closeModalAddSection" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-addsection" action="" class="">

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Name:</label>
                        <input id="sectionname" class="form-control ap-inp-field" placeholder="Type a name for section..." name="sectionname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="sectionname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>
              
                </form>
                    
            </div>
            <div class="modal-footer">
                <button id="btn_addSection" type="button" class="form-action-btn" tabindex="10">Save Changes</a>
            </div>
        </div>
    </div>
</div>

