<div id="course_instructor" class="course-section-wrapper">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Instructor</span>
        </h3>
        
        <?php if (isset($permissions->course_update_instructor) && $permissions->course_update_instructor) : ?>
        <div class="card-toolbar">
        
        <?php if(isset($course->instructor)) : ?>
            <button data-instructorid="<?= $course->instructor->id ?>" id="btn_openModalEditInstructor" type="button" class="form-action-btn justify-content-end" tabindex="-1">Change Instructor</button>
        <?php else: ?>
            <button data-instructorid="0" id="btn_openModalEditInstructor" type="button" class="form-action-btn justify-content-end" tabindex="-1">Change Instructor</button>
        <?php endif; ?>
            
        </div>
        <?php endif; ?>

    </div>

    <?php if(isset($course->instructor)) : ?>
        <div id="instructor_card_body" class="card-body border-0 pt-5">
            
            <div id="card_body_content">

                <div class="profile-widget-header"> 
                    <div class="d-flex align-items-center">
                        <div class="symbol symbol-50px me-5">
                            <?php if ( isset($course->instructor->profileimage) && !is_null($course->instructor->profileimage) ) : ?>
                                <img id="dsp_instructorthumb" src="<?= $course->instructor->profileimage ?>" class="" alt="">
                            <?php else: ?>
                                <img id="dsp_instructorthumb" src="assets/images/avatar.png" class="" alt="">
                            <?php endif; ?>
                        </div>

                        <div class="flex-grow-1">
                            <a id="dsp_instructorname" href="#" class="text-gray-800 text-hover-primary fs-4 fw-bold"><?= $course->instructor->firstname.' '.$course->instructor->lastname ?></a>
                            <span id="dsp_instructoremail" class="text-gray-400 fw-semibold d-block"><?= $course->instructor->email ?></span>
                        </div>
                    </div>
                </div> 

                
                <div class="profile-widget-body">
                    <div id="dsp_instructordescription" class="fs-6">
                        <?php if (isset($course->instructor->description) && !is_null($course->instructor->description)) : ?>
                        <?= $this->renderString($course->instructor->description) ?>
                        <?php endif; ?>
                    </div>
                </div>

            </div>
            
        </div>
    <?php else: ?>
        <div id="instructor_card_body" class="card-body border-0 pt-5">
            <div id="card_body_message" class="fs-6">Instructor details cannot be found.</div>
        </div>
    <?php endif; ?>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<?php if (isset($permissions->course_update_instructor) && $permissions->course_update_instructor) : ?>
<?= $this->include('modules/libraries/courses/modals/editinstructor') ?>
<?php endif; ?>