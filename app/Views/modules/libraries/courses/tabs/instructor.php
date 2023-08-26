<!--begin::Tab Content-->
<!--begin::Course Content Wrapper-->
<div class="course_content_wrapper col-md-6">
    <!--begin::Course Content Header-->
    <div id="kt_course_instructor_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Instrctors</span>
                <span class="text-muted mt-1 fw-semibold fs-7">2 instrctors</span>
            </h3>

            <?php if (isset($permissions->courses_instructor->write) && $permissions->courses_instructor->write) { ?>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a instructor" data-kt-initialized="1">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#modal_addinstructor">
                <i class="ki-duotone ki-plus fs-2"></i>Add Instructor</a>
            </div>
            <?php } ?>

        </div>
    </div>
    <!--end::Course Content Header-->

    <!--begin::Course Content Body-->
    <div id="kt_course_instructor_body">

    <div class="card mb-5 mb-xxl-8">
        <!--begin::Body-->
        <div class="card-body p-0 pt-5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mb-5">
                <!--begin::User-->
                <div class="d-flex align-items-center flex-grow-1">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px me-5">
                        <img src="assets/media/avatars/300-1.jpg" alt="" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column">
                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">Max Smith
                        <span class="mt-1"><i class="ki-duotone ki-verify fs-1 text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i></span>
                        </a>
                        
                        <span class="text-gray-400 fw-bold">Primary Instructor</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
                <!--begin::Menu-->
                <div class="my-0">
                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-category fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </button>
                    <!--begin::Menu 2-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Delete Instructor</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu 2-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Header-->
            <!--begin::Post-->
            <div class="mb-5">
                <!--begin::Text-->
                <p class="text-gray-800 fw-normal mb-5">Outlines keep you honest. They stop you from indulging in poorly thought-out metaphors about driving and keep you focused on the overall structure of your post</p>
                <!--end::Text-->
            </div>
            <!--end::Post-->
            <!--begin::Separator-->
            <div class="separator mb-4"></div>
            <!--end::Separator-->
        </div>
        <!--end::Body-->
    </div>

    <div class="card mb-5 mb-xxl-8">
        <!--begin::Body-->
        <div class="card-body p-0 pt-5">
            <!--begin::Header-->
            <div class="d-flex align-items-center mb-5">
                <!--begin::User-->
                <div class="d-flex align-items-center flex-grow-1">
                    <!--begin::Avatar-->
                    <div class="symbol symbol-45px me-5">
                        <img src="assets/media/avatars/300-1.jpg" alt="" />
                    </div>
                    <!--end::Avatar-->
                    <!--begin::Info-->
                    <div class="d-flex flex-column">
                        <a href="#" class="text-gray-900 text-hover-primary fs-6 fw-bold">Max Smith
                        <span class="mt-1"><i class="ki-duotone ki-verify fs-1 text-primary">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i></span>
                        </a>
                        
                        <span class="text-gray-400 fw-bold">Primary Instructor</span>
                    </div>
                    <!--end::Info-->
                </div>
                <!--end::User-->
                <!--begin::Menu-->
                <div class="my-0">
                    <button type="button" class="btn btn-sm btn-icon btn-color-primary btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                        <i class="ki-duotone ki-category fs-6">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                    </button>
                    <!--begin::Menu 2-->
                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg-light-primary fw-semibold w-200px" data-kt-menu="true">
                        <!--begin::Menu item-->
                        <div class="menu-item px-3">
                            <a href="#" class="menu-link px-3">Delete Instructor</a>
                        </div>
                        <!--end::Menu item-->
                    </div>
                    <!--end::Menu 2-->
                </div>
                <!--end::Menu-->
            </div>
            <!--end::Header-->
            <!--begin::Post-->
            <div class="mb-5">
                <!--begin::Text-->
                <p class="text-gray-800 fw-normal mb-5">Outlines keep you honest. They stop you from indulging in poorly thought-out metaphors about driving and keep you focused on the overall structure of your post</p>
                <!--end::Text-->
            </div>
            <!--end::Post-->
            <!--begin::Separator-->
            <div class="separator mb-4"></div>
            <!--end::Separator-->
        </div>
        <!--end::Body-->
    </div>

    </div>
    <!--end::Course Content Body-->
</div>
<!--end::Course Content Wrapper-->
<!--end::Tab Content-->