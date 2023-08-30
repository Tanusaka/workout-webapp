<!--begin::Tab Follower-->
<!--begin::Course Follower Wrapper-->
<div class="course_content_wrapper col-md-6">
    <!--begin::Course Follower Header-->
    <div id="kt_course_follower_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Followers</span>
                <span id="kt_course_follower_tagline" class="text-muted mt-1 fw-semibold fs-7"></span>
            </h3>

            <?php if (isset($permissions->courses_follower->write) && $permissions->courses_follower->write) { ?>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a follower" data-kt-initialized="1">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_addfollower">
                <i class="ki-duotone ki-plus fs-2"></i>Add Follower</a>
            </div>
            <?php } ?>

        </div>
    </div>
    <!--end::Course Follower Header-->

    <!--begin::Course Follower Body-->
    <div id="kt_course_follower_body">


    </div>
    <!--end::Course Follower Body-->
</div>
<!--end::Course Follower Wrapper-->
<!--end::Tab Follower-->