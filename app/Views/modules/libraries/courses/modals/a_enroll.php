<!-- Modal -->
<div class="modal fade" id="enrollWithPaymentModal" tabindex="-1" aria-labelledby="enrollWithPaymentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollWithPaymentModalLabel">Course Enrollment</h5>
                <button id="btn_closeModalEnrollWithPayment_1" type="button" class="btn_closeModalEnrollWithPayment btn-close" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div id="payment_info">
                    <h1 id="pi_coursename"></h1>
                    <hr/>
                    <p id="pi_note"></p>
                    <strong>Purchase Summary:</strong>
                    <h2 id="pi_amount" class="bg-success mt-5 pa-10"></h2>
                </div>
                    
            </div>
            <div class="modal-footer">
                <button id="btn_closeModalEnrollWithPayment_2" type="button" class="btn_closeModalEnrollWithPayment form-action-btn" tabindex="1">Cancel</a>
                <button data-actionid="0" id="btn_paynow" type="button" class="form-action-btn" tabindex="2">Pay Now</a>
            </div>
        </div>
    </div>
</div>