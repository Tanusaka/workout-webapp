<!--begin:Menu item-->
<div class="menu-item pt-5">
    <!--begin:Menu content-->
    <div class="menu-content">
        <span class="menu-heading fw-bold text-uppercase fs-7">Libraries</span>
    </div>
    <!--end:Menu content-->
</div>
<!--end:Menu item-->
<?php if (isset($permissions->programs->read) && $permissions->programs->read) { ?>
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
        <span class="menu-title">Programs</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="../../demo1/dist/pages/user-profile/overview.html">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        
        <?php if (isset($permissions->programs->write) && $permissions->programs->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="#">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>

<?php if (isset($permissions->workouts->read) && $permissions->workouts->read) { ?>
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
        <span class="menu-title">Workouts</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="../../demo1/dist/account/overview.html">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

        <?php if (isset($permissions->workouts->write) && $permissions->workouts->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>

<?php if (isset($permissions->habits->read) && $permissions->habits->read) { ?>
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
        <span class="menu-title">Habits</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="#">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

        <?php if (isset($permissions->habits->write) && $permissions->habits->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="../../demo1/dist/account/settings.html">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>

<?php if (isset($permissions->exercises->read) && $permissions->exercises->read) { ?>
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
        <span class="menu-title">Exercises</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="#">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

        <?php if (isset($permissions->exercises->write) && $permissions->exercises->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="#">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>

<?php if (isset($permissions->meals->read) && $permissions->meals->read) { ?>
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
        <span class="menu-title">Meals</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="../../demo1/dist/account/overview.html">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

        <?php if (isset($permissions->meals->write) && $permissions->meals->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="#">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>

<?php if (isset($permissions->foods->read) && $permissions->foods->read) { ?>
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
        <span class="menu-title">Foods</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="../../demo1/dist/account/overview.html">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

        <?php if (isset($permissions->foods->write) && $permissions->foods->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="#">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>

<?php if (isset($permissions->courses->read) && $permissions->courses->read) { ?>
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
        <span class="menu-title">Courses</span>
        <span class="menu-arrow"></span>
    </span>
    <!--end:Menu link-->
    <!--begin:Menu sub-->
    <div class="menu-sub menu-sub-accordion">
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="libraries\courses">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Overview</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->

        <?php if (isset($permissions->courses->write) && $permissions->courses->write) { ?>
        <!--begin:Menu item-->
        <div class="menu-item">
            <!--begin:Menu link-->
            <a class="menu-link" href="libraries/courses/create">
                <span class="menu-bullet">
                    <span class="bullet bullet-dot"></span>
                </span>
                <span class="menu-title">Add New</span>
            </a>
            <!--end:Menu link-->
        </div>
        <!--end:Menu item-->
        <?php } ?>

    </div>
    <!--end:Menu sub-->
</div>
<!--end:Menu item-->
<?php } ?>