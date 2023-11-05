<div id="settings_tab_content_container">

    <?php if (isset($permissions->user_update_role) && $permissions->user_update_role) { ?>
        <?php if (isset($pageid) && $pageid!='myprofile') { ?>
            <?= $this->include('modules/configs/users/settings/role') ?>
        <?php } ?>
    <?php } ?>

    <?php if (isset($permissions->user_update_password) && $permissions->user_update_password) { ?>
        <?php if (isset($pageid) && $pageid=='myprofile') { ?>
            <?= $this->include('modules/configs/users/settings/password') ?>
        <?php } ?>
    <?php } ?>
    
</div>