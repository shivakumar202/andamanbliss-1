@if (!empty($hotels) && count($hotels) > 0)
    @foreach ($hotels->sortByDesc('star_count') as $hotel)
        <div class="listing-htl-hotel-card mb-3">
            <div class="row g-0">
             <div class="col-12 col-md-3 p-2 hote-photo"
     style="background-image: url('{{ $hotel['hotel_image'] }}'); background-size:cover; background-repeat: no-repeat;"
     aria-label="{{ $hotel['hotel_name'] }}"
     role="img">
</div>

                <div class="col-12 col-md-9 p-3">
                    <div class="heading-htl mb-2">
                        <h5 class="listing-htl-hotel-title">{{ $hotel['hotel_name'] ?? '' }}</h5>
                        <div class="d-flex flex-wrap justify-content-end">
                        <div class="listing-htl-stars htl-star-algn">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="{{ $i < ($hotel['star_count'] ?? 0) ? 'fas fa-star text-warning' : 'far fa-star' }}"></i>
                            @endfor
                        </div>
                        @if (!empty($hotel['selected_room']['RoomPromotion']))
                            <span class="badge bg-danger text-light">{{ $hotel['selected_room']['RoomPromotion'][0] ?? '' }}</span>
                        @endif
                        </div>
                    </div>
                    <div class="listing-htl-location mb-2">
                        <span><i class="fas fa-map-marker-alt"></i> {{ $hotel['address'] ?? '' }}</span>
                        <a href="#" class="listing-htl-map-link ms-2">View map</a>
                    </div>
                    <div class="listing-htl-room-details mb-2">
                        <div class="hotel-lst-htl-room-type">{{ $hotel['selected_room']['Name'][0] ?? 'Room' }}</div>
                        <ul class="hotel-amities-lst">
                            <li><i class="fas fa-user-friends"></i> x{{ $hotel['selected_room']['RoomOccupancy'] ?? 2 }}</li>
                            <li class="non-refund-htl"><i class="fas fa-times-circle"></i> Non Refundable</li>
                            @php $inclusion = $hotel['selected_room']['inclusion'] ?? 'Breakfast'; @endphp
                            <li class="hotel-breakfst"><i class="fas fa-coffee"></i>
                                {{ \Illuminate\Support\Str::limit($inclusion, 20) }}</li>
                        </ul>
                    </div>
                    <div class="d-flex justify-content-between align-items-end flex-wrap flex-row-reverse">
                        <div class="price-blok d-flex flex-wrap justify-content-end">
                            <div class="listing-htl-price hotel-lst-prc">INR
                                {{ number_format($hotel['selected_room']['TotalFare'] ?? 0) }}
                            </div>
                            <a href="#" class="book-room-btn rounded-0 w-100"
                                onclick="event.preventDefault(); document.getElementById('hotel-form-{{ $hotel['hotel_code'] }}').submit();">
                                Book Now
                            </a>

                            <form id="hotel-form-{{ $hotel['hotel_code'] }}" method="POST"
                                action="{{ route('hotel.review', ['slug' => $hotel['slug']]) }}?{{ http_build_query($hotel['query'] ?? []) }}"
                                style="display: none;">
                                @csrf
                                <input type="hidden" name="booking_code" value="{{ $hotel['selected_room']['BookingCode'] }}">
                            </form>
                        </div>
                        <div>
                            @if (!empty($hotel['other_rooms']))
                                <a href="#" class="listing-htl-more-rooms-link mt-2 w-100"
                                    onclick="event.preventDefault(); document.getElementById('hotel-list-form-{{ $hotel['hotel_code'] }}').submit();">
                                    +{{ count($hotel['other_rooms'])}} more rooms
                                </a>
                                <form id="hotel-list-form-{{ $hotel['hotel_code'] }}" method="POST"
                                    action="{{ route('hotel.static', ['slug' => $hotel['slug']]) }}?{{ http_build_query($hotel['query'] ?? []) }}"
                                    style="display: none;">
                                    @csrf
                                    <input type="hidden" name="booking_code" value="{{ $hotel['booking_code'] ?? '' }}">
                                    <input type="hidden" name="selected_room"
                                        value="{{ base64_encode(json_encode($hotel['selected_room'] ?? [])) }}">
                                    <input type="hidden" name="other_rooms"
                                        value="{{ base64_encode(json_encode($hotel['other_rooms'] ?? [])) }}">
                                </form>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="no-results">No hotels found</div>
@endif