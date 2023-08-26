<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h4 class="mb-1">Change Password</h4>
            <div class="fs-6 fw-semibold text-muted"></div>
        </div>
        <!--end::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->
    <!--begin::Card body-->
    <div class="card-body pb-5">
        <!--begin::Content-->
        <div class="d-flex flex-column">
            <!--begin::Form-->
            <form class="" novalidate="novalidate" id="kt_update_userpassword_form" action="">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">

                        <!--begin::Input group-->
                        <div class="mb-10 row">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <!--begin::Label-->
                                <label class="required form-label mb-3">Current Password</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" class="form-control form-control-lg form-control-solid" name="current_password" placeholder="Type your current password here..." value="" />
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
                                <label class="required form-label mb-3">New Password</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" class="form-control form-control-lg form-control-solid" name="new_password" placeholder="Type your new password here..." value="" />
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
                                <label class="required form-label mb-3">Confirm Password</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="password" class="form-control form-control-lg form-control-solid" name="confirm_password" placeholder="Re-type your new password here..." value="" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="hidden-inp">
                                <input type="hidden" class="hidden-input" name="uid-updatepw" value="<?= $user->id; ?>" />
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->


                <!--begin::Submit-->
                <div class="d-flex justify-content-end align-items-center mt-12">
                    <!--begin::Button-->
                    <button type="submit" id="kt_update_userpassword_submit" class="btn btn-light-primary btn-sm">
                    <span class="indicator-label">SAVE</span>
                    <span class="indicator-progress">Please wait...
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Submit-->

            </form>
            <!--end::Form-->

        </div>
        <!--end::Content-->
        
    </div>
    <!--end::Card body-->
    </div>
    <!--end::Card-->