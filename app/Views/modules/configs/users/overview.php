<!--begin::Card-->
<div class="card">
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <!--begin::Card title-->
        <div class="card-title">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input type="text" data-kt-user-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search user" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_users">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Role</th>
                    <th class="min-w-125px">Last login</th>
                    <th class="min-w-125px">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
            <?php if ( isset($users) && !empty($users) ): ?>
            <?php foreach($users as $user): ?>
                <tr>
                    <td class="d-flex align-items-center">
                        <!--begin:: Avatar -->
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="<?= "configs/user-management/users/view/".$user->id; ?>">
                                <div class="symbol-label fs-3 bg-light-danger text-danger"><?= strtoupper(substr($user->firstname, 0, 1)); ?></div>
                            </a>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a href="<?= "configs/user-management/users/view/".$user->id; ?>" class="text-gray-800 text-hover-primary mb-1"><?= $user->firstname.' '.$user->lastname; ?></a>
                            <span><?= $user->email; ?></span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td><?= $user->rolename; ?></td>
                    <td>
                        <div class="badge badge-light fw-bold"><?= $user->lastinat; ?></div>
                    </td>
                    <td>
                        <?php if ($user->status=='A') { ?>
                            <div class="badge badge-light-success fw-bold">ACTIVE</div>
                        <?php } else { ?>
                            <div class="badge badge-light-danger fw-bold">INACTIVE</div>
                        <?php } ?>
                    </td>
                </tr>
            <?php endforeach; ?>    
            <?php endif; ?>   
            </tbody>
        </table>
        <!--end::Table-->
    </div>
    <!--end::Card body-->

</div>
<!--end::Card-->