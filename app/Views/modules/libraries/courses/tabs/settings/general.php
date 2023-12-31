<div id="form-genralsettings" action="" class="col-md-12 mb-6">
    
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

    <div class="form-group mb-12 d-none">
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
    

    <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
        <button data-actionid="0" id="btn_updateCourse" type="button" class="form-action-btn" tabindex="3">Save Changes</a>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>


<div class="row">
    <div class="form-group mb-12 col-12">
        <div class="d-flex flex-stack">
            <div class="d-flex">
                <img src="assets/images/options.png" class="w-32px me-6" alt="">
                <div class="d-flex flex-column">
                    <a href="#" class="fs-5 text-dark text-hover-primary fw-bold">Publish/Unpublish Course </a>
                    <div class="fs-6 fw-semibold text-muted">You can change the visibility of this course at anytime.</div>
                </div>
            </div>
            <div class="d-flex justify-content-end text-center">
                <label class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                    <input id="chnagestatus" class="form-check-input" name="chnagestatus" type="checkbox" value=""
                    <?php if ($course->status=='A') : echo "checked"; endif; ?>
                    <?php if ($course->status=='D') : echo "disabled"; endif; ?>
                    />
                    <span class="form-check-label fw-semibold text-muted"></span>
                </label>
            </div>
        </div>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<div class="row">
    <div class="form-group mb-12 col-12">
        <div class="d-flex flex-stack">
            <div class="d-flex">
                <img src="assets/images/delete.png" class="w-32px me-6" alt="">
                <div class="d-flex flex-column">
                    <a href="#" class="fs-5 text-dark text-hover-primary fw-bold">Delete Course </a>
                    <div class="fs-6 fw-semibold text-muted">This action cannot be undone and will delete all the contents of this course.</div>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <button data-actionid="0" id="btn_deleteCourse" type="button" class="form-action-btn" tabindex="3">Delete Course</a>
            </div>
        </div>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>
