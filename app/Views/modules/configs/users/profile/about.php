<div id="user_about" class="course-section-wrapper">
    <div class="card-header border-0">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">About</span>
        </h3>
        <!--begin::Toolbar-->
        <div class="card-toolbar">
        <?php if (isset($permissions->user_update_profile) && $permissions->user_update_profile) { ?>
            <?php if (isset($pageid) && $pageid=='myprofile') { ?>
                <button id="btn_openModalEditDescription" type="button" class="form-action-btn justify-content-end" tabindex="-1">Change Description</button>
            <?php } ?>
        <?php } ?>
        </div>
        <!--end::Toolbar-->
    </div>

    <div class="card-body border-0 pt-1">
        <div id="dsp_userabout" class="fs-6"></div>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<?php if (isset($permissions->user_update_profile) && $permissions->user_update_profile) { ?>
    <?php if (isset($pageid) && $pageid=='myprofile') { ?>
        <?= $this->include('modules/configs/users/modals/editdescription') ?>
    <?php } ?>
<?php } ?>
