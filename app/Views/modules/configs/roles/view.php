<!--begin::Form-->
<form class="pt-15 pb-10" novalidate="novalidate" id="kt_create_user_form" action="">
    <!--begin::Step 1-->
    <div class="current" data-kt-stepper-element="content">
        <!--begin::Wrapper-->
        <div class="w-100">

            <!--begin::Permissions-->
            <div class="fv-row">
                <!--begin::Table wrapper-->
                <div class="table-responsive">
                    <!--begin::Table-->
                    <table class="table align-middle table-row-dashed fs-6 gy-5">
                        <!--begin::Table body-->
                        <tbody class="text-gray-600 fw-semibold">
                        <?php if ( isset($role->permissions) && !empty($role->permissions) ): ?>
                        <?php foreach($role->permissions as $permission): ?>
                            <!--begin::Table row-->
                            <tr>
                                <!--begin::Label-->
                                <td class="d-flex align-items-center">
                                <div class="d-flex flex-column">
                                    <?= ucfirst($permission->permissionname); ?>
                                    <span class="cstm-f-12-normal"><?= $permission->permissiondesc; ?></span>
                                </div>
                                    
                                </td>
                                <!--end::Label-->
                                <!--begin::Input group-->
                                <td>
                                    <!--begin::Wrapper-->
                                    <div class="d-flex">
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="checkbox" data-pid="<?= $permission->id; ?>" data-mode="read" 
                                            value="<?= $permission->r_access; ?>" 
                                            <?php if ($permission->r_access) : echo "checked"; endif; ?>
                                            <?php if (!$permission->r_enable) : echo "disabled"; endif; ?>
                                            />
                                            <span class="form-check-label">Read</span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid me-5 me-lg-20">
                                            <input class="form-check-input" type="checkbox" data-pid="<?= $permission->id; ?>" data-mode="write" 
                                            value="<?= $permission->w_access; ?>" 
                                            <?php if ($permission->w_access) : echo "checked"; endif; ?>
                                            <?php if (!$permission->w_enable) : echo "disabled"; endif; ?>
                                            />
                                            <span class="form-check-label">Write</span>
                                        </label>
                                        <!--end::Checkbox-->
                                        <!--begin::Checkbox-->
                                        <label class="form-check form-check-sm form-check-custom form-check-solid">
                                            <input class="form-check-input" type="checkbox" data-pid="<?= $permission->id; ?>" data-mode="delete" 
                                            value="<?= $permission->d_access; ?>" 
                                            <?php if ($permission->d_access) : echo "checked"; endif; ?>
                                            <?php if (!$permission->d_enable) : echo "disabled"; endif; ?>
                                            />
                                            <span class="form-check-label">Delete</span>
                                        </label>
                                        <!--end::Checkbox-->
                                    </div>
                                    <!--end::Wrapper-->
                                </td>
                                <!--end::Input group-->
                            </tr>
                        <?php endforeach; ?>    
                        <?php endif; ?>    
                        </tbody>
                        <!--end::Table body-->
                    </table>
                    <!--end::Table-->
                </div>
                <!--end::Table wrapper-->
            </div>
            <!--end::Permissions-->

        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Step 1-->
</form>
<!--end::Form-->