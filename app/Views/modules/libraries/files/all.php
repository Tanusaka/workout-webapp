<div class="page-alert">
    <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
        <div id="alertmessage"></div>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>

<!--begin::Row-->
<div class="row">


<!-- begin: section container -->
<div id="file_controls" class="container-fluid page-option-wrapper d-none" style="margin-top: 15px;">
    <div class="d-flex bd-highlight px8-py16">
        <div class="">
            <span class="profile-action-btn"><input type="checkbox" class="cbox-pos-r" id="cbx_sall"> Select All<span id="imgselect_count"><?= '(0/'.count($files).')'  ?></span></span>
        </div>
        <?php if (isset($permissions->file_delete) && $permissions->file_delete) : ?>
        <div class="">
            <span id="btn_deleteFile" class="profile-action-btn">Delete</span>
        </div>
        <?php endif; ?>	
        <!-- <div class="ms-auto">
            <span id="btn_dlt_media" class="profile-action-btn">
            <i class="ki-duotone ki-filter-tick pos-rel-top-2">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>    
            Filters</span>
        </div> -->
    </div>
</div>
<!-- end: section container -->


<!-- begin: section container -->
<div class="container-fluid" style="margin-top: 15px;">	

    <div id="file_container" class="row">
        <?php if (isset($permissions->file_view) && $permissions->file_view) : ?>
        <?php if (isset($files) && !empty($files)) : ?>
        <?php foreach($files as $file): ?>
        <div id="<?= 'm-item-'.$file->id ?>" class="col-sm-2 col-md-2 m-item" data-mpath="<?=$file->path?>">
            <div class="custom-control custom-checkbox image-checkbox img-thumb-preview">
                <input type="checkbox" class="multiple-cbox cbx_s custom-control-input" data-mid="<?= $file->id ?>" id="<?= 'img_cbx_'.$file->id ?>">
                <label class="custom-control-label" for="<?= 'img_cbx_'.$file->id ?>">
                    

                    <?php if ($file->type=='image') : ?>
                        <img src="<?=$file->path?>" alt="#" class="img-fluid">
                    <?php elseif ($file->type=='video') : ?>
                        <div class="ratio ratio-16x9">
                            <iframe src="<?=$file->path?>" title="<?=$file->type?>" allowfullscreen sandbox></iframe>
                        </div>
                    <?php else : ?>
                        <span></span>
                    <?php endif; ?>


                </label>
                <div class="media-g-txt-container">
                    <p href="#" class="text-truncate fw-normal fs-12 fc-dark mb-0"><?= $file->name ?></p>
                    <p href="#" class="text-truncate fw-normal fs-10 fc-light mb-0"><?= $file->createdat.' '.$file->createdby ?></p>
                    <p href="#" class="text-truncate fw-normal fs-10 fc-light mb-0"><?= $file->size.' MB' ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<!-- end: section container -->

</div>
<!--end::Row-->

<?= $this->section('custommodals') ?>
<!--begin::Custom Modal(used for this page only)-->
<?php if (
(isset($pageid) && $pageid=='all') &&
(isset($permissions->file_create) && $permissions->file_create)) : ?>
<?= $this->include('modules/libraries/files/modals/addfile') ?>
<?php endif; ?>
<!--end::Custom Modal-->
<?= $this->endSection() ?>