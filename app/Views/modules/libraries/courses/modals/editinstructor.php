<!-- Modal -->
<div class="modal fade" id="editInstructorModal" tabindex="-1" aria-labelledby="editInstructorModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editInstructorModalLabel">Edit Instructor</h5>
                <button id="btn_closeModalEditInstructor" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            <form id="form-editinstructor" action="" class="">

            <div class="form-group mb-12">
                <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Instructor Profile:</label>
                <select id="editinstructorprofile" name="editinstructorprofile" aria-label="Select instructor of this course..." data-control="select2" data-placeholder="Select instructor of this course.." class="form-select">
                    <option></option>
                                       
                </select>
                
                <label id="editinstructorprofile_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
            </div>

            </form>
                    
            </div>
            <div class="modal-footer">
                <button data-actionid="0" id="btn_updateInstructor" type="button" class="form-action-btn" tabindex="3">Save Changes</a>
            </div>
        </div>
    </div>
</div>