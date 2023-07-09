<!--begin::Tab Content-->
<!--begin::Course Settings Wrapper-->
<div class="course_settings_wrapper col-md-6">
    <!--begin::Course Settings Header-->
    <div id="kt_course_settings_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Settings</span>
                <span class="text-muted mt-1 fw-semibold fs-7"></span>
            </h3>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="" data-kt-initialized="1"></div>
        </div>
    </div>
    <!--end::Course Settings Header-->

    <!--begin::Course Settings Body-->
    <div id="kt_course_settings_body">

    <!--begin::Course Settings Section-->
    <section class="tab_section">
        <div class="tab_section_header m-0">
            <h3 class="text-dark mb-10">Profile</h3>
        </div>
        <div class="tab_section_body m-0">
            <!--begin::Form-->
            <form class="w-100 mw-600px pb-10" novalidate="novalidate" id="kt_update_course_form" action="">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">
                        <!--begin::Label-->
                        <label class="form-label mb-3">Cover Image
                        <span class="fw-semibold text-muted">(Add a new image to change the existing image)</span>
                        </label>
                        <!--end::Label-->
                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            
                            <!--begin::Image View Wrapper-->
                            <!-- <div class="img-view-wrapper" id="kt_edt_preview_courseimage_wrapper"> -->
                            <!--begin::Image input-->
                            <!-- <div class="image-input image-input-outline" data-kt-image-input="true" style="background-image: url('assets/media/svg/avatars/blank.svg')"> -->
                                <!--begin::Preview existing avatar-->
                                <!-- <div id="kt_edt_preview_courseimage" class="image-input-wrapper w-125px h-125px" ></div> -->
                                <!--end::Preview existing avatar-->
                                <!--begin::Remove-->
                                <!-- <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" id="kt_edt_preview_courseimage_remove" data-bs-toggle="tooltip" title="Remove avatar">
                                    <i class="ki-duotone ki-cross fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i> -->
                                <!-- </span> -->
                                <!--end::Remove-->
                            <!-- </div> -->
                            <!--end::Image input-->
                            <!-- </div> -->
                            <!--end::Image View Wrapper-->

                            <!--begin::Dropzone-->
                            <div class="dropzone img-dropzone-wrapper" id="kt_edt_courseimage">
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
                                        <span class="fw-semibold text-muted">Allowed Formats: JPEG, JPG, PNG</span>
                                    </div>
                                    <!--end::Info-->
                                </div>
                            </div>
                            <!--end::Dropzone-->

                            <!--Begin::Input Hidden-->
                            <div class="inp-hidden">
                                <!--begin::Input-->
                                <input type="hidden" class="inp-hidden-txt" name="edt_courseimage" placeholder="" value="">
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
                            <input type="text" class="form-control form-control-lg form-control-solid" name="course_name" placeholder="Type a name for this course..." value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label mb-3">Course Intro</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <input type="text" class="form-control form-control-lg form-control-solid" name="course_intro" placeholder="Type a breif introduction for this course..." value="" />
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10">
                            <!--begin::Label-->
                            <label class="required fw-semibold fs-6 mb-5">Course Type</label>
                            <!--end::Label-->
                            <!--begin::Roles-->
                            <!--begin::Input row-->
                            <div class="d-flex fv-row">
                                <!--begin::Radio-->
                                <div class="form-check form-check-custom form-check-solid">
                                    <!--begin::Input-->
                                    <input class="form-check-input me-3" name="course_type" type="radio" value="basic" id="kt_course_type_option_0" checked='checked' />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_course_type_option_0">
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
                                    <input class="form-check-input me-3" name="course_type" type="radio" value="advanced" id="kt_course_type_option_1" />
                                    <!--end::Input-->
                                    <!--begin::Label-->
                                    <label class="form-check-label" for="kt_course_type_option_1">
                                        <div class="fw-bold text-gray-800">Advanced</div>
                                        <div class="text-gray-600">Courses best suited for professionals</div>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <!--end::Radio-->
                            </div>
                            <!--end::Input row-->
                            <div class='separator separator-dashed my-5'></div>
                            <!--end::Roles-->
                        </div>
                        <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                            <!--begin::Label-->
                            <label class="required form-label mb-3">Description</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <textarea name="course_description" id="course_description" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="Type something about this course..."></textarea>
                            <!--end::Input-->
                        </div>
                        <!--end::Input group-->

                        <!--Begin::Input Hidden-->
                        <div class="inp-hidden">
                            <!--begin::Input-->
                            <input type="hidden" class="inp-hidden-txt" name="courseid" placeholder="" value="">
                            <!--end::Input Hidden-->
                        </div>
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->
                <!--begin::Actions-->
                <div class="d-flex flex-end pt-10">
                    <!--begin::Wrapper-->
                    <div>
                        <button type="submit" id="kt_update_course_submit" class="btn btn-lg btn-primary">
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
        </div>
    </section>
    <!--begin::Course Settings Section-->

    <!--begin::Course Settings Section-->
    <section class="tab_section">
        <div class="tab_section_header m-0">
            <h3 class="text-dark mb-10">Delete Course</h3>
        </div>
        <div class="tab_section_body m-0">
            <!--begin::Form-->
            <form id="kt_account_deactivate_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" novalidate="novalidate">
                <!--begin::Notice-->
                <div class="notice d-flex bg-light-warning rounded border-warning border border-dashed mb-9 p-6">
                    <!--begin::Icon-->
                    <i class="ki-duotone ki-information fs-2tx text-warning me-4">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                    </i>
                    <!--end::Icon-->
                    <!--begin::Wrapper-->
                    <div class="d-flex flex-stack flex-grow-1">
                        <!--begin::Content-->
                        <div class="fw-semibold">
                            <h4 class="text-gray-900 fw-bold">You Are Deleting This Course</h4>
                            <div class="fs-6 text-gray-700">This work cannot be undone please check and confirm before take any action.</div>
                        </div>
                        <!--end::Content-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Notice-->
                <!--begin::Form input row-->
                <div class="form-check form-check-solid fv-row fv-plugins-icon-container fv-plugins-bootstrap5-row-valid">
                    <input name="deactivate" class="form-check-input" type="checkbox" value="" id="deactivate">
                    <label class="form-check-label fw-semibold ps-2 fs-6" for="deactivate">I confirm the deletion of this course</label>
                <div class="fv-plugins-message-container invalid-feedback"></div></div>
                <!--end::Form input row-->
                <!--begin::Form Options-->
                <div class="d-flex flex-end pt-10">
                    <button id="kt_account_deactivate_account_submit" type="submit" class="btn btn-danger fw-semibold">Delete Course</button>
                </div>
                <!--end::Form Options-->
            </form>
            <!--end::Form-->
        </div>
    </section>
    <!--begin::Course Settings Section-->



    </div>
    <!--end::Course Settings Body-->
</div>
<!--end::Course Settings Wrapper-->
<!--end::Tab Content-->


