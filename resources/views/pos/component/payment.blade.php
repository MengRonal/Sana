<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 pb-0">
                <h5 class="modal-title fw-bold" id="paymentModalLabel">Select Payment Method</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4">
                <div class="text-center mb-4 p-3 bg-light rounded-3">
                    <span class="text-muted d-block small">Total Payable</span>
                    <h2 class="fw-bold text-primary mb-0">$45.00</h2>
                </div>
                <form action="" method="POST" id="paymentForm">
                    @csrf
                    <div class="d-flex flex-column gap-3">
                        <label class="card p-3 border-2 cursor-pointer shadow-sm hover-shadow">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <input class="form-check-input mt-0" type="radio" name="payment_method"
                                        value="khqr">
                                    <div>
                                        <h6 class="mb-0 fw-semibold">ABA / KHQR Code</h6>
                                        <small class="text-muted">Scan to pay instantly</small>
                                    </div>
                                </div>
                                <i class="fa-solid fa-qrcode fs-4 text-success"></i>
                            </div>
                        </label>
                        <label class="card p-3 border-2 cursor-pointer shadow-sm hover-shadow">
                            <div class="d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center gap-3">
                                    <input class="form-check-input mt-0" type="radio" name="payment_method"
                                        value="cash">
                                    <div>
                                        <h6 class="mb-0 fw-semibold">Cash</h6>
                                        <small class="text-muted">Pay at the counter</small>
                                    </div>
                                </div>
                                <i class="fa-solid fa-money-bill-wave fs-4 text-warning"></i>
                            </div>
                        </label>

                    </div>

                    <button type="submit" class="btn btn-primary w-100 mt-4 py-2 fw-bold">
                        Confirm & Pay
                    </button>
                </form>

            </div>
        </div>
    </div>
</div>