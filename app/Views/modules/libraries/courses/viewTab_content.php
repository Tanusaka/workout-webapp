<!--begin::Tab Content-->
<!--begin::Course Content Wrapper-->
<div class="course_content_wrapper col-md-6">
    <!--begin::Course Content Header-->
    <div id="kt_course_content_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Content</span>
                <span class="text-muted mt-1 fw-semibold fs-7">14 sections • 105 lectures • 4h 50m total length</span>
            </h3>

            <?php if (isset($permissions->courses_content->write) && $permissions->courses_content->write) { ?>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a section" data-kt-initialized="1">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#modal_addsection">
                <i class="ki-duotone ki-plus fs-2"></i>New Section</a>
            </div>
            <?php } ?>

        </div>
    </div>
    <!--end::Course Content Header-->

    <!--begin::Course Content Body-->
    <div id="kt_course_content_body">


    </div>
    <!--end::Course Content Body-->
</div>
<!--end::Course Content Wrapper-->
<!--end::Tab Content-->