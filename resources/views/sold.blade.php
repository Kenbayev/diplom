<x-app-layout>
    <div class="container">
        @foreach(json_decode($result) as $item)
        <div class="sold_tickets_container">
            <div class="sold_ticket">
                <div class="left_side">
                    <div class="airline_logo">
                        <img src="{{ $item->company_img }}" width="150px" alt="">
                    </div>
                    <div class="qr_code">
                        <img src="{{ $item->ticket_qr_token }}" width="150px" alt="">
                    </div>
                </div>
                <div class="right_side">
                    <div class="from_to_info">
                        <div class="from">
                            <p>{{ $item->city_from }} <span>({{ $item->flight_from_city_iso }})</span> <i class="fa-solid fa-location-dot"></i></p>
                        </div>
                        <div class="way"></div>
                        <div class="time_to_fly">
                            <p>{{ $item->flying_time }}</p>
                            <p><i class="fa-solid fa-plane"></i></p>
                        </div>
                        <div class="way"></div>
                        <div class="to">
                            <p><i class="fa-solid fa-location-dot"></i> {{ $item->city_to }} <span>({{ $item->flight_to_city_iso }})</span></p>
                        </div>

                    </div>
                    <div class="dates">
                        <div class="dep_date">
                            <p>{{ date('d.m.Y H:i', strtotime($item->departure_date_at)) }}</p>
                        </div>
                        <div class="arr_date">
                            <p>{{ date('d.m.Y H:i', strtotime($item->arrival_date_at)) }}</p>
                        </div>
                    </div>
                    <div class="flight_informations">
                        <div class="f_code">
                            <p>FLIGHT ID</p>
                            <p>{{ $item->flight_code }}</p>
                        </div>
                        <div class="passenger">
                            <h5>{{ $item->passenger_name }}</h5>
                            <h5>{{ $item->passenger_lastname }}</h5>
                        </div>
                        <div class="seats_class">
                            <p>@if(str_contains($item->number_seats,'F')) <span>First class</span> @elseif(str_contains($item->number_seats,'B')) <span>Business class</span> @elseif(str_contains($item->number_seats,'E')) <span>Economy class</span> @endif</span></p>
                            <p>Seat № {{ $item->number_seats }}</p>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        <p class="text_center">Link: <a href="{{ $item->ticket_url }}">This ticket link</a></p>
        @endforeach
    </div>
</x-app-layout>