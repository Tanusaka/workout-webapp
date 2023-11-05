<div id="profile_tab_content_container">

    <?= $this->include('modules/configs/users/profile/about') ?>

    <?php if (isset($user->connections)): ?>
    <?= $this->include('modules/configs/users/profile/connections') ?>
    <?php endif; ?>
    
</div>