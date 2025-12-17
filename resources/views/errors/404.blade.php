@extends('layouts.app')
@section('title', 'Andaman Bliss 404')
@push('styles')
<style>
    :root {
        --accent: #1dbf73;
        --text: #222;
        --muted: #6c757d;
    }


    .notfnd-wrap {
        max-width: 860px;
        margin: 0 auto;
        padding: 32px 20px 60px;
        display: flex !important;
        flex-direction: column;
    }

    .notfnd-hero {
        text-align: center;
    }

    .notfnd-hero svg {
        width: 220px;
        height: auto;
        display: block;
        margin: 0 auto 18px;
    }

    .notfnd-hero h1 {
        font-weight: 700;
        font-size: 28px;
        margin-bottom: 10px;
    }

    .notfnd-hero p {
        color: var(--muted);
        font-size: 16px;
    }

    .notfnd-tabs {
        margin-top: 28px;
        border-bottom: 1px solid #e9ecef;
    }

    .nav-tabs .nav-link {
        border: none;
        color: #6b6b6b;
        font-weight: 600;
        padding: 12px 8px;
        margin-right: 18px;
    }

    .nav-tabs .nav-link.active {
        color: var(--text);
        border-bottom: 3px solid var(--accent);
    }

    .notfnd-faq-card {
        background: #fff;
        border: 1px solid #e9ecef;
        border-radius: 14px;
        margin-bottom: 12px;
        position: relative;
        overflow: hidden;
        transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    }

    .notfnd-faq-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, .05);
    }

    .notfnd-faq-card.open {
        border-color: #cdebdc;
    }

    .notfnd-faq-card::before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        bottom: 0;
        width: 4px;
        background: linear-gradient(180deg, var(--accent), #13a85f);
        transform: scaleY(0);
        transform-origin: top;
        transition: transform .25s ease;
        
    }

    .notfnd-faq-card.open::before {
        transform: scaleY(1);
    }

    .notfnd-accordion-button {
        padding: 18px;
        font-weight: 600;
        font-size: 16px;
        width: 100% !important;
        align-content: start;
        background: transparent;
        box-shadow: none;
        border: none !important;
        gap: 12px;
        text-align: left;
        
    }

    .notfnd-accordion-button::after {
        content: none;
    }

    .notfnd-accordion-button:not(.collapsed) {
        color: var(--text);
        background: transparent;
        
    }

    .notfnd-accordion-body {
        padding: 0 18px 18px;
        color: var(--muted);
        width: 100% !important;

    }

    .notfnd-toggle {
        flex: 0 0 32px;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--accent), #13a85f);
        position: relative;
        display: inline-block;
        box-shadow: 0 6px 14px rgba(29, 191, 115, .25);
        transition: transform .2s ease, box-shadow .2s ease;
    }

    .notfnd-accordion-button:hover .notfnd-toggle {
        transform: translateY(-1px);
        
        box-shadow: 0 10px 18px rgba(29, 191, 115, .35);
    }

    .notfnd-toggle::before,
    .notfnd-toggle::after {
        content: "";
        position: absolute;
        
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        background: #fff;
        border-radius: 2px;
    }

    .notfnd-toggle::before {
        width: 14px;
        height: 2px;
        
    }



    .notfnd-toggle::after {
        width: 2px;
        height: 14px;
        transition: opacity .2s ease, transform .2s ease;
    }

    .notfnd-accordion-button:not(.collapsed) .notfnd-toggle::after {
        opacity: 0;
        width: 100% !important;
        transform: translate(-50%, -50%) scaleY(0);
    }

    @media (min-width: 768px) {
        .notfnd-hero h1 {
            font-size: 32px;
                    width: 100% !important;

        }
    }
</style>
@endpush

@section('content')
<main class="notfnd-wrap mt-5">
    <section class="notfnd-hero">
        <svg viewBox="0 0 220 120" aria-hidden="true">
            <rect x="10" y="70" width="30" height="40" fill="#000" opacity=".75"></rect>
            <rect x="46" y="50" width="24" height="60" fill="#fff" stroke="#000" stroke-width="2"></rect>
            <rect x="74" y="60" width="30" height="50" fill="#000" opacity=".75"></rect>
            <rect x="108" y="45" width="32" height="65" fill="#fff" stroke="#000" stroke-width="2"></rect>
            <rect x="144" y="58" width="36" height="52" fill="#000" opacity=".75"></rect>
            <circle cx="32" cy="48" r="20" fill="#fff" stroke="#000" stroke-width="2"></circle>
            <path d="M30 48 a20 20 0 0 1 20 20" fill="none" stroke="#000" stroke-width="2"></path>
            <path d="M95 25 l12 -8 l12 8 l-12 8 z" fill="var(--accent)"></path>
            <path d="M152 18 l14 -9 l14 9 l-14 9 z" fill="var(--accent)"></path>
            <path d="M5 110 H215" stroke="#000" stroke-width="2"></path>
        </svg>
        <h1>It'll be back up in no time</h1>
        <p>We're fixing this page. Meanwhile, browse AndamanBliss FAQs or refresh.</p>
    </section>

    <div class="notfnd-tabs">
        <ul class="nav nav-tabs justify-content-center" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="trav-tab" data-bs-toggle="tab" data-bs-target="#trav" type="button" role="tab" aria-controls="trav" aria-selected="true">Travelers</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="agent-tab" data-bs-toggle="tab" data-bs-target="#agent" type="button" role="tab" aria-controls="agent" aria-selected="false">Agents</button>
            </li>
        </ul>
    </div>

    <div class="tab-content pt-2">
        <div class="tab-pane fade show active" id="trav" role="tabpanel" aria-labelledby="trav-tab">
            <div class="accordion accordion-flush" id="trav-acc">

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="q1">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#a1"><span class="notfnd-toggle"></span>Will my booking be affected while this page is down?</button>
                    </h2>
                    <div id="a1" class="accordion-collapse collapse" data-bs-parent="#trav-acc">
                        <div class="notfnd-accordion-body">Existing bookings, payments and vouchers remain safe. Manage trips via confirmation emails or contact support at info@andamanbliss.com.</div>
                    </div>
                </div>

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="q2">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#a2"><span class="notfnd-toggle"></span>How will my Andaman island tours be affected?</button>
                    </h2>
                    <div id="a2" class="accordion-collapse collapse" data-bs-parent="#trav-acc">
                        <div class="notfnd-accordion-body">Tours operate as scheduled. Your guide will meet you at the pickup location mentioned in your itinerary even if this page is unavailable.</div>
                    </div>
                </div>

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="q3">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#a3"><span class="notfnd-toggle"></span>Can I reschedule or cancel my trip?</button>
                    </h2>
                    <div id="a3" class="accordion-collapse collapse" data-bs-parent="#trav-acc">
                        <div class="notfnd-accordion-body">Yes. Rescheduling is free up to 72 hours before departure for most packages. Email support@andamanbliss.com with your booking ID.</div>
                    </div>
                </div>

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="q4">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#a4"><span class="notfnd-toggle"></span>What about ferry tickets and permits?</button>
                    </h2>
                    <div id="a4" class="accordion-collapse collapse" data-bs-parent="#trav-acc">
                        <div class="notfnd-accordion-body">We issue permits and book ferries in advance. Your documents are stored securely and will be shared to your email and WhatsApp before travel.</div>
                    </div>
                </div>

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="q5">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#a5"><span class="notfnd-toggle"></span>How can I reach AndamanBliss right now?</button>
                    </h2>
                    <div id="a5" class="accordion-collapse collapse" data-bs-parent="#trav-acc">
                        <div class="notfnd-accordion-body">Reach our 24×7 desk at info@andamanbliss.com or call +91-8900909900. We typically respond within 15 minutes.</div>
                    </div>
                </div>

            </div>
        </div>

        <div class="tab-pane fade" id="agent" role="tabpanel" aria-labelledby="agent-tab">
            <div class="accordion accordion-flush" id="agent-acc">

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="aq1">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#aa1"><span class="notfnd-toggle"></span>Will partner dashboards or rankings be impacted?</button>
                    </h2>
                    <div id="aa1" class="accordion-collapse collapse" data-bs-parent="#agent-acc">
                        <div class="notfnd-accordion-body">No. Supplier dashboards, allocations and performance scores run normally. This outage only affects one public page.</div>
                    </div>
                </div>

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="aq2">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#aa2"><span class="notfnd-toggle"></span>How are my bookings and payouts handled?</button>
                    </h2>
                    <div id="aa2" class="accordion-collapse collapse" data-bs-parent="#agent-acc">
                        <div class="notfnd-accordion-body">Bookings remain confirmed and payouts follow the agreed cycle. Check your weekly statement or email info@andamanbliss.com.</div>
                    </div>
                </div>

                <div class="accordion-item notfnd-faq-card">
                    <h2 class="accordion-header" id="aq3">
                        <button class="notfnd-accordion-button collapsed d-flex gap-3 align-items-center" type="button" data-bs-toggle="collapse" data-bs-target="#aa3"><span class="notfnd-toggle"></span>Did I lose the package I was creating?</button>
                    </h2>
                    <div id="aa3" class="accordion-collapse collapse" data-bs-parent="#agent-acc">
                        <div class="notfnd-accordion-body">No. Draft packages autosave every minute. Continue editing from the dashboard once you sign in.</div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</main>

@push('scripts')
<script>
    document.querySelectorAll('.accordion').forEach(function(acc) {
        acc.addEventListener('shown.bs.collapse', function(e) {
            acc.querySelectorAll('.notfnd-faq-card').forEach(function(i) {
                i.classList.remove('open');
            });
            e.target.closest('.notfnd-faq-card').classList.add('open');
        });
        acc.addEventListener('hidden.bs.collapse', function(e) {
            e.target.closest('.notfnd-faq-card').classList.remove('open');
        });
    });
</script>
@endpush
@endsection
