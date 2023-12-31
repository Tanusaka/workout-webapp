<!-- Modal -->
<div class="modal fade" id="authorizenetPaymentModal" tabindex="-1" aria-labelledby="authorizenetPaymentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="authorizenet_payment_modal_title" class="modal-title" id="authorizenetPaymentModalLabel">Payment Request</h5>
                <button id="btn_closeModalAuthorizenetPayment" type="button" class="btn_closeModalAuthorizenetPayment btn-close" aria-label="Close"></button>
            </div>
            <div id="authorizenet_payment_modal_body" class="modal-body">

                <div id="form-authorizenetpayment" action="" class="col-md-12 mb-6">
        
                    <div class="profile-txtgroup mb-3">
                        <p class="text-truncate fw-sb fs-12 fc-dark">Customer Information</p>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0 required-field">First Name:</label>
                        <input id="firstname" class="form-control ap-inp-field" placeholder="Type First Name..." name="firstname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="1" value="">
                        <label id="firstname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Last Name:</label>
                        <input id="lastname" class="form-control ap-inp-field" placeholder="Type Last Name..." name="lastname" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="2" value="">
                        <label id="lastname_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Address:</label>
                        <input id="address" class="form-control ap-inp-field" placeholder="Type Address..." name="address" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="3" value="">
                        <label id="address_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">City:</label>
                        <input id="city" class="form-control ap-inp-field" placeholder="Type City..." name="city" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="4" value="">
                        <label id="city_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">State:</label>
                        <input id="state" class="form-control ap-inp-field" placeholder="Type State..." name="state" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="5" value="">
                        <label id="state_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Country:</label>
                        <input id="country" class="form-control ap-inp-field" placeholder="Type Country..." name="country" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="6" value="">
                        <label id="country_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Zip/Postal Code:</label>
                        <input id="zip" class="form-control ap-inp-field" placeholder="Type Zip/Postal Code..." name="zip" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="7" value="">
                        <label id="zip_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Phone Number:</label>
                        <input id="phone" class="form-control ap-inp-field" placeholder="Type Phone Number..." name="phone" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="8" value="">
                        <label id="phone_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Eamil Address:</label>
                        <input id="email" class="form-control ap-inp-field" placeholder="Type Email Address..." name="email" type="email" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="9" value="">
                        <label id="email_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="top-gap-15"></div>
                    
                        
                    <div class="profile-txtgroup mb-3">
                        <p class="text-truncate fw-sb fs-12 fc-dark">Credit Card Information</p>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Card Number:</label>
                        <input id="cnumber" class="form-control ap-inp-field" placeholder="Type Card Number..." name="cnumber" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="10" value="">
                        <label id="cnumber_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Expiration Date:</label>
                        <input id="cexpdate" class="form-control ap-inp-field" placeholder="Type Expiration Date..." name="cexpdate" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="11" value="">
                        <label id="cexpdate_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Card Code:</label>
                        <input id="ccode" class="form-control ap-inp-field" placeholder="Type Card Code..." name="ccode" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="12" value="">
                        <label id="ccode_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <div class="form-group mb-12">
                        <label class="text-truncate fw-normal fs-12 fc-light mb-0">Description:</label>
                        <input id="cdesc" class="form-control ap-inp-field" placeholder="Type Description..." name="cdesc" type="text" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="13" value="">
                        <label id="cdesc_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label>
                    </div>

                    <!-- <div class="form-group mb-12"> -->
                        <!-- <label class="text-truncate fw-normal fs-12 fc-light mb-0">Amount:</label> -->
                        <input id="camount" class="form-control ap-inp-field" placeholder="Type Amount..." name="camount" type="hidden" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="14" value="">
                        <input id="ccurrency" class="form-control ap-inp-field" placeholder="Type Currency..." name="ccurrency" type="hidden" autocomplete="off" autocorrect="off" spellcheck="false" tabindex="15" value="">
                        <!-- <label id="camount_er" class="text-truncate fw-normal fs-10 fc-error mb-0 d-none"></label> -->
                    <!-- </div> -->
                    
                </div>
                    
            </div>
            <div id="authorizenet_payment_modal_footer" class="modal-footer">
                <div class="form-group mb-12 d-flex justify-content-end form-opt-container">
                    <button data-actionid="0" id="btn_paynowauthorizenet" type="button" class="form-action-btn" tabindex="3">Pay Now</a>
                </div>
            </div>
        </div>
    </div>
</div>