<form class="lead-generation-form" method="POST" action="{{ url('contact') }}" aria-label="Lead Enquiry Form" novalidate>
    @csrf
    <div class="row g-3 flex-column">

        <!-- Honeypot -->
        <div style="display: none">
            <input type="text" name="website" id="website" aria-hidden="true">
        </div>

        <!-- Full Name -->
        <div class="col-md-12 mb-3">
            <input type="text" name="name" class="form-control rounded-0" placeholder="Full Name" required
                autocomplete="name" aria-label="Full Name" aria-required="true">
        </div>

        <!-- Code + Mobile -->
        <div class="col-md-12 mb-3 d-flex gap-2">
            <select class="form-select form-select-sm rounded-0 w-auto" name="code" required
                aria-label="Country Code" aria-required="true">
                <option value="+91" selected>🇮🇳 +91</option>
                <option value="+1">🇺🇸 +1</option>
                <option value="+44">🇬🇧 +44</option>
                <option value="+61">🇦🇺 +61</option>
                <option value="+49">🇩🇪 +49</option>
                <option value="+33">🇫🇷 +33</option>
                <option value="+86">🇨🇳 +86</option>
                <option value="+81">🇯🇵 +81</option>
                <option value="+82">🇰🇷 +82</option>
                <option value="+55">🇧🇷 +55</option>
                <option value="+7">🇷🇺 +7</option>
                <option value="+27">🇿🇦 +27</option>
                <option value="+52">🇲🇽 +52</option>
                <option value="+39">🇮🇹 +39</option>
                <option value="+34">🇪🇸 +34</option>
                <option value="+966">🇸🇦 +966</option>
                <option value="+971">🇦🇪 +971</option>
                <option value="+92">🇵🇰 +92</option>
                <option value="+62">🇮🇩 +62</option>
                <option value="+63">🇵🇭 +63</option>
                <option value="+20">🇪🇬 +20</option>
                <option value="+880">🇧🇩 +880</option>
                <option value="+234">🇳🇬 +234</option>
                <option value="+90">🇹🇷 +90</option>
            </select>
            <input type="tel" name="mobile" class="form-control rounded-0" placeholder="Phone" required
                pattern="[0-9]{7,15}" autocomplete="tel" aria-label="Phone Number" aria-required="true">
        </div>

        <!-- Travellers -->
        <div class="col-md-12 mb-3">
            <select name="travellers" class="form-select rounded-0" required
                aria-label="Number of Travellers" aria-required="true">
                <option value="" disabled selected>Travellers</option>
                <option value="1-2">1 - 2</option>
                <option value="3-5">3 - 5</option>
                <option value="6-10">6 - 10</option>
                <option value="10+">10+</option>
            </select>
        </div>

        <!-- Travel Month -->
        <div class="col-md-12 mb-3">
            <div class="form-floating month-input-wrapper w-100 mb-3">
                <input type="month" name="month" class="form-control rounded-0" id="travelMonth"
                    value="{{ date('Y-m', strtotime('+2 months')) }}" min="{{ date('Y-m') }}" required
                    aria-label="Travel Month" aria-required="true">
                <label for="travelMonth">Travel Month</label>
            </div>
            @error('month')
                <span class="invalid-feedback error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Duration -->
        <div class="col-12 mb-3">
            <select name="package" class="form-select rounded-0" required
                aria-label="Trip Duration" aria-required="true">
                <option value="" disabled selected>Duration</option>
                <option value="2N-3D">2N & 3D</option>
                <option value="3N-4D">3N & 4D</option>
                <option value="4N-5D">4N & 5D</option>
                <option value="5N-6D">5N & 6D</option>
                <option value="6N-7D">6N & 7D</option>
                <option value="7N-8D">7N & 8D</option>
                <option value="8N-9D">8N & 9D</option>
                <option value="9N-10D">9N & 10D</option>
                <option value="10+ Days">10+ Days</option>
                <option value="others">Others</option>
            </select>
        </div>

        <!-- Current URL -->
        <input type="hidden" name="url" value="{{ url()->current() }}" aria-hidden="true">

        <!-- Submit -->
        <div class="col-12">
            <button type="submit" class="btn-andaman btn-lg w-100 rounded-pill py-2" aria-label="Submit Enquiry Form">
                Send Enquiry <i class="fas fa-paper-plane ms-2" aria-hidden="true"></i>
            </button>
        </div>
    </div>
</form>

 <script>
     document.querySelector('.month-input-wrapper').addEventListener('click', function() {
         const input = document.getElementById('travelMonth');
         if (input.showPicker) {
             input.showPicker(); // Opens the picker instantly where supported
         } else {
             input.focus(); // Backup plan, still opens it in most cases
         }

     });
 </script>
