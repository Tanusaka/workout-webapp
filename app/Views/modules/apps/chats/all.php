<div class="d-flex flex-column flex-lg-row">
    <!--begin::Sidebar-->
    <div class="flex-column flex-lg-row-auto w-100 w-lg-300px w-xl-400px mb-10 mb-lg-0">
        <!--begin::Contacts-->
        <div class="card card-flush">

            <!--begin::Card body-->
            <div id="chatlist_container" class="card-body chat-list-body d-none">
            <?= $this->include('modules/apps/chats/sections/chatlist') ?>
            </div>
            <!--end::Card body-->
        </div>
        <!--end::Contacts-->
    </div>
    <!--end::Sidebar-->
    <!--begin::Content-->
    <div id="chatpreview_container" class="flex-lg-row-fluid ms-lg-7 ms-xl-10 d-none">
    <?= $this->include('modules/apps/chats/sections/chatpreview') ?>
    </div>
    <!--end::Content-->
</div>

<?php if (isset($permissions->chat_create) && $permissions->chat_create) : ?>
    <?= $this->include('modules/apps/chats/modals/addchat') ?>
<?php endif; ?>