<!--begin:Menu item-->
<div class="menu-item pt-5">
    <!--begin:Menu content-->
    <div class="menu-content">
        <span class="menu-heading fw-bold text-uppercase fs-7">Configs</span>
    </div>
    <!--end:Menu content-->
</div>
<!--end:Menu item-->
<!--begin:Menu item-->
<div data-kt-menu-trigger="click" class="menu-item menu-accordion">
    <!--begin:Menu link-->
    <span class="menu-link">
        <span class="menu-icon">
            <i class="ki-duotone ki-element-plus fs-2">
                <span class="path1"></span>
                <span class="path2"></span>
                <span class="path3"></span>
                <span class="path4"></span>
                <span class="path5"></span>
            </i>
        </span>
        <span class="menu-title">User Management</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <?php if (isset($permissions->users->read) && $permissions->users->read) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="configs\user-management\users">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Users</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

        <?php if (isset($permissions->roles->read) && $permissions->roles->read) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="configs\user-management\roles">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Roles</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
