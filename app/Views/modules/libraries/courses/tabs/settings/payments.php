<div id="form-paymentinfo" action="" class="col-md-12 mb-6">
    <div class="profile-txtgroup mb-3">
        <p class="text-truncate fw-sb fs-12 fc-dark">Payment Information</p>
    </div>

    <div class="row">
        <div class="form-group mb-12 col-12">
            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Price Plan:</label>
            <select id="coursepriceplan" name="coursepriceplan" aria-label="Select a price plan..." data-control="select2" data-placeholder="Select a price plan..." class="form-select" disabled>
                <!-- <option></option> -->
                <option value="OneTime">One Time</option>     
                <option value="Monthly">Monthly</option>     
                <option value="Yearly">Yearly</option>                        
            </select>
            <label id="coursepriceplan_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-12 col-12">
            <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Price:</label>
            <input id="courseprice" class="form-control ap-inp-field" placeholder="Type a price for this course..." name="courseprice" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="-1" value="" min="1">
            <label id="courseprice_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
        </div>
    </div>

    <div class="row">
        <div class="form-group mb-12 col-12">
        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">Currency:</label>
        <select id="coursecurrency" name="coursecurrency" aria-label="Select currency code..." data-control="select2" data-placeholder="Select currency code..." class="form-select" disabled>
            <option value="USD">USD</option>                        
        </select>
        <label id="coursecurrency_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
        </div>
    </div>
    

    <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
        <button id="btn_updatePaymentInfo" type="button" class="form-action-btn" tabindex="-1">Save Changes</button>
    </div>
</div>

<div class="separator separator-dashed col-md-12 my-15"></div>

<div id="form-payments" action="" class="col-md-12 mb-6">
    <div class="profile-txtgroup mb-3">
        <p class="text-truncate fw-sb fs-12 fc-dark">Payments</p>
    </div>

    <div class="table-search-bar">
        <!--begin::Search-->
        <div class="d-flex align-items-center position-relative my-1">
            <i class="ki-duotone ki-magnifier fs-3 position-absolute ms-5">
                <span class="path1"></span>
                <span class="path2"></span>
            </i>
            <input id="payments_DT_search" type="text" data-kt-user-table-filter="search" class="form-control form-control-solid ps-13 ap-inp-field" placeholder="Search payments" autocomplete="off" autocorrect="off" spellcheck="false" />
        </div>
        <!--end::Search-->
    </div>

    <table class="table align-middle table-row-dashed" id="payments_DT">
    <thead>
        <tr class="text-start text-muted fw-bold text-truncate fw-sb fs-12 text-uppercase bg-table-header">
            <th class="text-start min-w-125px">Order Reference</th>
            <th class="text-end min-w-125px">Amount</th>
            <th class="text-center min-w-125px">Paid Via</th>
            <th class="text-center min-w-125px">Paid On</th>
            <th class="text-start min-w-125px">Payer Info</th>
            <th class="text-center min-w-125px">Status</th>
        </tr>
    </thead>
    <tbody id="payments_body" class="text-gray-600 fw-semibold">

        
    </tbody>
    </table> 

</div>


