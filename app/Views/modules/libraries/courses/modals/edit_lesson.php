<!--begin::Modal - Edit lesson-->
<div class="modal fade" id="kt_modal_editlesson" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_editlesson_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Lesson</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-editlesson-modal-action="close">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--end::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body scroll-y">
                <!--begin::Form-->
                <form id="kt_form_edit_lesson" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_editlesson_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_editlesson_header" data-kt-scroll-wrappers="#kt_modal_editlesson_scroll" data-kt-scroll-offset="300px">

                    <!--begin::Input group-->
                    <div class="inp-hidden">
                        <!--begin::Input-->
                        <input type="hidden" class="inp-hidden-txt" name="edt_lessonid" placeholder="" value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Lesson Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid" name="edt_lessonname" placeholder="Type a name for this lesson..." value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <!-- <div class="fv-row mb-8"> -->
                        <!--begin::Label-->
                        <!-- <label class="form-label mb-3">Upload Your Content -->
                        <!-- <span class="fw-semibold text-muted">(Add a new image to change the existing image)</span> -->
                        <!-- </label> -->
                        <!--end::Label-->
                        <!--begin::Dropzone-->
                        <!-- <div class="dropzone img-dropzone-wrapper" id="kt_edt_lessonmedia"> -->
                            <!--begin::Message-->
                            <!-- <div class="dz-message needsclick"> -->
                                <!--begin::Icon-->
                                <!-- <i class="ki-duotone ki-file-up fs-3hx text-primary"> -->
                                    <!-- <span class="path1"></span> -->
                                    <!-- <span class="path2"></span> -->
                                <!-- </i> -->
                                <!--end::Icon-->
                                <!--begin::Info-->
                                <!-- <div class="ms-4"> -->
                                    <!-- <h3 class="fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3> -->
                                    <!-- <span class="fw-semibold text-muted">Allowed Formats: JPEG, JPG, PNG</span> -->
                                <!-- </div> -->
                                <!--end::Info-->
                            <!-- </div> -->
                        <!-- </div> -->
                        <!--end::Dropzone-->

                        <!--Begin::Input Hidden-->
                        <!-- <div class="inp-hidden"> -->
                        <!--begin::Input-->
                        <!-- <input type="hidden" class="inp-hidden-txt" name="edt_lessonmedia" placeholder="" value=""> -->
                        <!--end::Input-->
                        <!-- </div> -->
                        <!--end::Input Hidden-->

                    <!-- </div> -->
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <!-- <div class="mb-10 fv-row"> -->
                        <!--begin::Label-->
                        <!-- <label class="required form-label mb-3">Duration</label> -->
                        <!--end::Label-->
                        <!--begin::Input-->
                        <!-- <input type="text" class="form-control form-control-lg form-control-solid" name="edt_lessonduration" placeholder="Type duration of this lesson..." value="" /> -->
                        <!--end::Input-->
                    <!-- </div> -->
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Description</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <!-- <textarea name="ecf_content_description" id="ecf_content_description" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="Type something about this lesson..."></textarea> -->
                        <!--end::Input-->
                        <!--begin::Input-->
                        <textarea name="edt_lessondescription" id="kt_edt_lessoneditor" class="form-control form-control-lg form-control-solid" style="min-width: 100%" placeholder="Type something about this lesson...">
                        
                        </textarea>  
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->


                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <!--begin::Submit-->
                    <div class="d-flex justify-content-end align-items-center mt-12">
                        <!--begin::Button-->
                        <button type="submit" id="kt_btn_update_lesson" class="btn btn-light-primary btn-sm">
                        <span class="indicator-label">SAVE</span>
                        <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                        <!--end::Button-->
                    </div>
                    <!--end::Submit-->
                    <!--end::Actions-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Edit lesson-->