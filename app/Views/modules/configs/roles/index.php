<?= $this->extend('layouts/appLayout') ?>

<?= $this->section('content') ?>
<!--begin::Toolbar-->
<div id="kt_app_toolbar" class="app-toolbar py-3 py-lg-6">
    <!--begin::Toolbar container-->
    <div id="kt_app_toolbar_container" class="app-container container-xxl d-flex flex-stack">
        <!--begin::Page title-->
        <div class="page-title d-flex flex-column justify-content-center flex-wrap me-3">
            <!--begin::Title-->
            <h1 class="page-heading d-flex text-dark fw-bold fs-3 flex-column justify-content-center my-0">
                <?= $title; ?>
            </h1>
            <!--end::Title-->
            <!--begin::Breadcrumb-->
            <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1">

                <?php $count = 0; ?>
                <?php foreach ($breadcrumbs as $key => $value) { ?>
                    <!--begin::Item-->
                    <li class="breadcrumb-item text-muted">
                        
                        <?php if ($value != '') { ?>
                            <a  href="<?= $value; ?>" class="text-muted text-hover-primary"><?= $key; ?></a>
                        <?php } else { ?>
                            <a  class="text-muted"><?= $key; ?></a>
                        <?php } ?>
                        
                    </li>
                    <!--end::Item-->

                    <?php if ($count < count($breadcrumbs)-1) { ?>
                        <li class="breadcrumb-item"><span class="mt-1"><i class="ki-duotone ki-right fs-6"></i></span></li>
                    <?php } ?>

                    <?php $count++; ?>
                <?php } ?>
                
            </ul>
            <!--end::Breadcrumb-->
        </div>
        <!--end::Page title-->

        <!--begin::Actions-->

        <!--end::Actions-->

    </div>
    <!--end::Toolbar container-->
</div>
<!--end::Toolbar-->


<!--begin::Content-->
<div id="kt_app_content" class="app-content flex-column-fluid">
    <!--begin::Content container-->
    <div id="kt_app_content_container" class="app-container container-xxl">

        <?php if (isset($pageid) && $pageid=='all') { ?>
            <?= $this->include('modules/configs/roles/all') ?>
        <?php } elseif (isset($pageid) && $pageid=='view') { ?>
            <?= $this->include('modules/configs/roles/view') ?>
        <?php } ?>    

    </div>
	<!--end::Content container-->
</div>
<!--end::Content-->


<?= $this->endSection() ?>


<?= $this->section('customscripts') ?>
<!--begin::Custom Javascript-Roles -->
<?php if (isset($pageid) && $pageid=='all') { ?>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="app/modules/roles/script-rolegrid.js"></script>
<?php } elseif (isset($pageid) && $pageid=='view') { ?>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="app/modules/roles/script-roleview.js"></script>
<?php } ?> 
<!--end::Custom Javascript-Roles -->
<?= $this->endSection() ?>