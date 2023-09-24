<!-- Modal -->
<div class="modal fade" id="addMediaModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addMediaModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addMediaModal">Add Media</h5>
        <!-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> -->
        <button id="btn_close_modal_amm" type="button" class="btn-close" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row"> 
            <div class="col-md-8">
                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <!--begin::Dropzone-->
                    <div class="dropzone img-dropzone-wrapper" id="dz_media">
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
                                <h3 class="fw-bold text-gray-900 mb-1">Drop files here or click to upload.</h3>
                                <span class="fw-semibold text-muted">Allowed Formats: jpeg, jpg, png</span>
                            </div>
                            <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Dropzone-->

                    <!--Begin::Input Hidden-->
                    <!-- <div class="inp-hidden"> -->
                        <!--begin::Input-->
                        <!-- <input id="dz_mediafile" type="text" class="inp-hidden-txt" name="dz_mediafile" placeholder="" value=""> -->
                        <!--end::Input-->
                    <!-- </div> -->
                    <!--end::Input Hidden-->
                </div>
                <!--end::Input group-->
            </div>
            <div class="col-md-4">
                <div class="profile-txtgroup mb-3">
                    <p class="text-truncate fw-sb fs-12 fc-dark">Media Information</p>
                </div>

                <div class="profile-txtgroup mb-3">
                    <p class="text-truncate fw-normal fs-12 fc-light mb-0">Name:</p>
                    <p id="dz_filename" class="text-truncate fw-normal fs-12 fc-dark"></p>
                </div>

                <div class="row profile-txtgroup mb-3">
                    <div class="col-md-6">
                        <p class="text-truncate fw-normal fs-12 fc-light mb-0">Type:</p>
                        <p id="dz_filetype" class="text-truncate fw-normal fs-12 fc-dark"></p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-truncate fw-normal fs-12 fc-light mb-0">Extension:</p>
                        <p id="dz_fileextn" class="text-truncate fw-normal fs-12 fc-dark"></p>
                    </div>
                </div>

                <div class="profile-txtgroup mb-3">
                    <p class="text-truncate fw-normal fs-12 fc-light mb-0">Size:</p>
                    <p class="text-truncate fw-normal fs-12 fc-dark">
                        <span id="dz_filesize"></span>
                        <span id="dz_filesizeunit"></span>
                    </p>
                </div>

            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button id="btn_sav_media" type="button" class="form-action-btn">Save Changes</a>
      </div>
    </div>
  </div>
</div>


