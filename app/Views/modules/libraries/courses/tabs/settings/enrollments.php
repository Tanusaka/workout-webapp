<div id="form-enrollmentcoupon" action="" class="col-md-12 mb-6">
    <div class="profile-txtgroup mb-3">
        <p class="text-truncate fw-sb fs-12 fc-dark">Enrollment Coupon</p>
    </div>

    <div class="row">
        <div class="form-group mb-12 col-12">
            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Coupon Code:</label>
            <input id="enrollcouponcode" class="form-control ap-inp-field" placeholder="Click on Generate Coupon button to create a new coupon..." name="enrollcouponcode" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="-1" readonly value="">
            <label id="enrollcouponcode_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-12 col-12">
            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Maximum Number of Attempts:</label>
            <input id="enrollmaxattempts" class="form-control ap-inp-field" placeholder="Select number of maximum attempts..." name="enrollmaxattempts" type="number" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="-1" value="" min="1">
            <label id="enrollmaxattempts_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-12 col-12">
        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Coupon Status:</label>
        <select id="enrollcouponstatus" name="enrollcouponstatus" aria-label="Select status of this coupon..." data-control="select2" data-placeholder="Select status of this coupon..." class="form-select">
            <option></option>
            <option value="A">Active</option>     
            <option value="D">Inactive</option>                     
        </select>
        <label id="enrollcouponstatus_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
        </div>
    </div>
    

    <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
    <button id="btn_generateEnrollmentCouponCode" type="button" class="form-action-btn" tabindex="-1">Generate Coupon</button>
        <button id="btn_updateEnrollmentCouponCode" type="button" class="form-action-btn" tabindex="-1">Save Changes</button>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<div id="form-enrollmentcoupon" action="" class="col-md-12 mb-6">
    <div class="profile-txtgroup mb-3">
        <p class="text-truncate fw-sb fs-12 fc-dark">Enrollments</p>
    </div>

    <div class="table-search-bar">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <input id="enrollments_DT_search" type="text" data-kt-user-table-filter="search" class="form-control form-control-solid ps-13 ap-inp-field" placeholder="Search users for enroll" autocomplete="off" autocorrect="off" spellcheck="false" />
        </div>
        <!--end::Search-->
    </div>

    <table class="table align-middle table-row-dashed" id="enrollments_DT">
    <thead>
        <tr class="text-start text-muted fw-bold text-truncate fw-sb fs-12 text-uppercase bg-table-header">
            <th class="min-w-125px">User</th>
            <th class="min-w-125px">Action</th>
        </tr>
    </thead>
    <tbody id="enrollments_body" class="text-gray-600 fw-semibold">

        
    </tbody>
    </table> 

</div>


