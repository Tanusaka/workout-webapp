<!--begin::Layout-->
<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-lg-250px w-xl-350px mb-10">
        <!--begin::Card-->
        <div class="card mb-5 mb-xl-8">
            <!--begin::Card body-->
            <div class="card-body">
                <!--begin::Summary-->
                <!--begin::User Info-->
                <div class="d-flex flex-center flex-column py-5">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-100px symbol-circle mb-7">
                        <img src="assets/media/avatars/blank.png" alt="image" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Name-->
                    <a id="dsp_profilename" href="#" class="fs-3 text-gray-800 text-hover-primary fw-bold mb-3"><?= $user->firstname.' '.$user->lastname; ?></a>
                    <!--end::Name-->
                    <!--begin::Position-->
                    <div class="mb-9">
                        <!--begin::Badge-->
                        <div id="dsp_rolename" class="badge badge-lg badge-light-primary d-inline"><?= $user->rolename; ?></div>
                        <!--begin::Badge-->
                    </div>
                    <!--end::Position-->
                    <!--begin::Info-->
                    <!--begin::Info heading-->

                    <!--end::Info heading-->
    
                    <!--end::Info-->
                </div>
                <!--end::User Info-->
                <!--end::Summary-->
                <!--begin::Details toggle-->
                <div class="d-flex flex-stack fs-4 py-3">
                    <div class="fw-bold rotate collapsible" data-bs-toggle="collapse" href="#kt_user_view_details" role="button" aria-expanded="false" aria-controls="kt_user_view_details">Details
                    <span class="ms-2 rotate-180">
                        <i class="ki-duotone ki-down fs-3"></i>
                    </span></div>
                    <!-- Edit User Details -->
                </div>
                <!--end::Details toggle-->
                <div class="separator"></div>
                <!--begin::Details content-->
                <div id="kt_user_view_details" class="collapse show">
                    <div class="pb-5 fs-6">
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Account ID</div>
                        <div class="text-gray-600"><?= 'ID-'.$user->id; ?></div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Email</div>
                        <div class="text-gray-600">
                            <a href="#" class="text-gray-600 text-hover-primary"><?= $user->email; ?></a>
                        </div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Address</div>
                        <div class="text-gray-600">
                        <span id="dsp_address1"><?= $user->address1; ?></span>
                        <br />
                        <span id="dsp_address2"><?= $user->address2; ?></span>
                        <br />
                        <span id="dsp_city"><?= $user->city; ?></span>
                        <br />
                        <span id="dsp_country"><?= $user->country; ?></span>
                        </div>
                        <!--begin::Details item-->
                        <!--begin::Details item-->
                        <div class="fw-bold mt-5">Last Login</div>
                        <div class="text-gray-600"><?= $user->lastinat; ?></div>
                        <!--begin::Details item-->
                    </div>
                </div>
                <!--end::Details content-->
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Card-->
        <!--begin::Connected Accounts-->

        <!--end::Connected Accounts-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div class="flex-lg-row-fluid ms-lg-15">
        <!--begin:::Tabs-->
        <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-semibold mb-8">
            
            <?php if (isset($permissions->users_linkedprofiles->read) && $permissions->users_linkedprofiles->read) { ?>
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#kt_user_view_linkedprofiles_tab">Linked Profiles</a>
            </li>
            <!--end:::Tab item-->
            <?php } ?>
            
            <?php if (isset($permissions->users->read) && $permissions->users->read) { ?>
            <!--begin:::Tab item-->
            <li class="nav-item">
                <a class="nav-link text-active-primary pb-4" data-kt-countup-tabs="true" data-bs-toggle="tab" href="#kt_user_view_sttings_tab">Settings</a>
            </li>
            <!--end:::Tab item-->
            <?php } ?>

        </ul>
        <!--end:::Tabs-->
        <!--begin:::Tab content-->
        <div class="tab-content" id="myTabContent">
            
            <?php if (isset($permissions->users_linkedprofiles->read) && $permissions->users_linkedprofiles->read) { ?>
            <!--begin:::Tab pane-->
            <div class="tab-pane fade show active" id="kt_user_view_linkedprofiles_tab" role="tabpanel">
                <?= $this->include('modules/configs/users/linkedprofiles') ?>
            </div>
            <!--end:::Tab pane-->
            <?php } ?>

            <?php if (isset($permissions->users->read) && $permissions->users->read) { ?>
            <!--begin:::Tab pane-->
            <div class="tab-pane fade" id="kt_user_view_sttings_tab" role="tabpanel">
                <?= $this->include('modules/configs/users/settings') ?>
            </div>
            <!--end:::Tab pane-->
            <?php } ?>
            
        </div>
        <!--end:::Tab content-->
    </div>
    <!--end::Content-->
</div>
<!--end::Layout-->