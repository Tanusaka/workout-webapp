<!--begin:Menu item-->
<div class="menu-item pt-5">
    <!--begin:Menu content-->
    <div class="menu-content">
        <span class="menu-heading fw-bold text-uppercase fs-7">Configs</span>
    </div>
    <!--end:Menu content-->
</div>
<!--end:Menu item-->

<?php if (isset($permissions->user_management) && $permissions->user_management) : ?>
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <a class="cstm-menu-link" href="configs/users">
    <span class="cstm-menu-icon">
        <i class="ki-duotone ki-element-plus fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>
    </span>User Management</a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->
<?php endif; ?>

<?php if (isset($permissions->role_management) && $permissions->role_management) : ?>
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <a class="cstm-menu-link" href="configs/roles">
    <span class="cstm-menu-icon">
        <i class="ki-duotone ki-element-plus fs-2">
            <span class="path1"></span>
            <span class="path2"></span>
            <span class="path3"></span>
            <span class="path4"></span>
            <span class="path5"></span>
        </i>
    </span>Role Management</a>
    <!--end:Menu link-->
</div>
<!--end:Menu item-->
<?php endif; ?>
