<x-app-layout>


    <div class="container">
        <div class="body_block">
            <table class="table mt-4">
                <thead class="table-dark">
                    <tr>
                        <th scope="col" width="50">
                            ID
                        </th>
                        <th scope="col">
                            ticket code
                        </th>
                        <th scope="col">
                            Airlines
                        </th>
                        <th scope="col">
                            Aircraft
                        </th>
                        <th scope="col">
                            Departure/Arrival
                        </th>

                        <th scope="col">
                            From/To
                        </th>
                        <th scope="col">
                            Flying time
                        </th>
                        <th scope="col">
                            Seats
                        </th>
                        <th scope="col">
                            Ticket token
                        </th>

                        <th scope="col">
                            Token QR code
                        </th>
                        <th scope="col">
                            Ticket URL
                        </th>
                        <th scope="col">
                            URL QR code
                        </th>
                        <th scope="col">
                            Passenger
                        </th>
                        <th scope="col">
                            Status
                        </th>
                        <th scope="col">
                            Payment ID
                        </th>
                        <th scope="col">
                            Baggage
                        </th>
                        <th scope="col">
                            Price
                        </th>
                        <th scope="col">
                            Default price
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200 text-center">
                    @foreach ($tickets as $ticket)
                    <tr>
                        <td>
                            {{ $ticket->id }}
                        </td>

                        <td>
                            {{ $ticket->flight_code }}
                        </td>

                        <td>

                            {{ $ticket->airlines }}

                        </td>

                        <td>
                            {{ $ticket->aircraft }}
                        </td>

                        <td>
                            {{ date('d.m.Y H:i:s', strtotime($ticket->departure_date_at)) }}<br> - <br>{{ date('d.m.Y H:i:s', strtotime($ticket->arrival_date_at)) }}
                        </td>

                        <td>
                            {{ $ticket->flight_from_city_iso }}<br> - <br>{{ $ticket->flight_to_city_iso }}
                        </td>
                        <td>
                            {{ $ticket->flying_time }}
                        </td>
                        <td>
                            {{ $ticket->number_seats }}
                        </td>

                        <td>
                            {{ $ticket->ticket_token }}
                        </td>

                        <td>
                            <img src="{{ $ticket->ticket_qr_token }}" width="50px" alt="">
                        </td>

                        <td>
                            {{ $ticket->ticket_url }}
                        </td>

                        <td>
                            {{ $ticket->ticket_qr_url }}
                        </td>

                        <td>
                            {{ $ticket->passenger_id }}
                        </td>

                        <td>
                            {{ $ticket->ticket_status }}
                        </td>

                        <td>
                            {{ $ticket->payment_id }}
                        </td>

                        <td>
                            {{ $ticket->baggage }}
                        </td>
                        <td>
                            {{ $ticket->price }}
                        </td>
                        <td>
                            {{ $ticket->default_price }}
                        </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>