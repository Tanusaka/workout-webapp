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
        
        <!-- <div class="curriculum--curriculum-sub-header--m_N_0 mb-5">
            <div class="ud-text-sm" data-purpose="curriculum-stats">
                <span class="curriculum--content-length--5Nict">23 sections • 277 lectures • <span>
                    <span>14h&nbsp;47m</span> total length</span></span>
            </div>
        </div> -->

        
        <div id="course_content_accordion" class="accordion">
            
            <?php if (isset($course->sections)): ?>
            <?php foreach ($course->sections as $section): ?>
            <div id="<?= 'accordion_item_'.$section->id ?>" class="accordion-item" data-itemid="<?= $section->id ?>">
                <h2 id="<?= 'section_panel_'.$section->id ?>" class="accordion-header">
                <button id="<?= 'accordion_button_'.$section->id ?>" class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="<?= '#section_panel_collapse_'.$section->id ?>" aria-expanded="true" aria-controls="<?= 'section_panel_collapse_'.$section->id ?>">
                    <?= $section->sectionname ?>
                </button>
                </h2>
                <div id="<?= 'section_panel_collapse_'.$section->id ?>" class="accordion-collapse collapse show" aria-labelledby="<?= 'section_panel_'.$section->id ?>">
                    
                    <div class="card-header border-0 pt-0">
                        <h3 class="card-title align-items-start flex-column"></h3>
                        
                        <?php if (isset($permissions->course_update) && $permissions->course_update) : ?>
                        <div class="card-toolbar">
                            <button data-sectionid="<?= $section->id ?>" type="button" class="btn_openModalAddLesson form-action-btn justify-content-end" tabindex="-1">Add Lesson</button>
                            <button data-sectionid="<?= $section->id ?>" type="button" class="btn_openModalEditSection form-action-btn justify-content-end" tabindex="-1">Edit Section</button>
                            <button data-sectionid="<?= $section->id ?>" type="button" class="btn_openModalDeleteSection form-action-btn justify-content-end" tabindex="-1">Delete Section</button>
                        </div>
                        <?php endif; ?>	

                    </div>

                    
                    <div class="accordion-body">
                        <ul id="<?= 'lesson_group_'.$section->id ?>" class="list-group" data-sectionid="<?= $section->id ?>">
                            <?php if (isset($section->lessons)): ?>
                                <?php foreach ($section->lessons as $lesson): ?>
                                <li id="<?= 'lesson_item_'.$lesson->id ?>" class="list-group-item" data-lessonid="<?= $lesson->id ?>">

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
                                                    <?php if (isset($course->enrolled)) : ?>
                                                        <?php if ($course->enrolled == 'A') : ?>
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
                                        <div><a data-lessonid="<?= $lesson->id ?>" class="btn_openModalDeleteLesson profile-action-btn">Delete</a></div>
                                    </div>
                                    <?php endif; ?>	

                                </li>
                                <div id="<?= 'lesson_separator_'.$lesson->id ?>" class="separator separator-dashed col-md-12 my-5"></div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </ul>
                    </div>
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