<!--begin::Modal - Edit Section-->
<div id="modal_editsection" class="modal fade" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <i class="ki-duotone ki-cross fs-1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div id="modal_body_viewcontent" class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
               
                <!--begin::Form-->
                <form class="w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_update_section_form" action="">
                    <!--begin::Step 1-->
                    <div class="current" data-kt-stepper-element="content">
                        <!--begin::Wrapper-->
                        <div class="w-100">
                            <!--begin::Heading-->
                            <div class="pb-10 pb-lg-15">
                                <!--begin::Title-->
                                <h2 class="fw-bold d-flex align-items-center text-dark">Edit Section
                                <!-- <span class="ms-1" data-bs-toggle="tooltip" title="Course name will be used as reference within your course reports">
                                    <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                    </i>
                                </span> -->
                                </h2>
                                <!--end::Title-->
                                <!--begin::Notice-->
                                <div class="text-muted fw-semibold fs-6">If you need more info, please check out
                                <a href="#" class="link-primary fw-bold">Help Page</a>.</div>
                                <!--end::Notice-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Input group-->
                            <div class="inp-hidden">
                                <!--begin::Input-->
                                <input type="hidden" class="inp-hidden-txt" name="section_id" placeholder="" value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                                <!--begin::Label-->
                                <label class="required form-label mb-3">Section Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="section_name" placeholder="Type a name for this section..." value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Step 1-->
                    <!--begin::Actions-->
                    <div class="d-flex flex-end pt-10">
                        <!--begin::Wrapper-->
                        <div>
                            <button type="submit" id="kt_update_section_submit" class="btn btn-lg btn-primary">
                                <span class="indicator-label">Update
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
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - Edit Section-->