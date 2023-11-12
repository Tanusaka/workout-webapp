<div id="course_enrollments" class="course-section-wrapper">

    <?php if (isset($permissions->course_enroll_users) && $permissions->course_enroll_users) : ?>
    <div class="separator separator-dashed col-md-12 my-15"></div>
    <h3 class="card-title align-items-start flex-column">
        <span class="card-label fw-bold text-dark fs-14">Course Enrollments</span>
    </h3>
    <div class="separator separator-dashed col-md-12 my-15"></div>

    <div id="enrollmentpreview_group" class="symbol-group symbol-hover d-flex justify-content-center">
        <?php if (isset($course->enrollments) && !empty($course->enrollments)) : ?>
            <?php foreach ($course->enrollments as $enrollment) : ?>
                <div class="symbol symbol-35px symbol-circle mt-2" data-bs-toggle="tooltip" aria-label="<?= $enrollment->firstname.' '.$enrollment->lastname ?>" data-bs-original-title="<?= $enrollment->firstname.' '.$enrollment->lastname ?>" data-kt-initialized="1">
                    <?php if ( isset($enrollment->profileimage) && !is_null($enrollment->profileimage) ) : ?>
                        <img alt="profileimage" src="<?= $enrollment->profileimage ?>">
                    <?php else: ?>
                        <span class="symbol-label bg-primary text-inverse-primary fw-bold"><?= strtoupper(substr($enrollment->firstname, 0, 1)); ?></span>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
            <span id="btn_openModalViewEnrollments" class="symbol-label fs-12 mt-2 text-wrap btn-link">&nbsp;&nbsp;View All...</span>
        <?php else: ?>
            <span class="symbol-label fs-12 mt-2 text-wrap btn-link">No data available in enrollments</span>
        <?php endif; ?>
    </div>

    <div class="separator separator-dashed col-md-12 my-15"></div>
    <div class="d-flex justify-content-center">
        <a id="btn_openModalAddEnrollment" class="btn btn-sm fw-bold btn-primary">Add Enrollment</a>
    </div>
    <div class="separator separator-dashed col-md-12 my-15"></div>
    
    <?php endif; ?>

    <?php if (isset($permissions->course_enroll) && $permissions->course_enroll) : ?>
    <div class="separator separator-dashed col-md-12 my-15"></div>
    <div class="d-flex justify-content-center">
    
    <?php if (isset($course->enrolled)) : ?>
        <?php if ($course->enrolled == 'A') : ?>
            <span><?= 'Enrolled Date: '.$course->enrolleddate ?></span>             
        <?php else: ?>       
            <a data-actionid="<?= $course->enrollmentid ?>" id="btn_enrollnow" class="btn btn-sm fw-bold btn-primary">Enroll Now</a>
        <?php endif; ?>               
    <?php endif; ?>          
        
        
        
    </div>
    <div class="separator separator-dashed col-md-12 my-15"></div>
    <?php endif; ?>
    

</div>

<?php if (isset($permissions->course_enroll_users) && $permissions->course_enroll_users) : ?>
<?= $this->include('modules/libraries/courses/modals/viewenrollments') ?>
<?= $this->include('modules/libraries/courses/modals/addenrollment') ?>
<?php endif; ?>