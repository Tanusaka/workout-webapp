<!-- begin: section container -->
<div id="pagedata-container" class="container" style="margin-top: 15px;" data-pid="0">	

    <div class="page-alert">
        <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
            <div id="alertmessage"></div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>

    <div class="col-md-12 col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column">
                    
                    <form id="form-createuser" action="" class="">
                
                        <div class="form-alert">
                        <div id="alert" class="alert d-flex align-items-center alert-dismissible fade show d-none auto-close" role="alert">
                            <div id="alertmessage"></div>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        </div>
                    
                    
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate fw-sb fs-12 fc-dark">Personal Information</p>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">First Name:</label>
                            <input id="firstname" class="form-control ap-inp-field" placeholder="Type first name here..." name="firstname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                            <label id="firstname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Last Name:</label>
                            <input id="lastname" class="form-control ap-inp-field" placeholder="Type last name here..." name="lastname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="">
                            <label id="lastname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>
                        
                    
                        <div class="top-gap-15"></div>
                    
                        
                        <div class="profile-txtgroup mb-3">
                            <p class="text-truncate fw-sb fs-12 fc-dark">Account Information</p>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Email Address:</label>
                            <input id="email" class="form-control ap-inp-field" placeholder="Type email address here..." name="email" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value="">
                            <label id="email_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>
                    
                        <div class="form-group mb-12">
                            <label class="text-truncate fw-normal fs-12 fc-light mb-12 required-field">User Role:</label>
                    
                            <?php if ( isset($roles) && !empty($roles) ): ?>
                            <?php foreach($roles as $role): ?>
                    
                            <div class="form-check form-check-custom form-check-solid">
                                <!--begin::Input--> 
                                <input class="form-check-input me-3" name="roleid" type="radio" tabindex="4" value="<?= $role->id; ?>" id="<?= 'roleid_'.$role->id; ?>">
                                <!--end::Input-->
                                <!--begin::Label-->
                                <label class="form-check-label" for="<?= 'roleid_'.$role->id; ?>">
                                    <div class="text-truncate fw-sb fs-12 fc-dark"><?= $role->rolename; ?></div>
                                    <div class="text-truncate fw-normal fs-12 fc-light mb-0"><?= $role->roledesc; ?></div>
                                </label>
                                <!--end::Label-->
                            </div>
                    
                            <div class='separator separator-dashed my-5'></div>
                            <?php endforeach; ?>    
                            <?php endif; ?> 
                            
                            <label id="roleid_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        </div>
                    
                        <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
                            <button id="btn_saveUser" type="button" class="form-action-btn">Save User</a>
                        </div>
                    
                    </form>


                </div>
            </div>
        </div>
    </div>
</div>