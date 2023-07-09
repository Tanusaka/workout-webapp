<?= $this->extend('layouts/appLayout') ?>

<?= $this->section('content') ?>
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Create Course</h1>
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
                <li class="breadcrumb-item text-muted">Create</li>
                <!--end::Item-->
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->

        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->
<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Form-->
        <form class="w-100 mw-600px pt-15 pb-10" novalidate="novalidate" id="kt_create_course_form" action="">
            <!--begin::Step 1-->
            <div class="current" data-kt-stepper-element="content">
                <!--begin::Wrapper-->
                <div class="w-100">
                    <!--begin::Heading-->
                    <div class="pb-10 pb-lg-15">
                        <!--begin::Title-->
                        <h2 class="fw-bold d-flex align-items-center text-dark">Setup Course Details
                        <span class="ms-1" data-bs-toggle="tooltip" title="Course name will be used as reference within your course reports">
                            <i class="ki-duotone ki-information-5 text-gray-500 fs-6">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                            </i>
                        </span></h2>
                        <!--end::Title-->
                        <!--begin::Notice-->
                        <div class="text-muted fw-semibold fs-6">If you need more info, please check out
                        <a href="#" class="link-primary fw-bold">Help Page</a>.</div>
                        <!--end::Notice-->
                    </div>
                    <!--end::Heading-->


                    <!--begin::Label-->
                    <label class="required form-label mb-3">Cover Image</label>
                    <!--end::Label-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Dropzone-->
                        <div class="dropzone img-dropzone-wrapper" id="kt_crt_courseimage">
                            <!--begin::Message-->
                            <div class="dz-message needsclick">
                                <!--begin::Icon-->
                                <i class="ki-duotone ki-file-up fs-3hx text-primary">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                                <!--end::Icon-->
                                <!--begin::Info-->
                                <div class="ms-4">
                                    <h3 class="fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                    <span class="fw-semibold text-muted">Allowed Formats: MP4</span>
                                </div>
                                <!--end::Info-->
                            </div>
                        </div>
                        <!--end::Dropzone-->

                        <!--Begin::Input Hidden-->
                        <div class="inp-hidden">
                            <!--begin::Input-->
                            <input type="hidden" class="inp-hidden-txt" name="crt_courseimage" placeholder="" value="">
                            <!--end::Input-->
                        </div>
                        <!--end::Input Hidden-->

                    </div>
                    <!--end::Input group-->




                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Course Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid" name="course_name" placeholder="Type a name for this course..." value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Course Intro</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" class="form-control form-control-lg form-control-solid" name="course_intro" placeholder="Type a breif introduction for this course..." value="" />
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="required fw-semibold fs-6 mb-5">Course Type</label>
                        <!--end::Label-->
                        <!--begin::Course Type-->
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="course_type" type="radio" value="basic" id="kt_course_type_option_0" checked='checked' />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_course_type_option_0">
                                    <div class="fw-bold text-gray-800">Basic</div>
                                    <div class="text-gray-600">Courses best suited for beginners</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <div class='separator separator-dashed my-5'></div>
                        <!--begin::Input row-->
                        <div class="d-flex fv-row">
                            <!--begin::Radio-->
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input-->
                                <input class="form-check-input me-3" name="course_type" type="radio" value="advanced" id="kt_course_type_option_1" />
                                <!--end::Input-->
                                <!--begin::Label-->
                                <label class="form-check-label" for="kt_course_type_option_1">
                                    <div class="fw-bold text-gray-800">Advanced</div>
                                    <div class="text-gray-600">Courses best suited for professionals</div>
                                </label>
                                <!--end::Label-->
                            </div>
                            <!--end::Radio-->
                        </div>
                        <!--end::Input row-->
                        <div class='separator separator-dashed my-5'></div>
                        <!--end::Course Type-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10 fv-row">
                        <!--begin::Label-->
                        <label class="required form-label mb-3">Description</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <textarea name="course_description" id="" cols="30" rows="10" class="form-control form-control-lg form-control-solid" placeholder="Type something about this course..."></textarea>
                        <!--end::Input-->
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
                    <button type="submit" id="kt_create_course_submit" class="btn btn-lg btn-primary">
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
    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->

<?= $this->endSection() ?>


<?= $this->section('customscripts') ?>
<!--begin::Custom Javascript(used for this page only)-->
<script src="assets/js/vendor/jquery-3.7.0.min.js"></script>
<script src="assets/js/custom/courses/course_create.js"></script>
<!--end::Custom Javascript-->
<?= $this->endSection() ?>