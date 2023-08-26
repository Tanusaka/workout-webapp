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
                <input type="text" data-kt-linkedprofile-table-filter="search" class="form-control form-control-solid w-250px ps-13" placeholder="Search Linked Profile" />
            </div>
            <!--end::Search-->
        </div>
        <!--begin::Card title-->
        <!--begin::Card toolbar-->
        <div class="card-toolbar">
            <!--begin::Toolbar-->
            <div class="d-flex justify-content-end" data-kt-user-table-toolbar="base">
                
                <?php if (isset($permissions->users_linkedprofiles->write) && $permissions->users_linkedprofiles->write) { ?>
                <!--begin::Add link-->
                <button type="button" class="btn btn-light-primary btn-sm" data-bs-toggle="modal" data-bs-target="#kt_modal_addlink">
                <i class="ki-duotone ki-plus fs-2"></i>ADD LINK</button>
                <!--end::Add link-->
                <?= $this->include('modules/configs/users/modal_addlink') ?>
                <?php } ?>

            </div>
            <!--end::Toolbar-->
        </div>
        <!--end::Card toolbar-->
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_table_linkedprofiles">
            <thead>
                <tr class="text-start text-muted fw-bold fs-7 text-uppercase gs-0">
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Role</th>
                    <th class="min-w-125px">Status</th>

                    <?php if (isset($permissions->users_linkedprofiles->write) && $permissions->users_linkedprofiles->write) { ?>
                    <th class="min-w-125px text-center">Actions</th>
                    <?php } ?>

                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
            <?php if ( isset($linkedprofiles) && !empty($linkedprofiles) ): ?>
            <?php foreach($linkedprofiles as $linkedprofile): ?>
                <tr>
                    <td class="d-flex align-items-center">
                        <!--begin:: Avatar -->
                        <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                            <a href="<?= "configs/user-management/users/view/".$linkedprofile->id; ?>">
                                <div class="symbol-label fs-3 bg-light-danger text-danger"><?= strtoupper(substr($linkedprofile->firstname, 0, 1)); ?></div>
                            </a>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a href="" class="text-gray-800 text-hover-primary mb-1"><?= $linkedprofile->firstname.' '.$linkedprofile->lastname; ?></a>
                            <span><?= $linkedprofile->email; ?></span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td><?= $linkedprofile->rolename; ?></td>
                    <td>
                        <?php if ($linkedprofile->status=='A') { ?>
                            <div class="badge badge-light-success fw-bold">ACTIVE</div>
                        <?php } else { ?>
                            <div class="badge badge-light-danger fw-bold">INACTIVE</div>
                        <?php } ?>
                    </td>

                    <?php if (isset($permissions->users_linkedprofiles->write) && $permissions->users_linkedprofiles->write) { ?>
                    <td class="text-center">
                        <a class="del-linked-profile" title="Delete Linked Profile" data-linkid="<?= $linkedprofile->id; ?>">
                        <i class="ki-duotone ki-trash-square fs-1 text-danger">
                        <i class="path1"></i>
                        <i class="path2"></i>
                        <i class="path3"></i>
                        <i class="path4"></i>
                        </i></a>
                    </td>
                    <?php } ?>

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