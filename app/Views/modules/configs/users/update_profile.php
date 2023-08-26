<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h4 class="mb-1">Profile Settings</h4>
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
            <form class="" novalidate="novalidate" id="kt_update_userprofile_form" action="">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">

                        <!--begin::Input group-->
                        <div class="mb-10 row">
                            
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="required form-label mb-3">First Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="firstname" placeholder="Type first name here..." value="<?= $user->firstname; ?>" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="required form-label mb-3">Last Name</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="lastname" placeholder="Type last name here..." value="<?= $user->lastname; ?>" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->

                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 row">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="form-label mb-3">Gender</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <select id="gender_selector" name="gender" aria-label="Select a Gender" data-control="select2" data-placeholder="Select a Gender..." class="form-select form-select-solid">
                                    <option></option>
                                    <option <?php if ($user->gender=='M'){ echo 'selected=selected'; } ?> value="M">Male</option>
                                    <option <?php if ($user->gender=='F'){ echo 'selected=selected'; } ?> value="F">Female</option>
                                </select>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Label-->
                                <label class="form-label mb-3">Date of Birth</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input class="form-control form-control-solid" placeholder="Pick date" name="dob" id="kt_modal_add_task_datepicker" value="<?= $user->dob; ?>"/>
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
                                <label class="form-label mb-3">Mobile Number</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="mobile" placeholder="Type mobile number here..." value="<?= $user->mobile; ?>" />
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
                                <label class="form-label mb-3">Address</label>
                                <!--end::Label-->
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="address1" placeholder="Type Address Line here..." value="<?= $user->address1; ?>" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 row">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="address2" placeholder="Type Address Line here..." value="<?= $user->address2; ?>" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="mb-10 row">
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="city" placeholder="Type city name here..." value="<?= $user->city; ?>" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Input-->
                                <input type="text" class="form-control form-control-lg form-control-solid" name="country" placeholder="Type country name here..." value="<?= $user->country; ?>" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="hidden-inp">
                                <input type="hidden" class="hidden-input" name="uid-updateprofile" value="<?= $user->id; ?>" />
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->


                <!--begin::Submit-->
                <div class="d-flex justify-content-end align-items-center mt-12">
                    <!--begin::Button-->
                    <button type="submit" id="kt_update_userprofile_submit" class="btn btn-light-primary btn-sm">
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