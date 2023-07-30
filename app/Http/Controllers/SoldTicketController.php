<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AirlineTicket;
use App\Models\Passenger;
use App\Models\Flights;
use Spatie\Browsershot\Browsershot;
use App\Notifications\SendTicket;
use Notification;

class SoldTicketController extends Controller
{
    public function index()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url_token = explode('/', $url);
        $ticket = AirlineTicket::where('ticket_token', $url_token[2])->get();
        $ticket_result = [];
        foreach ($ticket as $value) {
            $pass_info = Passenger::where('id', $value['passenger_id'])->get();
            $flight = Flights::where('flight_code', $value['flight_code'])->get();
            $ticket_result[] = array(
                'id' => $value['id'],
                'flight_code' => $value['flight_code'],
                'airlines' => $value['airlines'],
                'aircraft' => $value['aircraft'],
                'departure_date_at' => $value['departure_date_at'],
                'flying_time' => $value['flying_time'],
                'arrival_date_at' => $value['arrival_date_at'],
                'flight_from_city_iso' => $value['flight_from_city_iso'],
                'flight_to_city_iso' => $value['flight_to_city_iso'],
                'number_seats' => $value['number_seats'],
                'ticket_token' => $value['ticket_token'],
                'ticket_qr_token' => $value['ticket_qr_token'],
                'ticket_url' => $value['ticket_url'],
                'ticket_qr_url' => $value['ticket_qr_url'],
                'passenger_id' => $value['passenger_id'],
                'ticket_status' => $value['ticket_status'],
                'payment_id' => $value['payment_id'],
                'baggage' => $value['baggage'],
                'price' => $value['price'],
                'company_img' => $value['company_img'],
                'default_price' => $value['default_price'],
                'passenger_name' => $pass_info[0]['name'],
                'passenger_lastname' => $pass_info[0]['last_name'],
                'city_from' => $flight[0]['flight_from_city'],
                'city_to' => $flight[0]['flight_to_city'],
            );
        }

        $result = json_encode($ticket_result);
        // $user = 'Kenbayev94@mail.ru';
        // Notification::route('mail', $user)
        //     ->notify(new SendTicket($result));

        return view('ticket', compact('result'));
    }
}
