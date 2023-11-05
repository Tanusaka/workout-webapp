<!-- Modal -->
<div class="modal fade" id="addFileModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addFileModal" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addFileModal">Add File</h5>
        <button id="btn_closeModalAddFile" type="button" class="btn-close" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row"> 
            <div class="col-md-8">
                <!--begin::Input group-->
                <div class="mb-10 fv-row">
                    <!--begin::Dropzone-->
                    <div class="dropzone img-dropzone-wrapper" id="dz_fileupload">
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

                    <div class="inp-hidden">
                        <!--begin::Input-->
                        <input id="fileupload" type="hidden" class="inp-hidden-txt" name="fileupload" placeholder="" value="">
                        <!--end::Input-->
                    </div>
                </div>
                <!--end::Input group-->

                <label id="fileupload_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>

            </div>
            <div class="col-md-4">
                <div class="profile-txtgroup mb-3">
                    <p class="text-truncate fw-sb fs-12 fc-dark">File Information</p>
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
        <button id="btn_saveFileUpload" type="button" class="form-action-btn">Save Changes</a>
      </div>
    </div>
  </div>
</div>


