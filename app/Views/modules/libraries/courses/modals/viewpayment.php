<!-- Modal -->
<div class="modal fade" id="viewPaymentModal" tabindex="-1" aria-labelledby="viewPaymentModalLabel" aria-hidden="true" data-bs-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 id="payment_modal_title" class="modal-title" id="viewPaymentModalLabel">Payment Request</h5>
                <button id="btn_closeModalViewPayment" type="button" class="btn_closeModalViewPayment btn-close" aria-label="Close"></button>
            </div>
            <div id="payment_modal_body" class="modal-body">

                <div id="payment_info">

                    <p id="item_note"></p>
                    
                    <strong>Order Summary:</strong>
                    <div class="mb-3"><hr class="dashed"></div>

                    <div class="d-flex justify-content-between">
                        <span class="font-weight-bold">Payment Type</span>
                        <span id="item_payment_type" class="text-muted"></span>
                    </div>

                    <div class="d-flex justify-content-between">
                        <small>Next Payment Date</small>
                        <small id="item_next_payment_date"></small>
                    </div>

                    <div class="mb-3"><hr class="dashed"></div>

                    <div class="d-flex justify-content-between">
                        <span id="item_name" class="font-weight-bold"></span>
                        <span id="item_price" class="text-muted"></span>
                    </div>

                    <div class="d-flex justify-content-between mt-3">
                        <span class="font-weight-bold">Total</span>
                        <span id="item_total_price" class="fs-18"></span>
                    </div>  


                </div>
                    
            </div>
            <div id="payment_modal_footer" class="modal-footer">
                <!-- Set up a container element for the button -->
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
</div>