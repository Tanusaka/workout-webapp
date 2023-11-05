<!--begin::Row-->
<div class="row g-6 g-xl-9">
<?php if (isset($permissions->course_management) && $permissions->course_management) : ?>
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
                        <img src="<?= $course->courseimage ?>" alt="image" class="p-3" />
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

                <!--end::Info-->
                <!--begin::Progress-->

                <!--end::Progress-->
                <!--begin::Users-->

                <!--end::Users-->
            </div>
            <!--end:: Card body-->
        </a>
        <!--end::Card-->
    </div>
    <!--end::Col-->
    <?php endforeach; ?>
<?php endif; ?>		
</div>
<!--end::Row-->

<!--begin::Pagination-->
<!-- <div class="d-flex flex-stack flex-wrap pt-10">
<div class="fs-6 fw-semibold text-gray-700">Showing 1 to 10 of 50 entries</div> -->
<!--begin::Pages-->
<!-- <ul class="pagination">
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
</ul> -->
<!--end::Pages-->
<!-- </div> -->
<!--end::Pagination-->