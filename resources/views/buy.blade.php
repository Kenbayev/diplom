<x-app-layout>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="info_ticket">
                    @if($data['notice'] == false)
                    <p class="notice"><i class="fa-solid fa-circle-exclamation"></i> @lang('public.Attention') {{$data['count_form']}}</p>
                    @endif
                    <div class="fly_infos">
                        <div class="about_airline">
                            <p><img class="c_img" src="{{$data['ticket']['company_img']}}"></p>
                            <p class="airlines"><span class="airline">{{$data['ticket']['airlines']}} </span>/<span class="fly_class">@if(str_contains($data['ticket']['number_seats'],'F')) <span>@lang('public.Luxury')</span> @elseif(str_contains($data['ticket']['number_seats'],'B')) <span>@lang('public.Business')</span> @elseif(str_contains($data['ticket']['number_seats'],'E')) <span>@lang('public.Economy')</span> @endif</span></p>
                        </div>
                        <div class="froms">
                            <p>@lang('public.Departure_from'): {{$data['city_from']}} ({{$data['ticket']['flight_from_city_iso']}})</p>
                            <p>@lang('public.Departure_date/time'): {{$data['ticket']['departure_date_at']}}</p>
                        </div>
                        <div class="go_to">
                            <p>@lang('public.Arrival_in'): {{$data['city_to']}} ({{$data['ticket']['flight_to_city_iso']}})</p>
                            <p>@lang('public.Arrival_date/time'): {{$data['ticket']['arrival_date_at']}}</p>

                        </div>
                        <div class="other_info">
                            <p>@lang('public.Flight_time'): {{$data['ticket']['flying_time']}}</p>
                            <p>@lang('public.Additional_information'):<a class="bag" href="#" data-tooltip="@lang('public.bag_info')"><i class="fa-solid fa-cart-flatbed-suitcase"></i></a><a class="carry-on" href="#" data-tooltip="@lang('public.bag_info_to')"><i class="fa-solid fa-person-walking-luggage"></i></a></p>
                        </div>
                    </div>
                </div>

                <div class="forms">
                    <form action="/sold" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-8">
                                <div class="block_info_passenger">
                                    @for ($i = 1; $i <= $data['count_form']; $i++) <div class="passenger_form">
                                        <div class="form-groupe">
                                            <div class="d-flex">
                                                <div>
                                                    <input type="text" class="hidden" name="count_form" value="{{$data['count_form']}}">
                                                    <label for="sex">@lang('public.Sex') <span>*</span></label>
                                                    <select name="passengers_sex{{$i}}" id="sex{{$i}}">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                    </select>
                                                </div>
                                                <div>
                                                    <label for="pas_name">@lang('public.Your_name') <span>*</span></label>
                                                    <input type="text" id="pas_name" name="passengers_name{{$i}}" placeholder="Your name" required>
                                                </div>
                                                <div>
                                                    <label for="pas_lastname">@lang('public.Your_lastname') <span>*</span></label>
                                                    <input type="text" id="pas_lastname" name="passengers_lastname{{$i}}" placeholder="Your lastname" required>
                                                </div>
                                                <div>
                                                    <label for="birth_day">@lang('public.Date_of_birth') <span>*</span></label>
                                                    <input type="date" id="birth_day" name="passengers_birth_day{{$i}}" placeholder="Date of birth" required>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="form-groupe">
                                            <div class="d-flex">
                                                <div>
                                                    <label for="citizen">@lang('public.Citizenship') <span>*</span></label>
                                                    <input type="text" id="citizen" name="passengers_citizen{{$i}}" placeholder="Citizenship" required>
                                                </div>
                                                <div>
                                                    <label for="doc_number">@lang('public.Document_no')<span>*</span></label>
                                                    <input type="text" id="doc_number" name="passengers_doc_num{{$i}}" placeholder="Document no." required>
                                                </div>
                                                <div>
                                                    <label for="issue_date">@lang('public.Issue_date') <span>*</span></label>
                                                    <input type="date" id="issue_date" name="passengers_issue_date{{$i}}" placeholder="Issue date" required>
                                                </div>
                                                <div>
                                                    <label for="expiry">@lang('public.Date_of_expiry') <span>*</span></label>
                                                    <input type="date" id="expiry" name="passengers_expiry{{$i}}" placeholder="Date of expiry" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-groupe">
                                            <div class="d-flex content_bottom">
                                                <div>
                                                    <label for="issue_by">@lang('public.Issue_by') <span>*</span></label>
                                                    <input type="text" id="issue_by" name="passengers_issue_by{{$i}}" placeholder="Issue by" required>
                                                </div>
                                                <div>
                                                    
                                                    <input type="checkbox" id="baggage{{$i}}" name="passengers_baggage{{$i}}">
                                                    <label for="baggage{{$i}}">@lang('public.Additional_baggage')</label>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                                @endfor
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="credit_card">
                                <div class="form-groupe">
                                    <div class="d-flex contact_info">
                                        <div>
                                            <label for="email">@lang('public.Email')<span>*</span></label>
                                            <input type="text" id="email" name="email" placeholder="Email" required>
                                        </div>
                                        <div>
                                            <label for="phone">@lang('public.Phone_number')</label>
                                            <input type="text" id="phone" name="phone" placeholder="Phone number" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-groupe">
                                    <div class="d-flex card_info">
                                        <div>
                                            <label for="card_id">@lang('public.Card_number')<span>*</span></label>
                                            <input type="text" id="card_id" name="card_id" placeholder="16-digit number" required>
                                        </div>
                                    </div>
                                    <div class="d-flex card_info">
                                        <div>
                                            <label for="card_name">@lang('public.Name') <span>*</span></label>
                                            <input type="text" id="card_name" name="card_name" placeholder="Name" required>
                                        </div>
                                        <div>
                                            <label for="card_lastname">@lang('public.Last_name') </label>
                                            <input type="text" id="card_lastname" name="card_lastname" placeholder="Last name" required>
                                        </div>
                                    </div>
                                    <div class="d-flex card_info">
                                        <div>
                                            <label for="card_expiry">@lang('public.Expiration_date')<span>*</span></label>
                                            <input type="text" id="card_expiry" name="card_expiry" placeholder="mm / yy" required>
                                        </div>
                                        <div>
                                            <label for="csv">CSV</label>
                                            <input type="text" id="csv" name="csv" placeholder="CSV" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="total">
                                <input type="text" class="hidden" name="tickets_id" value="{{json_encode($data['tickets_id'])}}">
                                <input type="text" class="hidden" name="total_price" value="{{$data['total_price']}}">
                                <input type="text" class="hidden" name="ticket_token" value="{{$data['ticket_token']}}">

                                <p>@lang('public.Total'): {{ $data['total_price'] }}</p>
                                <input type="submit" value="@lang('public.Buy_tickets')">
                            </div>
                        </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    </div>
    <script src="https://unpkg.com/imask"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script>
        var phoneMask = IMask(
            document.getElementById('phone'), {
                mask: '+{7}(000)000-00-00'
            });

        $(document).ready(function() {
            $('#card_id').mask('0000 0000 0000 0000');
        });
        $(document).ready(function() {
            $('#card_expiry').mask('00 / 00');
        });
        $(document).ready(function() {
            $('#csv').mask('000', {
                reverse: true
            });
        });
    </script>
</x-app-layout>