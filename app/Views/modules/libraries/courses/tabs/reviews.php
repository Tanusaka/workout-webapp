<!--begin::Tab Review-->
<!--begin::Course Review Wrapper-->
<div class="course_content_wrapper col-md-6">
    <!--begin::Course Review Header-->
    <div id="kt_course_review_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Reviews</span>
                <span id="kt_course_review_tagline" class="text-muted mt-1 fw-semibold fs-7"></span>
            </h3>

            <?php if (isset($permissions->courses_review->write) && $permissions->courses_review->write) { ?>
            <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" data-bs-original-title="Click to add a review" data-kt-initialized="1">
                <a href="#" class="btn btn-sm btn-light btn-active-primary" data-bs-toggle="modal" data-bs-target="#kt_modal_addreview">
                <i class="ki-duotone ki-plus fs-2"></i>Add Review</a>
            </div>
            <?php } ?>

        </div>
    </div>
    <!--end::Course Review Header-->

    <!--begin::Course Review Body-->
    <div id="kt_course_review_body">


    </div>
    <!--end::Course Review Body-->
</div>
<!--end::Course Review Wrapper-->
<!--end::Tab Review-->