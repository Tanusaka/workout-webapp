<div id="course_enrollments" class="course-section-wrapper">

    <?php if (isset($permissions->course_enroll) && $permissions->course_enroll) : ?>
    <div class="d-flex justify-content-center mt-5">
    
    <?php if (isset($course->isEnrolled)) : ?>
        <?php if (!$course->isEnrolled) : ?>
            <a data-actionid="<?=$course->id?>" id="btn_openModalEnrollNow" class="btn btn-sm fw-bold btn-primary">Enroll Now</a>
        <?php endif; ?>               
    <?php endif; ?>          
        
    </div>
    <?php endif; ?>

    <?php if (isset($course->isEnrolled)) : ?>
        <?php if (!$course->isEnrolled) : ?>
            <?= $this->include('modules/libraries/courses/modals/enrollnow') ?>
        <?php endif; ?>               
    <?php endif; ?>   

</div>

  