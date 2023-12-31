<!-- Modal -->
<div class="modal fade" id="editSettingsModal" tabindex="-1" aria-labelledby="editSettingsModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content modal-fixed-height-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSettingsModalLabel">Settings</h5>
                <button id="btn_closeModalEditSettings" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="modal-alert">
                    <div id="modal_editsettings_alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
                        <div id="modal_editsettings_alertmessage"></div>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                </div>

                <div class="tabs-container">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button id="tabbtn_settingsGeneral" class="tab-link nav-link fs-12 active" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-settings-general" aria-selected="true">General</button>
                            <button id="tabbtn_settingsEnrollments" class="tab-link nav-link fs-12" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-settings-enrollments" aria-selected="false">Enrollments</button>
                            <button id="tabbtn_settingsPayments" class="tab-link nav-link fs-12" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-settings-payments" aria-selected="false">Payments</button>
                        </div>
                    </nav>
                    <div class="tab-content tab-content-no-scroll" id="tab_content">

                        <div class="tab-alert pt-4">
                            <div id="tab_alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
                                <div id="tab_alertmessage"></div>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                        
                        <div id="tabcontent_settingsGeneral" class="tab-pane fade active show" role="tabpanel" aria-labelledby="nav-settings-general-tab">
                        <?= $this->include('modules/libraries/courses/tabs/settings/general') ?>
                        </div>

                        <div id="tabcontent_settingsEnrollments" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-settings-enrollments-tab">
                            <?= $this->include('modules/libraries/courses/tabs/settings/enrollments') ?>
                        </div>

                        <div id="tabcontent_settingsPayments" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-settings-payments-tab"> 
                        <?= $this->include('modules/libraries/courses/tabs/settings/payments') ?>
                        </div>

                    </div>
                </div>
            </div>
            <!-- <div class="modal-footer">
               
            </div> -->
        </div>
    </div>
</div>

