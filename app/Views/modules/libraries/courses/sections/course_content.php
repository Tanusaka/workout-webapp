<div id="course_content" class="course-section-wrapper">
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Course Content</span>
        </h3>
        
        <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
        <div class="card-toolbar">
            <button id="btn_openModalAddSection" type="button" class="form-action-btn justify-content-end" tabindex="-1">Add Section</button>
        </div>
        <?php endif; ?>	

    </div>

    <div class="card-body border-0 pt-5">
        
        <div id="accordion">
        <?php if (isset($course->sections)): ?>   
        <?php foreach ($course->sections as $section): ?>
            <div id="<?= 'accordion-group-'.$section->id ?>" class="group" data-section-id="<?= $section->id ?>">
                <h3 id="<?= 'accordion-group-title-'.$section->id ?>"><?=$section->sectionname?></h3>
                <div>  
                    <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
                    <div class="card-header border-0">
                        <h3 class="card-title align-items-start flex-column"></h3>
                        <div class="card-toolbar">
                            <button data-sectionid="<?= $section->id ?>" type="button" class="btn_openModalAddLesson form-action-btn justify-content-end" tabindex="-1">Add Lesson</button>
                            <button data-sectionid="<?= $section->id ?>" type="button" class="btn_openModalEditSection form-action-btn justify-content-end" tabindex="-1">Edit Section</button>
                            <button data-sectionid="<?= $section->id ?>" type="button" class="btn_deleteSection form-action-btn justify-content-end" tabindex="-1">Delete Section</button>
                        </div>
                    </div>
                    <?php endif; ?>	 

                    <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
                    <ul id="<?= 'sortable-left-'.$section->id ?>" class="connectedSortable sortable update-sortable" data-list-id="<?= $section->id ?>">
                    <?php else: ?>	 
                    <ul id="<?= 'sortable-left-'.$section->id ?>" class="connectedSortable sortable" data-list-id="<?= $section->id ?>">
                    <?php endif; ?>	 
                        <?php if (isset($section->lessons)): ?>
                        <?php foreach ($section->lessons as $index=>$lesson): ?>   
                        <li id="<?= 'sortable-left-item-'.$lesson->id ?>" data-item-id="<?= $lesson->id ?>" class="sortable-item">
                            
                            <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
                                <span class="draggable"></span>
                            <?php endif; ?>	 
                            
                    
                            <div class="d-flex bd-highlight">
                                <div class="p-2 flex-grow-1 bd-highlight">
                                    <div class="d-flex align-items-center">
                                        <div class="flex-shrink-0">

                                        <?php if ($lesson->type=='image') : ?>
                                            <span><i class="fas fa-image fa-fw me-4"></i></span>
                                        <?php elseif ($lesson->type=='video') : ?>
                                            <span><i class="fas fa-video fa-fw me-4"></i></span>
                                        <?php else : ?>
                                            <span></span>
                                        <?php endif; ?>

                                        </div>
                                        <div class="flex-grow-1 ms-3">
                                            <?php if (isset($course->isEnrolled)) : ?>
                                                <?php if ($course->isEnrolled) : ?>
                                                    <a data-lessonid="<?= $lesson->id ?>" id="<?= 'dsp_lessonname_'.$lesson->id ?>" class="btn_openModalViewLesson btn-link"><?=$lesson->lessonname?></a>                
                                                <?php else: ?>       
                                                    <span><?=$lesson->lessonname?></span>
                                                <?php endif; ?>
                                            <?php else: ?>
                                                <a data-lessonid="<?= $lesson->id ?>" id="<?= 'dsp_lessonname_'.$lesson->id ?>" class="btn_openModalViewLesson btn-link"><?=$lesson->lessonname?></a>                
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-2 bd-highlight">
                                    <span id="<?= 'dsp_lessonduration_'.$lesson->id ?>" class="align-middle"><?= $lesson->lessonduration ?></span>
                                </div>
                                
                            </div>

                            <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
                            <div class="d-flex justify-content-end bd-highlight mb-3">
                                <div><a data-lessonid="<?= $lesson->id ?>" class="btn_openModalEditLesson profile-action-btn">Edit</a></div>
                                <div><a data-lessonid="<?= $lesson->id ?>" class="btn_deleteLesson profile-action-btn">Delete</a></div>
                            </div>
                            <?php endif; ?>	

                        </li>

                        <?php endforeach; ?>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        <?php endforeach; ?>
        <?php endif; ?>
        </div>

    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
<?= $this->include('modules/libraries/courses/modals/addsection') ?>
<?= $this->include('modules/libraries/courses/modals/editsection') ?>
<?= $this->include('modules/libraries/courses/modals/deletesection') ?>
<?= $this->include('modules/libraries/courses/modals/addlesson') ?>
<?= $this->include('modules/libraries/courses/modals/editlesson') ?>
<?= $this->include('modules/libraries/courses/modals/deletelesson') ?>
<?php endif; ?>


<?= $this->include('modules/libraries/courses/modals/viewlesson') ?>