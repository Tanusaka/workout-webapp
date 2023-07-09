<?= $this->extend('layouts/appLayout') ?>

<?= $this->section('content') ?>
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">Courses</h1>
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
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->
        <!--begin::Actions-->
		<?php if (isset($permissions->courses->write) && $permissions->courses->write) { ?>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <!-- <a href="#" class="btn btn-sm fw-bold btn-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_create_app">Add Course</a> -->
            <a href="libraries\courses\create" class="btn btn-sm fw-bold btn-primary">Add Course</a>
            <!--end::Primary button-->
        </div>
		<?php } ?>
        <!--end::Actions-->
    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->

<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">
        <!--begin::Stats-->
        <div class="row g-6 g-xl-9">
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Card-->
                <div class="card h-100">
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Heading-->
                        <div class="fs-2hx fw-bold">237</div>
                        <div class="fs-4 fw-semibold text-gray-400 mb-7">Current Courses</div>
                        <!--end::Heading-->
                        <!--begin::Wrapper-->
                        <div class="d-flex flex-wrap">
                            <!--begin::Chart-->
                            <div class="d-flex flex-center h-100px w-100px me-9 mb-5">
                                <canvas id="kt_project_list_chart"></canvas>
                            </div>
                            <!--end::Chart-->
                            <!--begin::Labels-->
                            <div class="d-flex flex-column justify-content-center flex-row-fluid pe-11 mb-5">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                    <div class="bullet bg-primary me-3"></div>
                                    <div class="text-gray-400">Basic</div>
                                    <div class="ms-auto fw-bold text-gray-700">30</div>
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-semibold align-items-center mb-3">
                                    <div class="bullet bg-success me-3"></div>
                                    <div class="text-gray-400">Advanced</div>
                                    <div class="ms-auto fw-bold text-gray-700">45</div>
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Budget-->
                <div class="card h-100">
                    <div class="card-body p-9">
                        <div class="fs-2hx fw-bold">$3,290.00</div>
                        <div class="fs-4 fw-semibold text-gray-400 mb-7">Course Finance</div>
                        <div class="fs-6 d-flex justify-content-between mb-4">
                            <div class="fw-semibold">Avg. Course Budget</div>
                            <div class="d-flex fw-bold">
                            <i class="ki-duotone ki-arrow-up-right fs-3 me-1 text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>$6,570</div>
                        </div>
                        <div class="separator separator-dashed"></div>
                        <div class="fs-6 d-flex justify-content-between my-4">
                            <div class="fw-semibold">Lowest Course Check</div>
                            <div class="d-flex fw-bold">
                            <i class="ki-duotone ki-arrow-down-left fs-3 me-1 text-danger">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>$408</div>
                        </div>
                        <div class="separator separator-dashed"></div>
                        <div class="fs-6 d-flex justify-content-between mt-4">
                            <div class="fw-semibold">Ambassador Page</div>
                            <div class="d-flex fw-bold">
                            <i class="ki-duotone ki-arrow-up-right fs-3 me-1 text-success">
                                <span class="path1"></span>
                                <span class="path2"></span>
                            </i>$920</div>
                        </div>
                    </div>
                </div>
                <!--end::Budget-->
            </div>
            <div class="col-lg-6 col-xxl-4">
                <!--begin::Clients-->
                <div class="card h-100">
                    <div class="card-body p-9">
                        <!--begin::Heading-->
                        <div class="fs-2hx fw-bold">49</div>
                        <div class="fs-4 fw-semibold text-gray-400 mb-7">Our Clients</div>
                        <!--end::Heading-->
                        <!--begin::Users group-->
                        <div class="symbol-group symbol-hover mb-9">
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Alan Warden">
                                <span class="symbol-label bg-warning text-inverse-warning fw-bold">A</span>
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michael Eberon">
                                <img alt="Pic" src="assets/media/avatars/300-11.jpg" />
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Michelle Swanston">
                                <img alt="Pic" src="assets/media/avatars/300-7.jpg" />
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Francis Mitcham">
                                <img alt="Pic" src="assets/media/avatars/300-20.jpg" />
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                                <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Melody Macy">
                                <img alt="Pic" src="assets/media/avatars/300-2.jpg" />
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Perry Matthew">
                                <span class="symbol-label bg-info text-inverse-info fw-bold">P</span>
                            </div>
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Barry Walter">
                                <img alt="Pic" src="assets/media/avatars/300-12.jpg" />
                            </div>
                            <a href="#" class="symbol symbol-35px symbol-circle" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                <span class="symbol-label bg-dark text-gray-300 fs-8 fw-bold">+42</span>
                            </a>
                        </div>
                        <!--end::Users group-->
                        <!--begin::Actions-->
                        <div class="d-flex">
                            <a href="#" class="btn btn-primary btn-sm me-3" data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">All Clients</a>
                        </div>
                        <!--end::Actions-->
                    </div>
                </div>
                <!--end::Clients-->
            </div>
        </div>
        <!--end::Stats-->
        <!--begin::Toolbar-->
        <div class="d-flex flex-wrap flex-stack my-5">
            <!--begin::Heading-->
            <h2 class="fs-2 fw-semibold my-2">Basic Courses</h2>
            <!--end::Heading-->
            <!--begin::Controls-->
            <!-- <div class="d-flex flex-wrap my-1"> -->
                <!--begin::Select wrapper-->
                <!-- <div class="m-0"> -->
                    <!--begin::Select-->
                    <!-- <select name="status" data-control="select2" data-hide-search="true" class="form-select form-select-sm bg-body border-body fw-bold w-125px">
                        <option value="Active" selected="selected">Active</option>
                        <option value="Approved">In Progress</option>
                        <option value="Declined">To Do</option>
                        <option value="In Progress">Completed</option>
                    </select> -->
                    <!--end::Select-->
                <!-- </div> -->
                <!--end::Select wrapper-->
            <!-- </div> -->
            <!--end::Controls-->
        </div>
        <!--end::Toolbar-->
        <!--begin::Row-->
        <div class="row g-6 g-xl-9">
		<?php if (isset($permissions->courses->read) && $permissions->courses->read) { ?>
            <?php foreach($courses as $course): ?>
            <!--begin::Col-->
            <div class="col-md-6 col-xl-4">
                <!--begin::Card-->
                <a href="<?php echo "libraries/courses/view/".$course->id; ?>" class="card border-hover-primary">
                    <!--begin::Card header-->
                    <div class="card-header border-0 pt-9">
                        <!--begin::Card Title-->
                        <div class="card-title m-0">
                            <!--begin::Avatar-->
                            <div class="">
                                <img src="<?php echo $course->coursemediapath; ?>" alt="image" class="p-3" />
                            </div>
                            <!--end::Avatar-->
                        </div>
                        <!--end::Car Title-->
                    </div>
                    <!--end:: Card header-->
                    <!--begin:: Card body-->
                    <div class="card-body p-9">
                        <!--begin::Name-->
                        <div class="fs-3 fw-bold text-dark"><?php echo $course->coursename; ?></div>
                        <!--end::Name-->
                        <!--begin::Description-->
                        <p class="text-gray-400 fw-semibold fs-5 mt-1 mb-7"><?php echo $course->courseintro; ?></p>
                        <!--end::Description-->
                        <!--begin::Info-->
                        <div class="d-flex flex-wrap mb-5">
                            <!--begin::Due-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-7 mb-3">
                                <div class="fs-6 text-gray-800 fw-bold">Oct 25, 2023</div>
                                <div class="fw-semibold text-gray-400">Published Date</div>
                            </div>
                            <!--end::Due-->
                            <!--begin::Budget-->
                            <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 mb-3">
                                <div class="fs-6 text-gray-800 fw-bold">$284,900.00</div>
                                <div class="fw-semibold text-gray-400">Budget</div>
                            </div>
                            <!--end::Budget-->
                        </div>
                        <!--end::Info-->
                        <!--begin::Progress-->
                        <div class="h-4px w-100 bg-light mb-5" data-bs-toggle="tooltip" title="This Course 50% completed">
                            <div class="bg-primary rounded h-4px" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <!--end::Progress-->
                        <!--begin::Users-->
                        <div class="symbol-group symbol-hover">
                            <!--begin::User-->
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Emma Smith">
                                <img alt="Pic" src="assets/media/avatars/300-6.jpg" />
                            </div>
                            <!--begin::User-->
                            <!--begin::User-->
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Rudy Stone">
                                <img alt="Pic" src="assets/media/avatars/300-1.jpg" />
                            </div>
                            <!--begin::User-->
                            <!--begin::User-->
                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="Susan Redwood">
                                <span class="symbol-label bg-primary text-inverse-primary fw-bold">S</span>
                            </div>
                            <!--begin::User-->
                        </div>
                        <!--end::Users-->
                    </div>
                    <!--end:: Card body-->
                </a>
                <!--end::Card-->
            </div>
            <!--end::Col-->
            <?php endforeach; ?>
		<?php } ?>		
        </div>
        <!--end::Row-->


        <!--begin::Pagination-->
        <div class="d-flex flex-stack flex-wrap pt-10">
            <div class="fs-6 fw-semibold text-gray-700">Showing 1 to 10 of 50 entries</div>
            <!--begin::Pages-->
            <ul class="pagination">
                <li class="page-item previous">
                    <a href="#" class="page-link">
                        <i class="previous"></i>
                    </a>
                </li>
                <li class="page-item active">
                    <a href="#" class="page-link">1</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">2</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">3</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">4</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">5</a>
                </li>
                <li class="page-item">
                    <a href="#" class="page-link">6</a>
                </li>
                <li class="page-item next">
                    <a href="#" class="page-link">
                        <i class="next"></i>
                    </a>
                </li>
            </ul>
            <!--end::Pages-->
        </div>
        <!--end::Pagination-->



        <!--begin::Modals-->

        <!--end::Modals-->


    </div>
    <!--end::Content container-->
</div>
<!--end::Content-->
<?= $this->endSection() ?>


<?= $this->section('customscripts') ?>
<!--begin::Custom Javascript-Courses -->
<script src="assets/js/custom/apps/projects/list/list.js"></script>
<!--end::Custom Javascript-Courses -->
<?= $this->endSection() ?>