<!-- Modal -->
<div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="editProfileModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProfileModalLabel">Edit Profile</h5>
                <button id="btn_closeModalEditProfile" type="button" class="btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form id="form-editprofile" action="" class="">
             
                    <div class="profile-txtgroup mb-3">
                        <p class="text-truncate fw-sb fs-12 fc-dark">Personal Information</p>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Name:</label>
                        <input id="firstname" class="form-control ap-inp-field" placeholder="Type your first name here..." name="firstname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="firstname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                        <input id="lastname" class="form-control ap-inp-field" placeholder="Type your last name here..." name="nic" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="">
                        <label id="lastname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Date of Birth:</label>
                        <input id="dob" class="form-control ap-inp-field" placeholder="Select your date of birth..." name="nic" type="date" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value="">
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Gender:</label>
                        <select id="gender" name="gender" aria-label="Select your gender..." data-control="select2" data-placeholder="Select your gender..." class="form-select" data-dropdown-parent="#editProfileModal">
                            <option></option>
                            <option value="M">Male</option>     
                            <option value="F">Female</option>                     
                        </select>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Profile Image:</label>
                        
                        <div class="row">
                            <div class="col-6">
                                <!--begin::Dropzone-->
                                <div class="dropzone img-dropzone-wrapper" id="dz_profileimage">
                                    <!--begin::Message-->
                                    <div class="dz-message needsclick">
                                        <!--begin::Icon-->
                                        <i class="ki-duotone ki-file-up fs-3hx text-primary">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <!--end::Icon-->
                                        <!--begin::Info-->
                                        <div class="ms-4">
                                            <h4 class="fw-bold text-gray-900 mb-1 fs-14">Drop files here or click to upload.</h4>
                                            <span class="fw-semibold text-muted">Allowed Formats: jpeg, jpg, png</span>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                </div>
                                <!--end::Dropzone-->
                                <div class="inp-hidden">
                                    <!--begin::Input-->
                                    <input id="profileimage" type="hidden" class="inp-hidden-txt" name="profileimage" placeholder="" value="">
                                    <!--end::Input-->
                                </div>
                            </div>
                            <div class="col-6">
                                <p class="align-middle">Upload your course image here. It must meet our course image quality standards to be accepted. Important guidelines: 750x422 pixels; .jpg, .jpeg or .png. no text on the image.</p>
                            </div>
                        </div>
                        
                        <label id="profileimage_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>
                    

                    <div class="top-gap-15"></div>

                  
                    <div class="profile-txtgroup mb-3">
                        <p class="text-truncate fw-sb fs-12 fc-dark">Contact Information</p>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Phone Number:</label>
                        <input id="mobile" class="form-control ap-inp-field" placeholder="Type your mobile number here..." name="mobile" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="5" value="">
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Address:</label>
                        <input id="address1" class="form-control ap-inp-field" placeholder="Type address line here..." name="address1" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="6" value="">
                        <input id="address2" class="form-control ap-inp-field" placeholder="Type address line here..." name="address2" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="7" value="">
                        <input id="city" class="form-control ap-inp-field" placeholder="Type your city..." name="city" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="8" value="">
                        <input id="country" class="form-control ap-inp-field" placeholder="Type your country..." name="country" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="9" value="">
                    </div>
              
                </form>
                    
            </div>
            <div class="modal-footer">
                <button id="btn_updateProfile" type="button" class="form-action-btn" tabindex="10">Save Changes</a>
            </div>
        </div>
    </div>
</div>