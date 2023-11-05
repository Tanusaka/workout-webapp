<!--begin::Card-->
<div class="card">
    
    <!--begin::Card header-->
    <div class="card-header border-0 pt-6">
        <div class="table-search-bar">
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                    <span class="path1"></span>
                    <span class="path2"></span>
                </i>
                <input id="users_DT_search" type="text" data-kt-user-table-filter="search" class="form-control form-control-solid ps-13 ap-inp-field" placeholder="Type here for search users..." autocomplete="off" autocorrect="off" spellcheck="false" />
            </div>
            <!--end::Search-->
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body py-4">
        <!--begin::Table-->
        <table class="table align-middle table-row-dashed" id="users_DT">
            <thead>
                <tr class="text-start text-muted fw-bold text-truncate fw-sb fs-12 text-uppercase bg-table-header">
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Role</th>
                    <th class="min-w-125px">Last login</th>
                    <th class="min-w-125px text-center">Status</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 fw-semibold">
            <?php if ( isset($users) && !empty($users) ): ?>
            <?php foreach($users as $user): ?>
                <tr>
                    <td class="d-flex align-items-center">
                        <!--begin:: Avatar -->
                        <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                            <?php if ( isset($user->profileimage) && !is_null($user->profileimage) ) : ?>
                                <div class="symbol-label">
                                    <img src="<?= $user->profileimage ?>" class="" alt="">
                                </div>
                            <?php else: ?>
                                <a href="<?= "configs/users/view/".$user->id; ?>">
                                    <div class="symbol-label fs-14 bg-light-danger text-danger"><?= strtoupper(substr($user->firstname, 0, 1)); ?></div>
                                </a>
                            <?php endif; ?>
                        </div>
                        <!--end::Avatar-->
                        <!--begin::User details-->
                        <div class="d-flex flex-column">
                            <a href="<?= "configs/users/view/".$user->id; ?>" class="text-gray-800 text-hover-primary mb-1 fs-14"><?= $user->firstname.' '.$user->lastname; ?></a>
                            <span class="fs-12"><?= $user->email; ?></span>
                        </div>
                        <!--begin::User details-->
                    </td>
                    <td class="fs-12"><?= $user->rolename; ?></td>
                    <td class="fs-12"><?= $user->lastinat; ?></td>
                    <td class="text-center">
                        <?php if ($user->status=='A') { ?>
                            <div class="badge badge-light-success fw-bold fs-12">ACTIVE</div>
                        <?php } else { ?>
                            <div class="badge badge-light-danger fw-bold fs-12">INACTIVE</div>
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