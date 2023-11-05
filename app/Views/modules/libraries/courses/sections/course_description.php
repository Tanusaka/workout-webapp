<div id="course_description" class="course-section-wrapper">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Description</span>
        </h3>

        <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
        <div class="card-toolbar">
            <button id="btn_openModalEditDescription" type="button" class="form-action-btn justify-content-end" tabindex="-1">Change Description</button>
        </div>
        <?php endif; ?>	

    </div>

    <div class="card-body border-0 pt-5">
        <div id="dsp_coursedescription" data-purpose="safely-set-inner-html:description:description">
            <?= $this->renderString($course->coursedescription) ?>
        </div>    
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
<?= $this->include('modules/libraries/courses/modals/editdescription') ?>
<?php endif; ?>	