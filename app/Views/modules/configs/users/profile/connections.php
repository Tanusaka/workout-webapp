<div class="card mb-5 mb-xl-8 no-box-shadow">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
        <h3 class="card-title align-items-start flex-column">
            <span class="card-label fw-bold text-dark">Connections</span>
            <span id="connection_preview_summary" class="text-muted mt-1 fw-semibold fs-7"></span>
        </h3>
        <!--begin::Toolbar-->
        <div class="card-toolbar">
            <?php if (isset($permissions->user_add_connections) && $permissions->user_add_connections): ?>
            <button id="btn_openModalAddConnection" type="button" class="form-action-btn justify-content-end" tabindex="-1">Add Connection</a>
            <?php endif; ?> 
        </div>
        <!--end::Toolbar-->
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-5">
        <div id="connection_conatiner" class="d-none">
            <div class="table-search-bar">
                <!--begin::Search-->
                <div class="d-flex align-items-center position-relative my-1">
                    <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                        <span class="path1"></span>
                        <span class="path2"></span>
                    </i>
                    <input id="connectionpreview_DT_search" type="text" data-kt-user-table-filter="search" class="form-control form-control-solid ps-13 ap-inp-field" placeholder="Search connections" autocomplete="off" autocorrect="off" spellcheck="false" />
                </div>
                <!--end::Search-->
            </div>

            <table class="table align-middle table-row-dashed" id="connectionpreview_DT">
            <thead>
                <tr class="text-start text-muted fw-bold text-truncate fw-sb fs-12 text-uppercase bg-table-header">
                    <th class="min-w-125px">User</th>
                    <th class="min-w-125px">Action</th>
                </tr>
            </thead>
            <tbody id="connectionpreview_body" class="text-gray-600 fw-semibold">

            </tbody>
            </table>  
        </div>
    </div>
    <!--end::Body-->
</div>

<?php if (isset($permissions->user_add_connections) && $permissions->user_add_connections): ?>
<?= $this->include('modules/configs/users/modals/addconnection') ?>
<?php endif; ?> 