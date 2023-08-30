<!--begin::Modal - Edit section-->
<div class="modal fade" id="kt_modal_editsection" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_editsection_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Edit Section</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-editsection-modal-action="close">
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
                <form id="kt_form_edit_section" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_editsection_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_editsection_header" data-kt-scroll-wrappers="#kt_modal_editsection_scroll" data-kt-scroll-offset="300px">

                    <!--begin::Input group-->
                    <div class="inp-hidden">
                        <!--begin::Input-->
                        <input type="hidden" class="inp-hidden-txt" name="edt_sectionid" placeholder="" value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Section Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid" name="edt_sectionname" placeholder="Type a name for this section..." value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <!--begin::Submit-->
                    <div class="d-flex justify-content-end align-items-center mt-12">
                        <!--begin::Button-->
                        <button type="submit" id="kt_btn_update_section" class="btn btn-light-primary btn-sm">
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
<!--end::Modal - Edit section-->