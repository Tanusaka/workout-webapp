<div id="user_rolesettings" class="course-section-wrapper pt-5">

    <div class="card-body border-0 pb-0">
        <form id="form-changerole" action="" class="col-md-12 mb-0">
             
             <div class="profile-txtgroup mb-3">
                 <p class="text-truncate text-wrap fw-sb fs-12 fc-dark">Change User Role</p>
             </div>
         
             <div class="form-group mb-12">
         
                 <?php if ( isset($roles) && !empty($roles) ): ?>
                 <?php foreach($roles as $role): ?>
         
                 <div class="form-check form-check-custom form-check-solid">
                     <!--begin::Input--> 
                     <input class="form-check-input me-3" name="roleid" type="radio" tabindex="-1" value="<?= $role->id; ?>" data-rolename="<?= $role->rolename ?>" id="<?= 'roleid_'.$role->id; ?>">
                     <!--end::Input-->
                     <!--begin::Label-->
                     <label class="form-check-label" for="<?= 'roleid_'.$role->id; ?>">
                         <div class="text-truncate text-wrap fw-sb fs-12 fc-dark"><?= $role->rolename; ?></div>
                         <div class="text-truncate text-wrap fw-normal fs-12 fc-light mb-0"><?= $role->roledesc; ?></div>
                     </label>
                     <!--end::Label-->
                 </div>
         
                 <div class='top-gap-15'></div>
                 <?php endforeach; ?>    
                 <?php endif; ?> 
             
             </div>
         
             <!-- <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
                 <button id="btn_updateRole" type="button" class="form-action-btn" tabindex="-1">Save Changes</a>
             </div> -->
             
         </form>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

