<!--begin::Row-->
<div class="row">

<!-- begin: section container -->
<div class="container-fluid page-option-wrapper" style="margin-top: 15px;">
    <div class="d-flex bd-highlight px8-py16">
        <div class="">
            <span class="profile-action-btn"><input type="checkbox" class="cbox-pos-r" id="cbx_sall"> Select All<span id="imgselect_count">(0)</span></span>
        </div>
        <div class="">
            <span id="btn_dlt_media" class="profile-action-btn">Delete</span>
        </div>
        <div class="ms-auto">
            <span id="btn_dlt_media" class="profile-action-btn">
            <i class="ki-duotone ki-filter-tick pos-rel-top-2">
            <span class="path1"></span>
            <span class="path2"></span>
            </i>    
            Filters</span>
        </div>
    </div>
</div>
<!-- end: section container -->


<!-- begin: section container -->
<div class="container-fluid" style="margin-top: 15px;">	

    <div class="row">
        <?php if (isset($permissions->courses->read) && $permissions->courses->read) { ?>
        <?php foreach($media as $mediaitem): ?>
        <div id="<?= 'm-item-'.$mediaitem->id ?>" class="col-sm-2 col-md-2 m-item">
            <div class="custom-control custom-checkbox image-checkbox img-thumb-preview">
                <input type="checkbox" class="multiple-cbox cbx_s custom-control-input" data-mid="<?= $mediaitem->id ?>" id="<?= 'img_cbx_'.$mediaitem->id ?>">
                <label class="custom-control-label" for="<?= 'img_cbx_'.$mediaitem->id ?>">
                    <img src="<?= base_url($mediaitem->path.$mediaitem->name) ?>" alt="#" class="img-fluid">
                </label>
                <div class="media-g-txt-container">
                    <p href="#" class="text-truncate fw-normal fs-12 fc-dark mb-0"><?= $mediaitem->name ?></p>
                    <p href="#" class="text-truncate fw-normal fs-10 fc-light mb-0"><?= $mediaitem->createdat.' '.$mediaitem->createdby ?></p>
                    <p href="#" class="text-truncate fw-normal fs-10 fc-light mb-0"><?= $mediaitem->size.' MB' ?></p>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
        <?php } ?>	
    </div>
</div>
<!-- end: section container -->

</div>
<!--end::Row-->

<?= $this->section('custommodals') ?>
<!--begin::Custom Modal(used for this page only)-->
<?= $this->include('modules/libraries/media/modals/add_media') ?>

<!--end::Custom Modal-->
<?= $this->endSection() ?>