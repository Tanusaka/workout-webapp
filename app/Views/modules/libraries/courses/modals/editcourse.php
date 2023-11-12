<!-- Modal -->
<div class="modal fade" id="editCourseModal" tabindex="-1" aria-labelledby="editCourseModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCourseModalLabel">Edit Course</h5>
                <button id="btn_closeModalEditCourse" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-editcourse" action="" class="">

                    <div class="profile-txtgroup mb-3">
                        <p class="text-truncate fw-sb fs-12 fc-dark">Course Information</p>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Name:</label>
                        <input id="editcoursename" class="form-control ap-inp-field" placeholder="Type a name for your course..." name="editcoursename" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="editcoursename_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Course Intro:</label>
                        <input id="editcourseintro" class="form-control ap-inp-field" placeholder="Type a brief introduction about your course..." name="editcourseintro" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="">
                        <label id="editcourseintro_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="top-gap-15"></div>
                    
                        
                    <div class="profile-txtgroup mb-3">
                        <p class="text-truncate fw-sb fs-12 fc-dark">Basic Information</p>
                    </div>
                
                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Level:</label>
                        <select id="editcourselevel" name="editcourselevel" aria-label="Select level for this course..." data-control="select2" data-placeholder="Select level for this course..." class="form-select">
                            <option></option>
                            <option value="BL">Beginner Level</option>     
                            <option value="IL">Intermediate Level</option>      
                            <option value="EL">Expert Level</option>    
                            <option value="AL">Any Level</option>                 
                        </select>
                        
                        <label id="editcourselevel_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Type:</label>
                        <select id="editcoursetype" name="editcoursetype" aria-label="Select type of this course..." data-control="select2" data-placeholder="Select type of this course..." class="form-select">
                            <option></option>
                            <option value="FC">Free Course</option>     
                            <option value="PC">Paid Course</option>                     
                        </select>
                        
                        <label id="editcoursetype_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Image:</label>
                        
                        <div class="row">
                            <div class="col-6">
                                <!--begin::Dropzone-->
                                <div class="dropzone img-dropzone-wrapper" id="dz_editcourseimage">
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
                                    <input id="editcourseimage" type="hidden" class="inp-hidden-txt" name="editcourseimage" placeholder="" value="">
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="align-middle"><b>Important guidelines:</b></p>
                                <p class="align-middle">It must meet our course image quality standards to be accepted.</p>
                                <p class="align-middle">Allowed Formats: jpg, jpeg, png, gif</p>
                            </div>
                        </div>
                        
                        <label id="editcourseimage_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                </form>
                    
            </div>
            <div class="modal-footer">
                <button data-actionid="0" id="btn_updateCourse" type="button" class="form-action-btn" tabindex="3">Save Changes</a>
            </div>
        </div>
    </div>
</div>

