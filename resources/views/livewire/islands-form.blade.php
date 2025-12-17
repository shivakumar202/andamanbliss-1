<div>
    <form wire:submit.prevent="submit" class="booking-form">
        <div class="row g-2">
            <div class="col-sm-6">
                <div class="form-group">
                    <select wire:model="package" class="form-control" aria-label="Select Package" required>
                        <option value="">Select Package</option>
                        <option value="Family">Family</option>
                        <option value="Honeymoon">Honeymoon</option>
                        <option value="Budget">Budget</option>
                        <option value="Premium">Premium</option>
                        <option value="Customized Tour">Customized Tour</option>
                    </select>
                    @error('package') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="date" wire:model="journey_date" class="form-control" aria-label="Journey Date" required>
                    @error('journey_date') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="row g-2 travelers-count">
            @foreach (['adult' => 'Adult', 'child' => 'Child', 'infant' => 'Infant'] as $key => $label)
            <div class="col-4">
                <div class="counter-group">
                    <div class="counter-label">{{ $label }}</div>
                    <div class="counter-controls">
                        <button type="button" class="counter-btn minus" wire:click="decrement('{{ $key }}_count')">-</button>
                        <span class="counter-value">{{ ${$key . '_count'} }}</span>
                        <button type="button" class="counter-btn plus" wire:click="increment('{{ $key }}_count')">+</button>
                    </div>
                    @error($key . '_count') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            @endforeach
        </div>
        <input type="text" wire:model.defer="website" style="display: none;" autocomplete="off">
                            <input type="text" name="url" wire:model="url" id="url" class="form-control d-none" readonly>

        <div class="row g-2">
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="text" wire:model="name" class="form-control" placeholder="Name" required>
                    @error('name') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                    <input type="number" wire:model="mobile" class="form-control" placeholder="Mobile Number" required>
                    @error('mobile') <span class="text-danger">{{ $message }}</span> @enderror
                </div>
            </div>
        </div>

        <div class="form-group">
            <input type="email" wire:model="email" class="form-control" placeholder="Email" required>
            @error('email') <span class="text-danger">{{ $message }}</span> @enderror
        </div>

        <div class="form-group text-center mb-0">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fas fa-paper-plane"></i> Send Inquiry
            </button>
        </div>

        @if (session()->has('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
        @endif
    </form>

</div>