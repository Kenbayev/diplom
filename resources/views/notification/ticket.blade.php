

<body style="background-color: #f1f1f1;">
    <div class="container">
        @foreach(json_decode($result) as $item)
        <div class="sold_tickets_container" style="background:#fff!important;">
            <div class="sold_ticket" style="display: flex;
            align-items: center;
            justify-content: flex-start; background:#fff!important;">
                <div class="left_side" style="border-right: 2px dotted #ccc;
            padding: 20px;
            border-radius: 10px 0 0 10px;">
                    <div class="airline_logo" style="margin-bottom: 10px;">
                        <img src="{{ $item->company_img }}" width="150px" alt="">
                    </div>
                    <div class="qr_code">
                        <img src="{{ $item->ticket_qr_token }}" width="150px" alt="">
                    </div>
                </div>
                <div class="right_side" style="padding: 20px;
            width: 100%;">
                    <div class="from_to_info" style="display: flex;
            align-items: center;
            justify-content: space-between;">
                        <div class="from">
                            <p style=" text-transform: uppercase;">{{ $item->city_from }} <span>({{ $item->flight_from_city_iso }})</span> <i class="fa-solid fa-location-dot"></i></p>
                        </div>
                        <div class="way" style=" border-bottom: 2px dotted #000;
            width: 23%;"></div>
                        <div class="time_to_fly" style="text-align: center;">
                            <p style=" text-transform: uppercase;margin: 0;"> {{ $item->flying_time }}</p>
                            <p style=" text-transform: uppercase;margin: 0;"><i class="fa-solid fa-plane"></i></p>
                        </div>
                        <div class="way"style=" border-bottom: 2px dotted #000;
            width: 23%;"></div>
                        <div class="to">
                            <p style=" text-transform: uppercase;margin: 0;"><i class="fa-solid fa-location-dot"></i> {{ $item->city_to }} <span>({{ $item->flight_to_city_iso }})</span></p>
                        </div>

                    </div>
                    <div class="dates" style="display: flex;
            align-items: center;
            justify-content: space-between;">
                        <div class="dep_date">
                            <p style=" text-transform: uppercase;margin: 0;"> {{ date('d.m.Y H:i', strtotime($item->departure_date_at)) }}</p>
                        </div>
                        <div class="arr_date">
                            <p style=" text-transform: uppercase;margin: 0;">{{ date('d.m.Y H:i', strtotime($item->arrival_date_at)) }}</p>
                        </div>
                    </div>
                    <div class="flight_informations" style="display: flex;
            align-items: center;
            justify-content: space-between;">
                        <div class="f_code" style="width: 100%;">
                            <p style=" text-transform: uppercase;margin: 0;">FLIGHT ID</p>
                            <p style=" text-transform: uppercase;margin: 0;">{{ $item->flight_code }}</p>
                        </div>
                        <div class="passenger" style="width: 100%;">
                            <h5 style="margin: 0;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;">{{ $item->passenger_name }}</h5>
                            <h5 style="margin: 0;
        text-align: center;
        font-weight: bold;
        text-transform: uppercase;">{{ $item->passenger_lastname }}</h5>
                        </div>
                        <div class="seats_class" style="width: 100%;">
                            <p style=" text-transform: uppercase;margin: 0;text-align: right;">@if(str_contains($item->number_seats,'F')) <span>First class</span> @elseif(str_contains($item->number_seats,'B')) <span>Business class</span> @elseif(str_contains($item->number_seats,'E')) <span>Economy class</span> @endif</span></p>
                            <p style=" text-transform: uppercase;margin: 0;text-align: right;">Seat № {{ $item->number_seats }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <p class="text_center" style="text-align:center;">Link: <a href="{{ $item->ticket_url }}">This ticket link</a></p>
        @endforeach
    </div>
</body>


</html>