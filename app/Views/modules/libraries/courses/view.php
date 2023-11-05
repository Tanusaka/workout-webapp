<!-- begin: section container -->
<div id="pagedata-container" class="container" style="margin-top: 15px;" data-pid="<?= $course->id ?>">	

    <div class="page-alert">
        <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
            <div id="alertmessage"></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="row">
       
        <div class="col-md-9 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        
                        <?= $this->include('modules/libraries/courses/sections/course_header') ?>

                        <?= $this->include('modules/libraries/courses/sections/course_description') ?>

                        <?= $this->include('modules/libraries/courses/sections/course_content') ?>

                        <?= $this->include('modules/libraries/courses/sections/course_instructor') ?>
                        
                    </div>
                </div>
            </div>
        </div> 

        <div class="col-md-3 col-lg-3">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex flex-center flex-column mb-3">
                        
                        <div class="profile-img mb-4">
                            <img id="dsp_couseimage" src="<?= $course->courseimage ?>" alt="image">
                        </div>

                    </div>

                    <div class="d-flex flex-column mb-3">
                        
                    <?= $this->include('modules/libraries/courses/sections/course_enrollment') ?>

                    </div>

                </div>
            </div>
        </div> 

    </div>
</div>
<!-- begin: section container -->

