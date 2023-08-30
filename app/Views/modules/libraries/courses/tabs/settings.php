<!--begin::Tab Settings-->
<!--begin::Course Settings Wrapper-->
<div class="course_content_wrapper col-md-6">
    <!--begin::Course Settings Header-->
    <div id="kt_course_settings_header">
        <div class="card-header border-0 p-0 mb-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Course Settings</span>
                <span id="kt_course_settings_tagline" class="text-muted mt-1 fw-semibold fs-7">Change settings of this course</span>
            </h3>
        </div>
    </div>
    <!--end::Course Settings Header-->

    <!--begin::Course Settings Body-->
    <div id="kt_course_settings_body">

        <?php if (isset($permissions->courses->write) && $permissions->courses->write) { ?>
        <?= $this->include('modules/libraries/courses/edit') ?>
        <?php } ?>

        <?php if (isset($permissions->courses->delete) && $permissions->courses->delete) { ?>
        <?= $this->include('modules/libraries/courses/delete') ?>
        <?php } ?>

    </div>
    <!--end::Course Settings Body-->
</div>
<!--end::Course Settings Wrapper-->
<!--end::Tab Settings-->