<div>
    <div class="confirmation-section bg-light ">
        <div class="container">
            @if($step == 0)
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <div class="mb-4">
                        <i class="bi bi-check-circle-fill text-success" style="font-size: 4rem"></i>
                    </div>
                    <h2 class="mb-3">Booking Confirmed!</h2>
                    <p class="lead mb-4">
                        Your Andaman tour package has been successfully booked. Would you
                        like to enhance your experience with some amazing water
                        activities?
                    </p>

                    <div class="d-flex gap-3 justify-content-center">
                        <button class="btn btn-outline-secondary btn-lg" onclick="skipUpsale()">
                            <i class="bi bi-skip-forward me-2"></i>Skip & Continue
                        </button>
                        <button
                            class="btn btn-primary-custom btn-lg" wire:click="nextStep">
                            <i class="bi bi-plus-circle me-2"></i>Add More Activities
                        </button>
                    </div>
                </div>
            </div>
            @elseif($step == 1)
            <div class="upsale-section" id="upsaleSection">
                <div class="container py-5" style="padding-top: 2rem !important">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="text-center mb-5">
                                <h3 class="mb-3">
                                    <i class="bi bi-star-fill text-warning me-2"></i>
                                    Enhance Your Andaman Experience
                                </h3>
                                <p class="text-muted">
                                    Add these amazing water activities to make your trip
                                    unforgettable
                                </p>
                            </div>

                            <!-- Scuba Diving Activity -->
                            <div class="activity-card mb-4 p-2">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center mb-3 mb-md-0">
                                        <img
                                            src="https://images.unsplash.com/photo-1586508577428-120d6b072945?q=80&w=928&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                            alt="Scuba Diving"
                                            class="activity-image" />
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-2">
                                            <div class="d-flex align-items-center mb-1">
                                                <h5 class="mb-0 me-2">Scuba Diving</h5>
                                                <span class="up-discount-badge">30% OFF</span>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-0">
                                            Explore vibrant coral reefs and marine life in the crystal
                                            clear waters of Andaman
                                        </p>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <div class="d-none d-md-block">
                                            <div class="price-container mb-3">
                                                <div class="original-price" id="scuba-original">
                                                    ₹6,500
                                                </div>
                                                <span class="offer-price" id="scuba-offer">₹4,550</span>
                                            </div>
                                            <div
                                                class="d-flex gap-3 align-items-center justify-content-end">
                                                <div class="activity-counter">
                                                    <button
                                                        class="activity-counter-btn"
                                                        wire:click="addActivity(1)">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <span
                                                        class="activity-counter-display"
                                                        id="scuba-diving-count">1</span>
                                                    <button
                                                        class="activity-counter-btn"
                                                        wire:click="subActivity(1)">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                                <button
                                                    class="btn btn-sm btn-primary-custom"
                                                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                                    Check Availability
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-md-none mobile-action-row">
                                            <div class="price-container">
                                                <div class="original-price" id="scuba-original-mobile">
                                                    ₹6,500
                                                </div>
                                                <span class="offer-price" id="scuba-offer-mobile">₹4,550</span>
                                            </div>
                                            <div class="activity-counter">
                                                <button
                                                    class="activity-counter-btn"
                                                    wire:click="addActivity(1)">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <span
                                                    class="activity-counter-display"
                                                    id="scuba-diving-count">1</span>
                                                <button
                                                    class="activity-counter-btn"
                                                    wire:click="subActivity(1)">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                            <button
                                                class="btn btn-primary-custom"
                                                onclick="addToCart('scuba-diving', 4500)">
                                                <i class="bi bi-cart-plus me-1"></i>Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Kayaking Activity -->
                            <div class="activity-card mb-4 p-2">
                                <div class="row align-items-center">
                                    <div class="col-md-2 text-center mb-3 mb-md-0">
                                        <img
                                            src="https://images.unsplash.com/photo-1588472235276-7638965471e2?q=80&w=869&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                                            alt="Kayaking"
                                            class="activity-image" />
                                    </div>
                                    <div class="col-md-5">
                                        <div class="mb-2">
                                            <div class="d-flex align-items-center mb-1">
                                                <h5 class="mb-0 me-2">Kayaking</h5>
                                                <span class="up-discount-badge">25% OFF</span>
                                            </div>
                                        </div>
                                        <p class="text-muted mb-0">
                                            Paddle through pristine mangrove creeks and discover hidden
                                            lagoons
                                        </p>
                                    </div>
                                    <div class="col-md-5 text-end">
                                        <div class="d-none d-md-block">
                                            <div class="price-container mb-3">
                                                <div class="original-price" id="kayaking-original">
                                                    ₹3,800
                                                </div>
                                                <span class="offer-price" id="kayaking-offer">₹2,850</span>
                                            </div>
                                            <div
                                                class="d-flex gap-3 align-items-center justify-content-end">
                                                <div class="activity-counter">
                                                    <button
                                                        class="activity-counter-btn"
                                                        wire:click="addActivity(2)">
                                                        <i class="bi bi-dash"></i>
                                                    </button>
                                                    <span
                                                        class="activity-counter-display"
                                                        id="scuba-diving-count">1</span>
                                                    <button
                                                        class="activity-counter-btn"
                                                        wire:click="subActivity(2)">
                                                        <i class="bi bi-plus"></i>
                                                    </button>
                                                </div>
                                                <button
                                                    class="btn btn-sm btn-primary-custom"
                                                    onclick="addToCart('kayaking', 2800)">
                                                    Check Availability
                                                </button>
                                            </div>
                                        </div>
                                        <div class="d-md-none mobile-action-row">
                                            <div class="price-container">
                                                <div class="original-price" id="kayaking-original-mobile">
                                                    ₹3,800
                                                </div>
                                                <span class="offer-price" id="kayaking-offer-mobile">₹2,850</span>
                                            </div>
                                            <div class="activity-counter">
                                                <button
                                                    class="activity-counter-btn"
                                                    onclick="updateActivityCount('kayaking', -1)">
                                                    <i class="bi bi-dash"></i>
                                                </button>
                                                <span
                                                    class="activity-counter-display"
                                                    id="kayaking-count-mobile">1</span>
                                                <button
                                                    class="activity-counter-btn"
                                                    onclick="updateActivityCount('kayaking', 1)">
                                                    <i class="bi bi-plus"></i>
                                                </button>
                                            </div>
                                            <button
                                                class="btn btn-primary-custom"
                                                onclick="addToCart('kayaking', 2800)">
                                                <i class="bi bi-cart-plus me-1"></i>Add
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">

                        </div>
                    </div>
                </div>
            </div>


            <div class="modal fade" wire:ignore.self id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ...
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary">Understood</button>
                        </div>
                    </div>
                </div>
            </div>

            @elseif($step==2)


            @else
            <p>Unexpected Error</p>
            @endif
        </div>
    </div>
</div>