<div class="destinations_content_box img_animation">
    <form method="POST" action="{{ route('contact') }}" id="form" class="contact-form border shadow px-4">
        @csrf
        <h2 class="title fs-4">Want to Go For A Memorable Holiday?</h2>
        <p class="description">Provide Your Details to Know Best Holiday Deals</p>
        <div class="mt-3">
            <input type="text" name="name" value="{{ old('name') }}" placeholder="{{ __('Name') }}*"
                id="name"
                class="form-control rounded border-white mb-3 form-input @error('name') is-invalid @enderror" required
                autocomplete="name">
            @error('name')
                <span class="invalid-feedback error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div>
            <input type="text" name="mobile" value="{{ old('mobile') }}" placeholder="{{ __('Mobile') }}*"
                maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');"
                id="mobile"
                class="form-control rounded border-white mb-3 form-input @error('mobile') is-invalid @enderror" required
                autocomplete="mobile">
            @error('mobile')
                <span class="invalid-feedback error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
      
        <div>
            <input type="text" name="website" id="website" hidden>
            <select name="package" value="{{ old('package') }}" placeholder="Package Name" id="package"
                class="form-control rounded border-white mb-3 form-input @error('name') is-invalid @enderror" required
                autocomplete="package">
                <option value="" disabled selected>Select Package</option>
                <option value="2N-3D">2Nights & 3Days</option>
                <option value="3N-4D">3Nights & 4Days</option>
                <option value="4N-5D">4Nights & 5Days</option>
                <option value="5N-6D">5Nights & 6Days</option>
                <option value="6N-7D">6Nights & 7Days</option>
                <option value="7N-8D">7Nights & 8Days</option>
                <option value="8N-9D">8Nights & 9Days</option>
                <option value="9N-10D">9Nights & 10Days</option>
                <option value="10+ Days">10+ Days</option>
            </select>
            @error('package')
                <span class="invalid-feedback error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="pCount d-flex mb-3 justify-content-between">
            <div class="pCountall adult">
                <span>Adult</span>
                <div class="quantity">
                    <a href="#" class="quantity__minus"><span>-</span></a>
                    <input type="text" name="adult" value="{{ old('adult', 1) }}" id="adult"
                        class="quantity__input" aria-label="Quantity">
                    <a href="#" class="quantity__plus"><span>+</span></a>
                </div>
            </div>

            <div class="pCountall child">
                <span>Child</span>
                <div class="quantity">
                    <a href="#" class="quantity__minus"><span>-</span></a>
                    <input type="text" name="child" value="{{ old('child', 0) }}" id="child"
                        class="quantity__input" aria-label="Quantity">
                    <a href="#" class="quantity__plus"><span>+</span></a>
                </div>
            </div>
            <div class="pCountall infant">
                <span>Infant</span>
                <div class="quantity">
                    <a href="#" class="quantity__minus"><span>-</span></a>
                    <input type="text" name="infant" value="{{ old('infant', 0) }}" id="infant"
                        class="quantity__input" aria-label="Quantity">
                    <a href="#" class="quantity__plus"><span>+</span></a>
                </div>
            </div>
        </div>
        <div class="mt-1">
            <input type="text" name="date" value="{{ old('date') }}" placeholder="Expected Journey Date"
                id="date"
                class="form-control datepick rounded border-white mb-3 form-input @error('name') is-invalid @enderror"
                required autocomplete="date"> @error('date')
                <span class="invalid-feedback error" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <hr class="dashline">
        <div class="submit-button-wrapper  ">
            <input type="submit" value="Send">
        </div>

    </form>
</div>
