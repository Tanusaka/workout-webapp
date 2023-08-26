<!--begin::Modal - Add link-->
<div class="modal fade" id="kt_modal_addlink" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Modal header-->
            <div class="modal-header" id="kt_modal_addlink_header">
                <!--begin::Modal title-->
                <h2 class="fw-bold">Add Link</h2>
                <!--end::Modal title-->
                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-icon-primary" data-kt-addlink-modal-action="close">
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
                <form id="kt_modal_addlink_form" class="form" action="#">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_addlink_scroll" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_addlink_header" data-kt-scroll-wrappers="#kt_modal_addlink_scroll" data-kt-scroll-offset="300px">

                    <!--begin::Input group-->
                    <div class="mb-10 row">
                        <!--begin::Col-->
                        <div class="col-md-12">
                            <!--begin::Input-->
                            <select id="linkedprofile_selector" name="linkedprofileid" aria-label="Select a User Profile" data-control="select2" data-placeholder="Select a User Profile..." class="form-select form-select-solid" data-dropdown-parent="#kt_modal_addlink">
                                <option></option>
                                <?php if ( isset($usersforlinkedprofile) && !empty($usersforlinkedprofile) ): ?>
                                <?php foreach($usersforlinkedprofile as $userforlinkedprofile): ?>
                                    <option value="<?= $userforlinkedprofile->id; ?>"><?= $userforlinkedprofile->rolename.'-'.$userforlinkedprofile->firstname.' '.$userforlinkedprofile->lastname; ?></option>                     
                                <?php endforeach; ?>    
                                <?php endif; ?> 
                            </select>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="hidden-inp">
                        <input type="hidden" class="hidden-input" name="uid-addlinkedprofile" value="<?= $user->id; ?>" />
                    </div>
                    <!--end::Input group-->


                    </div>
                    <!--end::Scroll-->
                    <!--begin::Actions-->
                    <!--begin::Submit-->
                    <div class="d-flex justify-content-end align-items-center mt-12">
                        <!--begin::Button-->
                        <button type="submit" id="kt_linkedprofile_submit" class="btn btn-light-primary btn-sm">
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
<!--end::Modal - Add link-->