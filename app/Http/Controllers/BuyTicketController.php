<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Flights;
use App\Models\AirlineTicket;
use App\Models\Passenger;
use App\Models\CreditCardInformation;
use App\Notifications\SendTicket;
use Notification;

class BuyTicketController extends Controller
{

    public function buyTicket(Request $request)
    {
        $request->validate([
            'ticket_id' => '',
            'total_price' => '',
            'a_passenger' => '',
            'c_passenger' => '',
            'i_passenger' => '',
            'ticket_token' => ''
        ]);

        $data = $request->all();
        $ticket_info = AirlineTicket::where('id', $data['ticket_id'])->get();

        $count_ticket = $data['a_passenger'] +  $data['c_passenger'] +  $data['i_passenger'];

        $ticket_for_all = AirlineTicket::where('flight_code', $ticket_info[0]['flight_code'])
            ->where('number_seats', 'like', $ticket_info[0]['number_seats'][0] . '%')
            ->where('ticket_status', '')
            ->take($count_ticket)
            ->get();



        if (count($ticket_for_all) < $count_ticket) {
            $tickets_id = [];
            foreach ($ticket_for_all as $value) {
                $tickets_id[] = $value['id'];
            }
            $city_info = Flights::where('flight_code', $ticket_for_all[0]['flight_code'])->get();
            $data = [
                'notice' => false,
                'count_form' => count($ticket_for_all),
                'tickets_id' => $tickets_id,
                'ticket' => $ticket_for_all[0],
                'city_from' => $city_info[0]['flight_from_city'],
                'city_to' => $city_info[0]['flight_to_city'],
                'total_price' => $data['total_price'],
                'ticket_token' => $data['ticket_token'],
            ];
        } else if (count($ticket_for_all) >= $count_ticket) {
            $tickets_id = [];
            foreach ($ticket_for_all as $value) {
                $tickets_id[] = $value['id'];
            }
            $city_info = Flights::where('flight_code', $ticket_for_all[0]['flight_code'])->get();

            $data = [
                'notice' => true,
                'count_form' => $count_ticket,
                'tickets_id' => $tickets_id,
                'ticket' => $ticket_for_all[0],
                'city_from' => $city_info[0]['flight_from_city'],
                'city_to' => $city_info[0]['flight_to_city'],
                'total_price' => $data['total_price'],
                'ticket_token' => $data['ticket_token'],
            ];
        }

        $status = AirlineTicket::whereIn('id', $tickets_id)->update(array('ticket_status' => 'pending'));
        return view('buy', compact('data'));
    }


    public function store(Request $request)
    {
        // Получаем количество пассажиров из формы
        $passengersCount = $request->input('count_form');

        // Создаем массив для хранения данных пассажиров
        $passengersData = [];

        // Итерируемся по количеству пассажиров
        for ($i = 1; $i <= $passengersCount; $i++) {
            // Создаем массив для данных одного пассажира
            $passenger = [];

            // Заполняем массив данными одного пассажира
            $passenger['sex'] = $request->input('passengers_sex' . $i);
            $passenger['pas_name'] = $request->input('passengers_name' . $i);
            $passenger['lastname'] = $request->input('passengers_lastname' . $i);
            $passenger['birth_day'] = $request->input('passengers_birth_day' . $i);
            $passenger['citizen'] = $request->input('passengers_citizen' . $i);
            $passenger['doc_number'] = $request->input('passengers_doc_num' . $i);
            $passenger['issue_date'] = $request->input('passengers_issue_date' . $i);
            $passenger['expiry'] = $request->input('passengers_expiry' . $i);
            $passenger['issue_by'] = $request->input('passengers_issue_by' . $i);
            $passenger['baggage'] = $request->has('passengers_baggage' . $i);

            if ($passenger['baggage'] === false) {
                $bag = 'false';
            } else {
                $bag = 'true';
            }
            // dd($bag);

            // Добавляем данные пассажира в массив всех пассажиров
            $passengersData[] = Passenger::create([
                "sex" => $passenger['sex'],
                "name" => $passenger['pas_name'],
                "last_name" => $passenger['lastname'],
                "birth_day_at" => $passenger['birth_day'],
                "citizens" => $passenger['citizen'],
                "passport_id" => $passenger['doc_number'],
                "issue_date" => $passenger['issue_date'],
                "end_date" => $passenger['expiry'],
                "issued_by" => $passenger['issue_by'],
                "baggage" => $bag,
            ]);
        }
        // dd($passengersData);
        $paymentData = $request->validate([
            'email' => '',
            'phone' => '',
            'card_id' => '',
            'card_name' => '',
            'card_lastname' => '',
            'card_expiry' => '',
            'csv' => '',
            'tickets_id' => '',
            'total_price' => '',
            'ticket_token' => '',
        ]);

        $payment = CreditCardInformation::create([
            'credit_card_numer' => $paymentData['card_id'],
            'name' => $paymentData['card_name'],
            'last_name' => $paymentData['card_lastname'],
            'date_end_at' => $paymentData['card_expiry'],
            'passenger_id' => $passengersData[0]['id'],
            'csv_number' => $paymentData['csv'],
            'card_status' => true,
        ]);

        // dd($paymentData['tickets_id']);
        $tickets_ids = json_decode($paymentData['tickets_id']);
        foreach ($tickets_ids as $key => $ticket_id) {
            $passenger_id = $passengersData[$key]['id'];
            $token = AirlineTicket::where('id', $ticket_id)->get();
            $baggage = $passengersData[$key]['baggage'];
            $ticket = AirlineTicket::where('id', $ticket_id)->update([
                'passenger_id' => $passenger_id,
                'ticket_status' => 'sold',
                'payment_id' => $payment['id'],
                'baggage' => $baggage,
                'price' => $paymentData['total_price'],
                'ticket_url' => 'https://airfly.kz/ticket/'.$token[0]['ticket_token'].''
            ]);
        }

        foreach ($passengersData as $one_pas) {
            $update_ticket = Passenger::where('id', $one_pas['id'])->update(array(
                'card_id' => $payment['id'],
            ));
        }


        $all_info = [
            'passengers' => $passengersData,
            'payment_info' => $paymentData,
            'tickets_info' => $payment,
            'update_ticket' => $ticket
        ];
        // Далее можно использовать $passengersData для сохранения данных в БД или других операций

        $ticketss = AirlineTicket::whereIn('id', json_decode($paymentData['tickets_id']))->get();
        $ticket_result = [];
        foreach($ticketss as $value) {
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
        $user = $paymentData['email'];
        Notification::route('mail', $user)
            ->notify(new SendTicket($result));
        
        return view('sold', compact('result'));
    }
}
