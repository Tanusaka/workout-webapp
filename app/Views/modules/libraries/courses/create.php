<!--begin::Form-->
<form class="w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_form_create_course" action="">
    <!--begin::Step 1-->
    <div class="current" data-kt-stepper-element="content">
        <!--begin::Wrapper-->
        <div class="w-100">
            
            <!--begin::Heading-->

            <!--end::Heading-->

            <!--begin::Label-->
            <label class="required form-label mb-3">Cover Image</label>
            <!--end::Label-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Dropzone-->
                <div class="dropzone img-dropzone-wrapper" id="kt_crt_courseimage">
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
                            <h3 class="fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                            <span class="fw-semibold text-muted">Allowed Formats: jpeg, jpg, png</span>
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
                <!--end::Dropzone-->

                <!--Begin::Input Hidden-->
                <div class="inp-hidden">
                    <!--begin::Input-->
                    <input type="hidden" class="inp-hidden-txt" name="crt_courseimage" placeholder="" value="">
                    <!--end::Input-->
                </div>
                <!--end::Input Hidden-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="required form-label mb-3">Course Name</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-lg form-control-solid" name="crt_coursename" placeholder="Type a name for this course..." value="" />
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="required form-label mb-3">Course Intro</label>
                <!--end::Label-->
                <!--begin::Input-->
                <input type="text" class="form-control form-control-lg form-control-solid" name="crt_courseintro" placeholder="Type a breif introduction for this course..." value="" />
                <!--end::Input-->
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="mb-10">
                <!--begin::Label-->
                <label class="required fw-semibold fs-6 mb-5">Course Type</label>
                <!--end::Label-->
                <!--begin::Course Type-->
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="crt_coursetype" type="radio" value="basic" id="kt_crt_coursetype_option_0"/>
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_crt_coursetype_option_0">
                            <div class="fw-bold text-gray-800">Basic</div>
                            <div class="text-gray-600">Courses best suited for beginners</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class='separator separator-dashed my-5'></div>
                <!--begin::Input row-->
                <div class="d-flex fv-row">
                    <!--begin::Radio-->
                    <div class="form-check form-check-custom form-check-solid">
                        <!--begin::Input-->
                        <input class="form-check-input me-3" name="crt_coursetype" type="radio" value="advanced" id="kt_crt_coursetype_option_1"/>
                        <!--end::Input-->
                        <!--begin::Label-->
                        <label class="form-check-label" for="kt_crt_coursetype_option_1">
                            <div class="fw-bold text-gray-800">Advanced</div>
                            <div class="text-gray-600">Courses best suited for professionals</div>
                        </label>
                        <!--end::Label-->
                    </div>
                    <!--end::Radio-->
                </div>
                <!--end::Input row-->
                <div class='separator separator-dashed my-5'></div>
                <!--end::Course Type-->
            </div>
            <!--end::Input group-->
            <!--begin::Input group-->
            <div class="mb-10 fv-row">
                <!--begin::Label-->
                <label class="required form-label mb-3">Description</label>
                <!--end::Label-->
                <!--begin::Input-->
                <textarea name="crt_coursedescription" id="kt_crt_courseeditor" class="form-control form-control-lg form-control-solid" placeholder="Type something about this course...">
                
                </textarea>  
                <!--end::Input-->
            </div>
            <!--end::Input group-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Step 1-->
    <!--begin::Actions-->
    <div class="d-flex flex-stack pt-10">
        <!--begin::Wrapper-->
        <div>
            <button type="submit" id="kt_btn_save_course" class="btn btn-lg btn-primary">
                <span class="indicator-label">Save
                <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i></span>
                <span class="indicator-progress">Please wait...
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Actions-->
</form>
<!--end::Form-->