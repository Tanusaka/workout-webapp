<!--begin::Modal - Add follower-->
<div class="modal fade" id="kt_modal_addfollower" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_addfollower_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Follower</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-addfollower-modal-action="close">
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
                <form id="kt_form_create_follower" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_addfollower_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_addfollower_header" data-kt-scroll-wrappers="#kt_modal_addfollower_scroll" data-kt-scroll-offset="300px">

                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <!--begin::Label-->
                            <label class="required form-label mb-3">Follower Name</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select id="follower_selector" class="js-data-example-ajax form-select form-select-solid" aria-label="Select a Follower" data-control="select2" data-placeholder="Select a Follower..." data-dropdown-parent="#kt_modal_addfollower"></select>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    
                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <!--begin::Label-->
                            <label class="required form-label mb-3">Follower Type</label>
                            <!--end::Label-->
                            <!--begin::Input-->
                            <select id="followertype_selector" class="js-data-example-ajax form-select form-select-solid" aria-label="Select a type" data-control="select2" data-placeholder="Select a type..." data-dropdown-parent="#kt_modal_addfollower">
                                <option></option>
                                <option value="Free">Free Enrollment</option>
                                <option value="Paid">Paid Enrollment</option>
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
                        <button type="submit" id="kt_btn_save_follower" class="btn btn-light-primary btn-sm">
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
<!--end::Modal - Add follower-->