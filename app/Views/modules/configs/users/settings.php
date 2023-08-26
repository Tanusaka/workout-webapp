<?php if (isset($permissions->users->write) && $permissions->users->write) { ?>
    <?= $this->include('modules/configs/users/update_profile') ?>
<?php } ?>

<?php if (isset($permissions->users_password->write) && $permissions->users_password->write) { ?>
    <?= $this->include('modules/configs/users/update_password') ?>
<?php } ?>

<?php if (isset($permissions->users_role->write) && $permissions->users_role->write) { ?>
    <?= $this->include('modules/configs/users/update_role') ?>
<?php } ?>