<!--begin::Modal - Add review-->
<div class="modal fade" id="kt_modal_addreview" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_addreview_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Review</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-addreview-modal-action="close">
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
                <form id="kt_form_create_review" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_addreview_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_addreview_header" data-kt-scroll-wrappers="#kt_modal_addreview_scroll" data-kt-scroll-offset="300px">

                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Review</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea name="crt_review" id="crt_review" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="Type a review for this course..."></textarea>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <!--begin::Label-->
                            <label class="required form-label mb-3">Rating</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select id="crt_rating_selector" class="js-data-example-ajax form-select form-select-solid" aria-label="Select a rating" data-control="select2" data-placeholder="Select a rating..." data-dropdown-parent="#kt_modal_addreview">
                                <option></option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->


                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <!--begin::Submit-->
                    <div class="d-flex justify-content-end align-items-center mt-12">
                        <!--begin::Button-->
                        <button type="submit" id="kt_btn_save_review" class="btn btn-light-primary btn-sm">
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
<!--end::Modal - Add review-->