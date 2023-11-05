<!-- begin: section container -->
<div id="pagedata-container" class="container" style="margin-top: 15px;" data-pid="0">	

    <div class="page-alert">
        <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
            <div id="alertmessage"></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>


    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column">
                    
                    <form id="form-createcourse" action="" class="">
                
                        <div class="form-alert">
                        <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
                            <div id="alertmessage"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </div>
                    
                    
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate fw-sb fs-12 fc-dark">Course Information</p>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Name:</label>
                            <input id="coursename" class="form-control ap-inp-field" placeholder="Type a name for your course..." name="coursename" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                            <label id="coursename_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Intro:</label>
                            <input id="courseintro" class="form-control ap-inp-field" placeholder="Type a brief introduction about your course..." name="courseintro" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="">
                            <label id="courseintro_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>

                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Description:</label>
                            <textarea name="description_RTE" id="description_RTE" class="form-control form-control-lg form-control-solid" style="min-width: 100%" placeholder="Type something about this course..."></textarea>  
                            <label id="description_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>
                        
                    
                        <div class="top-gap-15"></div>
                    
                        
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate fw-sb fs-12 fc-dark">Basic Information</p>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Level:</label>
                            <select id="courselevel" name="courselevel" aria-label="Select level for this course..." data-control="select2" data-placeholder="Select level for this course..." class="form-select">
                                <option></option>
                                <option value="BL">Beginner Level</option>     
                                <option value="IL">Intermediate Level</option>      
                                <option value="EL">Expert Level</option>    
                                <option value="AL">Any Level</option>                 
                            </select>
                            
                            <label id="courselevel_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>

                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Type:</label>
                            <select id="coursetype" name="coursetype" aria-label="Select type of this course..." data-control="select2" data-placeholder="Select type of this course..." class="form-select">
                                <option></option>
                                <option value="FC">Free Course</option>     
                                <option value="PC">Paid Course</option>                     
                            </select>
                            
                            <label id="coursetype_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>

                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Course Image:</label>
                            
                            <div class="row">
                                <div class="col-6">
                                    <!--begin::Dropzone-->
                                    <div class="dropzone img-dropzone-wrapper" id="dz_courseimage">
                                        <!--begin::Message-->
                                        <div class="dz-message needsclick">
                                            <!--begin::Icon-->
                                            <i class="ki-duotone ki-file-up fs-3hx text-primary">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                            <!--end::Icon-->
                                            <!--begin::Info-->
                                            <div class="ms-4">
                                                <h4 class="fw-bold text-gray-900 mb-1 fs-14">Drop files here or click to upload.</h4>
                                                <span class="fw-semibold text-muted">Allowed Formats: jpeg, jpg, png</span>
                                            </div>
                                            <!--end::Info-->
                                        </div>
                                    </div>
                                    <!--end::Dropzone-->
                                    <div class="inp-hidden">
                                        <!--begin::Input-->
                                        <input id="courseimage" type="hidden" class="inp-hidden-txt" name="courseimage" placeholder="" value="">
                                        <!--end::Input-->
                                    </div>
                                </div>
                                <div class="col-6">
                                    <p class="align-middle">Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg or .png. no text on the image.</p>
                                </div>
                            </div>
                            
                            <label id="courseimage_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>


                        
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Instructor Profile:</label>
                            
                            <?php if (isset($instructors->current_instructor) && !is_null($instructors->current_instructor)) : ?>
                            
                                <select id="instructorprofile" data-disabled="true" name="instructorprofile" aria-label="Select instructor of this course..." data-control="select2" data-placeholder="Select instructor of this course.." class="form-select" disabled>
                                    <option></option>
                                    <?php foreach ($instructors->all_instructors as $instructor) : ?>
                                        <?php if ($instructor->id == $instructors->current_instructor->id): ?>
                                            <option selected value="<?= $instructor->id ?>"><?= $instructor->firstname.' '.$instructor->lastname ?></option>     
                                        <?php else: ?>
                                            <option value="<?= $instructor->id ?>"><?= $instructor->firstname.' '.$instructor->lastname ?></option>     
                                        <?php endif; ?>
                                        
                                    <?php endforeach; ?>                     
                                </select>

                            <?php else: ?>
                                <select id="instructorprofile" data-disabled="false" name="instructorprofile" aria-label="Select instructor of this course..." data-control="select2" data-placeholder="Select instructor of this course.." class="form-select">
                                    <option></option>
                                    <?php foreach ($instructors->all_instructors as $instructor) : ?>
                                        <option value="<?= $instructor->id ?>"><?= $instructor->firstname.' '.$instructor->lastname ?></option>     
                                    <?php endforeach; ?>                     
                                </select>
                            <?php endif; ?>
                            
                            
                            <label id="instructorprofile_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>


                    
                        <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
                            <button id="btn_saveCourse" type="button" class="form-action-btn">Save Course</a>
                        </div>
                    
                    </form>


                </div>
            </div>
        </div>
    </div>

</div>
<!-- end: section container -->

