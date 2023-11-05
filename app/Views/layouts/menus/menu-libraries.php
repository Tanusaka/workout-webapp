<!--begin:Menu item-->
<div class="menu-item pt-5">
    <!--begin:Menu content-->
    <div class="menu-content">
        <span class="menu-heading fw-bold text-uppercase fs-7">Libraries</span>
    </div>
    <!--end:Menu content-->
</div>
<!--end:Menu item-->

<?php if (isset($permissions->course_management) && $permissions->course_management) : ?>
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <a class="cstm-menu-link" href="libraries/courses">
    <span class="cstm-menu-icon">
        <i class="ki-duotone ki-element-plus fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>
    </span>Courses</a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->
<?php endif; ?>


<?php if (isset($permissions->file_management) && $permissions->file_management) : ?>
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <a class="cstm-menu-link" href="libraries/files">
    <span class="cstm-menu-icon">
        <i class="ki-duotone ki-element-plus fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>
    </span>Files</a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->
<?php endif; ?>