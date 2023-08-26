<!--begin::Card-->
<div class="card pt-4 mb-6 mb-xl-9">
    <!--begin::Card header-->
    <div class="card-header border-0">
        <!--begin::Card title-->
        <div class="card-title flex-column">
            <h4 class="mb-1">Change User Role</h4>
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
            <form class="" novalidate="novalidate" id="kt_update_userrole_form" action="">
                <!--begin::Step 1-->
                <div class="current" data-kt-stepper-element="content">
                    <!--begin::Wrapper-->
                    <div class="w-100">

                        <!--begin::Input group-->
                        <div class="mb-10 row">
                            <!--begin::Col-->
                            <div class="col-md-12">
                                <?php if ( isset($roles) && !empty($roles) ): ?>
                                <?php foreach($roles as $role): ?>
                                <!--begin::Input row-->
                                <div class="d-flex fv-row">
                                    <!--begin::Radio-->
                                    <div class="form-check form-check-custom form-check-solid">
                                        <!--begin::Input--> 
                                        <input class="form-check-input me-3" name="roleid" type="radio" data-rolename="<?= $role->rolename; ?>" value="<?= $role->id; ?>" id="<?= 'kt_user_role_option_'.$role->id; ?>" <?php if ($user->roleid==$role->id) : echo "checked"; endif; ?>/>
                                        <!--end::Input-->
                                        <!--begin::Label-->
                                        <label class="form-check-label" for="<?= 'kt_user_role_option_'.$role->id; ?>">
                                            <div class="fw-bold text-gray-800"><?= $role->rolename; ?></div>
                                            <div class="text-gray-600"><?= $role->roledesc; ?></div>
                                        </label>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Radio-->
                                </div>
                                <!--end::Input row-->

                                <div class='separator separator-dashed my-5'></div>
                                <?php endforeach; ?>    
                                <?php endif; ?>   
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="hidden-inp">
                                <input type="hidden" class="hidden-input" name="uid-updaterole" value="<?= $user->id; ?>" />
                        </div>
                        <!--end::Input group-->

                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Step 1-->


                <!--begin::Submit-->
                <div class="d-flex justify-content-end align-items-center mt-12">
                    <!--begin::Button-->
                    <button type="submit" id="kt_update_userrole_submit" class="btn btn-light-primary btn-sm">
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