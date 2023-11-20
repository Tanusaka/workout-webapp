<!-- Modal -->
<div class="modal fade" id="editLessonModal" tabindex="-1" aria-labelledby="editLessonModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editLessonModalLabel">Edit Lesson</h5>
                <button id="btn_closeModalEditLesson" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-editlesson" action="" class="">

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Name:</label>
                        <input id="editlessonname" class="form-control ap-inp-field" placeholder="Type a name for lesson..." name="editlessonname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="editlessonname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Duration:</label>
                        <input id="editlessonduration" class="form-control ap-inp-field" placeholder="Select duration of this lesson..." name="editlessonduration" type="time" step="1" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="editlessonduration_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <!--begin::Input-->
                        <textarea name="editlessondescription_RTE" id="editlessondescription_RTE" class="form-control form-control-lg form-control-solid" style="min-width: 100%" placeholder="Type something about this course...">
                            
                        </textarea>  
                        <!--end::Input-->
                        <label id="editlessondescription_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Lesson Media:</label>
                        
                        <div class="row">
                            <div class="col-6">
                                <!--begin::Dropzone-->
                                <div class="dropzone img-dropzone-wrapper" id="dz_editlessonmedia">
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
                                    <input id="editlessonmedia" type="hidden" class="inp-hidden-txt" name="editlessonmedia" placeholder="" value="">
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="align-middle"><b>Important guidelines:</b></p>
                                <p class="align-middle">It must meet our lesson media quality standards to be accepted.</p>
                                <p class="align-middle">Allowed Formats: jpg, jpeg, png, gif, mp3, wma, mpg, flv, avi, pdf, doc, docx, xls, xlsx</p>
                            </div>
                        </div>
                        
                        <label id="editlessonmedia_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>
              
                </form>
                    
            </div>
            <div class="modal-footer">
                <button data-actionid="0" id="btn_updateLesson" type="button" class="form-action-btn" tabindex="10">Save Changes</a>
            </div>
        </div>
    </div>
</div>

