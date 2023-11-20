<div id="course_header" class="course-section-wrapper">
    

<?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
    <div class="card-topbar border-0 pt-5 d-flex justify-content-end">
        <button id="btn_openModalEditSettings" type="button" class="form-action-btn" tabindex="-1">Settings</button>
    </div>
<?php endif; ?>		

    

    <div class="card-header border-0 pt-5">
        <h1 class="card-title align-items-start flex-column">
            <span id="dsp_coursename" class="card-label fw-bold text-dark"><?= $course->coursename ?></span>
            <span id="dsp_courseintro" class="text-muted mt-1 fw-semibold fs-7"><?= $course->courseintro ?></span>
        </h1>
    </div>
    
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
<?= $this->include('modules/libraries/courses/modals/editsettings') ?>
<?php endif; ?>	
