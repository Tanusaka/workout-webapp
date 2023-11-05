<!-- begin: section container -->
<div id="pagedata-container" class="container" style="margin-top: 15px;" data-pid="<?= $user->id ?>">	

    <div class="page-alert">
        <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
            <div id="alertmessage"></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3 col-lg-3">
            <div class="card">
                <div class="card-body">
                    
                    <div class="d-flex flex-center flex-column">
                        
                        
                        <div class="profile-img symbol symbol-100px symbol-circle mb-4">
                            <?php if (isset($user->profileimage) && !is_null($user->profileimage)) : ?>
                            <img id="dsp_profileimage" src="<?= $user->profileimage ?>" alt="image">
                            <?php else: ?>
                            <img id="dsp_profileimage" src="assets/images/avatar.png" alt="image">  
                            <?php endif; ?>
                        </div>
                        
                        
                        <div class="profile-title mb-4">
                            <span id="dsp_profilename" href="#" class="text-truncate text-wrap fw-sb fs-14 fc-dark"><?= $user->firstname.' '.$user->lastname ?></span>
                        </div>
                        <div class="profile-subtitle mb-12">
                            <span id="dsp_rolename" href="#" class="text-truncate text-wrap fw-normal fs-12 fc-light"><?= $user->rolename ?></span>
                        </div>
                        <div class="profile-actions mb-3">
                            <a id="btn_openModalEditProfile" class="profile-action-btn">Edit Profile</a>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-15"></div>

                    <div class="d-flex flex-start flex-column mb-3">
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-sb fs-12 fc-dark">Personal Information</p>
                        </div>
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-normal fs-12 fc-light mb-0">Date of Birth:</p>
                            <?php if ( isset($user->dob) &&  $user->dob!=='' && $user->dob!=='0000-00-00' ):?>
                            <p id="dsp_dob" class="text-truncate text-wrap fw-normal fs-12 fc-dark"><?= $user->dob ?></p>
                            <?php else: ?>
                            <p id="dsp_dob" class="text-truncate text-wrap fw-normal fs-12 fc-dark">NOT GIVEN</p>
                            <?php endif; ?>
                        </div>
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-normal fs-12 fc-light mb-0">Gender:</p>
                            <?php if ( isset($user->gender) &&  $user->gender!=='' ):?>
                                <?php if ( $user->gender=='M' ):?>
                                    <p id="dsp_gender" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0">Male</p>
                                <?php elseif ( $user->gender=='F' ):?>
                                    <p id="dsp_gender" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0">Female</p>
                                <?php else: ?>
                                    <p id="dsp_gender" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0">-</p>
                                <?php endif; ?>
                            <?php else: ?>
                            <p id="dsp_gender" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0">NOT GIVEN</p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="separator separator-dashed my-15"></div>

                    <div class="d-flex flex-start flex-column mb-3">
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-sb fs-12 fc-dark">Contact Information</p>
                        </div>
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-normal fs-12 fc-light mb-0">Email Address:</p>
                            <p class="text-truncate text-wrap fw-normal fs-12 fc-dark"><?= $user->email ?></p>
                        </div>
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-normal fs-12 fc-light mb-0">Phone Number:</p>
                            <?php if ( isset($user->mobile) &&  $user->mobile!=='' ):?>
                            <p id="dsp_mobile" class="text-truncate text-wrap fw-normal fs-12 fc-dark"><?= $user->mobile ?></p>
                            <?php else: ?>
                            <p id="dsp_mobile" class="text-truncate text-wrap fw-normal fs-12 fc-dark">NOT GIVEN</p>
                            <?php endif; ?>
                        </div>
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate text-wrap fw-normal fs-12 fc-light mb-0">Address:</p>
                            <?php if ( isset($user->address1) &&  $user->address1!=='' ):?>
                            <p id="dsp_addressL1" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0"><?= $user->address1.' '.$user->address2 ?></p>
                            <p id="dsp_addressL2" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0"><?= $user->city.' '.$user->country ?></p>
                            <?php else: ?>
                            <p id="dsp_addressL1" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0">NOT GIVEN</p>
                            <p id="dsp_addressL2" class="text-truncate text-wrap fw-normal fs-12 fc-dark mb-0"></p>
                            <?php endif; ?>
                        </div>
                    </div>

                </div>
            </div>
        </div> 


        <div class="col-md-9 col-lg-9">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex flex-column">
                        
                        <div class="tabs-container">
                            <nav>
                                <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                                    <button id="tabbtn_profile" class="nav-link fs-12 active" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-profile" aria-selected="true">Profile</button>
                                    <button id="tabbtn_settings" class="nav-link fs-12" data-bs-toggle="tab" type="button" role="tab" aria-controls="nav-settings" aria-selected="false">Settings</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">

                                <div class="tab-alert pt-4">
                                    <div id="tab_alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
                                        <div id="tab_alertmessage"></div>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                                </div>
                                
                                <div id="tabcontent_profile" class="tab-pane fade active show" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <?= $this->include('modules/configs/users/profile/index') ?>
                                </div>
                                <div id="tabcontent_settings" class="tab-pane fade" role="tabpanel" aria-labelledby="nav-settings-tab">
                                    <?= $this->include('modules/configs/users/settings/index') ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>

    <?php if (isset($permissions->user_update_profile) && $permissions->user_update_profile) { ?>
        <?php if (isset($pageid) && $pageid=='myprofile') { ?>
            <?= $this->include('modules/configs/users/modals/editprofile') ?>
        <?php } ?>
    <?php } ?>
    

</div>