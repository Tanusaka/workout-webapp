<!--begin::Form-->
<form class="pt-15 pb-10" novalidate="novalidate" id="kt_create_user_form" action="">
    <!--begin::Step 1-->
    <div class="current" data-kt-stepper-element="content">
        <!--begin::Wrapper-->
        <div class="w-100">

            <!--begin::Heading-->
            <div class="pb-10 pb-lg-15">
                <!--begin::Title-->
                <h4 class="fw-bold d-flex align-items-center text-dark">User Information</h4>
                <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Input group-->
            <div class="mb-10 row col-md-6">
                
                <!--begin::Col-->
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">First Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-lg form-control-solid" name="firstname" placeholder="Type first name here..." value="" />
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-md-6">
                    <!--begin::Label-->
                    <label class="required form-label mb-3">Last Name</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="text" class="form-control form-control-lg form-control-solid" name="lastname" placeholder="Type last name here..." value="" />
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
                    <label class="required form-label mb-3">Email</label>
                    <!--end::Label-->
                    <!--begin::Input-->
                    <input type="email" class="form-control form-control-lg form-control-solid" name="email" placeholder="Type email address here..." value="" />
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
                    <label class="required fw-semibold fs-6 mb-5">Role</label>
                    <!--end::Label-->
                    <?php if ( isset($roles) && !empty($roles) ): ?>
                    <?php foreach($roles as $role): ?>
                    <!--begin::Input row-->
                    <div class="d-flex fv-row">
                        <!--begin::Radio-->
                        <div class="form-check form-check-custom form-check-solid">
                            <!--begin::Input--> 
                            <input class="form-check-input me-3" name="roleid" type="radio" value="<?= $role->id; ?>" id="<?= 'kt_course_type_option_'.$role->id; ?>" />
                            <!--end::Input-->
                            <!--begin::Label-->
                            <label class="form-check-label" for="<?= 'kt_course_type_option_'.$role->id; ?>">
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

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Step 1-->
    <!--begin::Actions-->
    <div class="d-flex flex-stack pt-10">
        <!--begin::Wrapper-->
        <div>
            <button type="submit" id="kt_create_user_submit" class="btn btn-lg btn-primary">
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