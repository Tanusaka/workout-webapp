<!-- Modal -->
<div class="modal fade" id="addLessonModal" tabindex="-1" aria-labelledby="addLessonModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addLessonModalLabel">Add Lesson</h5>
                <button id="btn_closeModalAddLesson" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-addlesson" action="" class="">

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Name:</label>
                        <input id="lessonname" class="form-control ap-inp-field" placeholder="Type a name for lesson..." name="lessonname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="lessonname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Duration:</label>
                        <input id="lessonduration" class="form-control ap-inp-field" placeholder="Select duration of this lesson..." name="lessonduration" type="time" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="lessonduration_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Description:</label>
                        <textarea name="lessondescription_RTE" id="lessondescription_RTE" class="form-control form-control-lg form-control-solid" style="min-width: 100%" placeholder="Type something about this course...">
                            
                        </textarea>  
                        <label id="lessondescription_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Lesson Media:</label>
                        
                        <div class="row">
                            <div class="col-6">
                                <!--begin::Dropzone-->
                                <div class="dropzone img-dropzone-wrapper" id="dz_lessonmedia">
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
                                            <span class="fw-semibold text-muted">Allowed Formats: jpeg, jpg, png</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="inp-hidden">
                                    <!--begin::Input-->
                                    <input id="lessonmedia" type="hidden" class="inp-hidden-txt" name="lessonmedia" placeholder="" value="">
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="align-middle">Upload your lesson media here. Important guidelines: 750x422 pixels; .jpg, .jpeg or .png. no text on the image or any video file.</p>
                            </div>
                        </div>
                        
                        <label id="lessonmedia_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>
              
                </form>
                    
            </div>
            <div class="modal-footer">
                <button data-actionid="0" id="btn_addLesson" type="button" class="form-action-btn" tabindex="10">Save Changes</a>
            </div>
        </div>
    </div>
</div>

