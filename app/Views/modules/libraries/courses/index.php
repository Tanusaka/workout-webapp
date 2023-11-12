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
		<?php if (
            (isset($pageid) && $pageid=='all') &&
            (isset($permissions->course_create) && $permissions->course_create)) { ?>
        <div class="d-flex align-items-center gap-2 gap-lg-3">
            <!--begin::Primary button-->
            <a href="libraries/courses/create" class="btn btn-sm fw-bold btn-primary">
            <i class="ki-duotone ki-plus fs-2"></i>Add Course</a>
            <!--end::Primary button-->
        </div>
		<?php } ?>
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
            <?= $this->include('modules/libraries/courses/all') ?>
        <?php } elseif (isset($pageid) && $pageid=='create') { ?>
            <?= $this->include('modules/libraries/courses/create') ?>
        <?php } elseif (isset($pageid) && $pageid=='view') { ?>
            <?= $this->include('modules/libraries/courses/view') ?>
        <?php } ?>    

    </div>
	<!--end::Content container-->
</div>
<!--end::Content-->


<?= $this->endSection() ?>


<?= $this->section('customscripts') ?>
<!--begin::Custom Javascript-Courses -->
<?php if (isset($pageid) && $pageid=='all') { ?>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="app/modules/courses/script-coursegrid.js"></script>
<?php } elseif (isset($pageid) && $pageid=='create') { ?>
    <script src="app/modules/courses/script-coursecreate.js"></script>
<?php } elseif (isset($pageid) && $pageid=='view') { ?>
    <script src="https://www.paypal.com/sdk/js?client-id=AanW5APaxbE3NwBYRMn9VF5KHr5LOYOWJFuOTtKRsyt3jf4Kw-V1fjobw91Cvv68315ykCu4eX31Dzgg&currency=USD"></script>
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    <script src="app/modules/courses/script-courseview.js"></script>
<?php } ?> 
<!--end::Custom Javascript-Courses -->
<?= $this->endSection() ?>


