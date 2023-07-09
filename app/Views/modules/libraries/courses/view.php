<?= $this->extend('layouts/appLayout') ?>

<?= $this->section('content') ?>
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Course Profile</h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Home</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">
                    <a href="../../demo1/dist/index.html" class="text-muted text-hover-primary">Libraries</a>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">Courses</li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item">
                    <span class="bullet bg-gray-400 w-5px h-2px"></span>
                </li>
                <!--end::Item-->
                <!--begin::Item-->
                <li class="breadcrumb-item text-muted">View Profile</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <a href="#" class="btn btn-sm btn-primary me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_offer_a_deal">Enroll Now</a>
            <!--end::Primary button-->
        </div>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">

    <!--begin::Navbar-->
    <div class="card mb-5 mb-xxl-8">
        <div class="card-body pt-9 pb-0">
            <!--begin::Details-->
            <div class="d-flex flex-wrap flex-sm-nowrap">
                <!--begin: Pic-->
                <div class="me-7 mb-4">
                    <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                        <img id="prof_course_covermedia" src="<?php echo $course->coursemediapath; ?>" alt="image" />
                        <!-- <div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-body h-20px w-20px"></div> -->
                    </div>
                </div>
                <!--end::Pic-->
                <!--begin::Info-->
                <div class="flex-grow-1">
                    <!--begin::Title-->
                    <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                        <!--begin::User-->
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">
                                <a id="prof_course_title" href="#" class="text-gray-900 text-hover-primary fs-2 fw-bold me-1"><?php echo $course->coursename; ?></a>
                                <!-- <a href="#">
                                    <i class="ki-duotone ki-verify fs-1 text-primary">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a> -->
                            </div>
                            <!--end::Name-->
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <span id="prof_course_subtitle" class="text-gray-400 text-wrap"><?php echo $course->courseintro; ?></span>
                            </div>
                            <div class="d-flex flex-wrap fw-semibold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                <i class="ki-duotone ki-profile-circle fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                    <span class="path3"></span>
                                </i>Instructor Name</a>
                                <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                <i class="ki-duotone ki-sms fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>max@kt.com</a>
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::User-->

                    </div>
                    <!--end::Title-->
                    <!--begin::Stats-->
                    <div class="d-flex flex-wrap flex-stack">
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-column flex-grow-1 pe-8">
                            <!--begin::Stats-->
                            <div class="d-flex flex-wrap">
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="4500" data-kt-countup-prefix="">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-400">Followers</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="10">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-400">Sections</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                                <!--begin::Stat-->
                                <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                    <!--begin::Number-->
                                    <div class="d-flex align-items-center">
                                        <i class="ki-duotone ki-arrow-up fs-3 text-success me-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <div class="fs-2 fw-bold" data-kt-countup="true" data-kt-countup-value="60" data-kt-countup-prefix="%">0</div>
                                    </div>
                                    <!--end::Number-->
                                    <!--begin::Label-->
                                    <div class="fw-semibold fs-6 text-gray-400">Success Rate</div>
                                    <!--end::Label-->
                                </div>
                                <!--end::Stat-->
                            </div>
                            <!--end::Stats-->
                        </div>
                        <!--end::Wrapper-->
                        <!--begin::Progress-->
                        <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                            <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                <span class="fw-semibold fs-6 text-gray-400">Course Compleation</span>
                                <span class="fw-bold fs-6">50%</span>
                            </div>
                            <div class="h-5px mx-3 w-100 bg-light mb-3">
                                <div class="bg-success rounded h-5px" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        <!--end::Progress-->
                    </div>
                    <!--end::Stats-->
                </div>
                <!--end::Info-->
            </div>
            <!--end::Details-->

            <!--begin::Navs-->
            <!--begin::Navs-->
        </div>
    </div>
    <!--end::Navbar-->

    <!--begin::Card-->
    <div class="card card-flush">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin:::Tabs-->
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fw-semibold mb-15">
                
                <?php if (isset($permissions->courses_overview->read) && $permissions->courses_overview->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_overview" class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#kt_course_overview">
                    Overview</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

                <?php if (isset($permissions->courses_content->read) && $permissions->courses_content->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_content" class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_course_content">
                    Course Content</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

                <?php if (isset($permissions->courses_instructor->read) && $permissions->courses_instructor->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_instructor" class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_course_instructor">
                    Instructor</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

                <?php if (isset($permissions->courses_review->read) && $permissions->courses_review->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_reviews" class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_course_reviews">
                    Reviews</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

                <?php if (isset($permissions->courses_follower->read) && $permissions->courses_follower->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_followers" class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_course_followers">
                    Followers</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

                <?php if (isset($permissions->courses_activity->read) && $permissions->courses_activity->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_activity" class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_course_activity">
                    Activity</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

                <?php if (isset($permissions->courses_settings->read) && $permissions->courses_settings->read) { ?>
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a id="navigator_course_settings" class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#kt_course_settings">
                    Settings</a>
                </li>
                <!--end:::Tab item-->
                <?php } ?>

            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">

                <?php if (isset($permissions->courses_overview->read) && $permissions->courses_overview->read) { ?>
                <!-- begin:::Tab pane show active -->
                <div class="tab-pane fade" id="kt_course_overview" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_overview') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>

                <?php if (isset($permissions->courses_content->read) && $permissions->courses_content->read) { ?>
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_course_content" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_content') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>

                <?php if (isset($permissions->courses_instructor->read) && $permissions->courses_instructor->read) { ?>
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_course_instructor" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_instructor') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>

                <?php if (isset($permissions->courses_review->read) && $permissions->courses_review->read) { ?>
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_course_reviews" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_reviews') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>

                <?php if (isset($permissions->courses_follower->read) && $permissions->courses_follower->read) { ?>
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_course_followers" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_followers') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>

                <?php if (isset($permissions->courses_activity->read) && $permissions->courses_activity->read) { ?>
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_course_activity" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_activity') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>

                <?php if (isset($permissions->courses_settings->read) && $permissions->courses_settings->read) { ?>
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="kt_course_settings" role="tabpanel">
                    <?= $this->include('modules/libraries/courses/viewTab_settings') ?>
                </div>
                <!--end:::Tab pane-->
                <?php } ?>
                
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
    
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<?= $this->endSection() ?>


<?= $this->section('custommodals') ?>
<!--begin::Custom Modal(used for this page only)-->
<?= $this->include('modules/libraries/courses/modals/view_content') ?>
<?= $this->include('modules/libraries/courses/modals/add_section') ?>
<?= $this->include('modules/libraries/courses/modals/edit_section') ?>
<?= $this->include('modules/libraries/courses/modals/add_content') ?>
<?= $this->include('modules/libraries/courses/modals/edit_content') ?>
<!--end::Custom Modal-->
<?= $this->endSection() ?>


<?= $this->section('customscripts') ?>
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/vendor/jquery-3.7.0.min.js"></script>
<script src="assets/js/custom/courses/course_view.js"></script>
<!--end::Custom Javascript-->
<?= $this->endSection() ?>