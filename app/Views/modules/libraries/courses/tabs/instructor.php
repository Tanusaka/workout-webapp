<!--begin::Tab Instructor-->
<!--begin::Course Instructor Wrapper-->
<div class="course_content_wrapper col-md-6">
    <!--begin::Course Instructor Header-->
    <div id="kt_course_instructor_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Instructors</span>
                <span id="kt_course_instructor_tagline" class="text-muted mt-1 fw-semibold fs-7"></span>
            </h3>

            <?php if (isset($permissions->courses_instructor->write) && $permissions->courses_instructor->write) { ?>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a instructor" data-kt-initialized="1">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_addinstructor">
                <i class="ki-duotone ki-plus fs-2"></i>Add Instructor</a>
            </div>
            <?php } ?>

        </div>
    </div>
    <!--end::Course Instructor Header-->

    <!--begin::Course Instructor Body-->
    <div id="kt_course_instructor_body">


    </div>
    <!--end::Course Instructor Body-->
</div>
<!--end::Course Instructor Wrapper-->
<!--end::Tab Instructor-->