<?php

namespace App\Http\Controllers;

use App\Models\Flights;
use App\Models\Airlines;
use App\Models\AirlineTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;
use DB;
use Illuminate\Support\Collection;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexFrom(Request $request)
    {

        $query = $request->input('query_from');

        // Ищем посты, содержащие запрос в заголовке или содержании
        $posts = Flights::where('flight_from_city', 'like', '%' . $query . '%')
            ->orWhere('flight_from_country', 'like', '%' . $query . '%')
            ->orWhere('flight_from_city_iso', 'like', '%' . $query . '%')
            ->get();
        $uniq_result = [];
        foreach ($posts as $value) {
            $uniq_result[] = [
                'iso' => $value['flight_from_city_iso'],
                'city' => $value['flight_from_city']
            ];
        }
        $res = collect($uniq_result)->unique();
        // Возвращаем результаты поиска в формате JSON
        return response()->json($res);
    }

    public function indexTo(Request $request)
    {

        $query = $request->input('query_to');

        // Ищем посты, содержащие запрос в заголовке или содержании
        $posts = Flights::where('flight_to_city', 'like', '%' . $query . '%')
            ->orWhere('flight_to_country', 'like', '%' . $query . '%')
            ->orWhere('flight_to_city_iso', 'like', '%' . $query . '%')
            ->get();
        $uniq_result = [];
        foreach ($posts as $value) {
            $uniq_result[] = [
                'iso' => $value['flight_to_city_iso'],
                'city' => $value['flight_to_city']
            ];
        }
        $res = collect($uniq_result)->unique();
        // Возвращаем результаты поиска в формате JSON
        return response()->json($res);
    }

    public function search_ticket(Request $request)
    {
        $request->validate([
            'query_from' => '',
            'query_to' => '',
            'dep_date' => '',
            'arr_date' => '',
            'a_passenger' => '',
            'c_passenger' => '',
            'i_passenger' => '',
        ]);
        $data = $request->all();
        if (isset($data['arr_date'])) {

            $posts_one = AirlineTicket::where('flight_from_city_iso', $data['query_from'])
                ->where('ticket_status', '')
                ->where('flight_to_city_iso', $data['query_to'])
                ->get();

            $tickets_oneway = [];
            foreach ($posts_one as $post) {
                $dep = Carbon::parse($post['departure_date_at'])->format('Y-m-d');
                $arr = Carbon::parse($post['arrival_date_at'])->format('Y-m-d');
                $client_dep = Carbon::parse($data['dep_date'])->format('Y-m-d');
                $client_arr = Carbon::parse($data['arr_date'])->format('Y-m-d');
                if ($client_dep >= $dep) {

                    $tickets_oneway[] = [
                        'id' => $post['id'],
                        'flight_code' => $post['flight_code'],
                        'airlines' => $post['airlines'],
                        'aircraft' => $post['aircraft'],
                        'company_img' => $post['company_img'],
                        'departure_date_at' => $post['departure_date_at'],
                        'flying_time' => $post['flying_time'],
                        'arrival_date_at' => $post['arrival_date_at'],
                        'flight_from_city_iso' => $post['flight_from_city_iso'],
                        'flight_to_city_iso' => $post['flight_to_city_iso'],
                        'number_seats' => $post['number_seats'],
                        'ticket_token' => $post['ticket_token'],
                        'ticket_qr_token' => $post['ticket_qr_token'],
                        'ticket_url' => $post['ticket_url'],
                        'ticket_qr_url' => $post['ticket_qr_url'],
                        'passenger_id' => $post['passenger_id'],
                        'ticket_status' => $post['ticket_status'],
                        'payment_id' => $post['payment_id'],
                        'default_price' => $post['default_price'],
                        'come_back' => false,
                    ];
                }
            }

            $posts_two = AirlineTicket::where('flight_from_city_iso', $data['query_to'])
                ->where('flight_to_city_iso', $data['query_from'])
                ->where('ticket_status', '')
                ->get();
            // return $posts_two;
            $tickets_twoway = [];
            foreach ($posts_two as $post) {
                // $dep = Carbon::parse($post['departure_date_at'])->format('Y-m-d');
                $arr = Carbon::parse($post['arrival_date_at'])->format('Y-m-d');
                // $client_dep = Carbon::parse($data['dep_date'])->format('Y-m-d');
                $client_arr = Carbon::parse($data['arr_date'])->format('Y-m-d');
                if ($client_arr <= $arr) {

                    $tickets_twoway[] = [
                        'id' => $post['id'],
                        'flight_code' => $post['flight_code'],
                        'airlines' => $post['airlines'],
                        'aircraft' => $post['aircraft'],
                        'company_img' => $post['company_img'],
                        'departure_date_at' => $post['departure_date_at'],
                        'flying_time' => $post['flying_time'],
                        'arrival_date_at' => $post['arrival_date_at'],
                        'flight_from_city_iso' => $post['flight_from_city_iso'],
                        'flight_to_city_iso' => $post['flight_to_city_iso'],
                        'number_seats' => $post['number_seats'],
                        'ticket_token' => $post['ticket_token'],
                        'ticket_qr_token' => $post['ticket_qr_token'],
                        'ticket_url' => $post['ticket_url'],
                        'ticket_qr_url' => $post['ticket_qr_url'],
                        'passenger_id' => $post['passenger_id'],
                        'ticket_status' => $post['ticket_status'],
                        'payment_id' => $post['payment_id'],
                        'default_price' => $post['default_price'],
                        'come_back' => true,
                    ];
                }
            }


            $array1 = $tickets_oneway;
            $array2 = $tickets_twoway;
            $result = [];

            // определение минимальной длины массивов
            $minLength = min(count($array1), count($array2));

            // чередование элементов
            for ($i = 0; $i < $minLength; $i++) {
                $result[] = $array1[$i];
                $result[] = $array2[$i];
            }

            // добавление оставшихся элементов массивов
            $result = array_merge($result, array_slice($array1, $minLength), array_slice($array2, $minLength));

            

            return $result;
        } else {
            $posts = AirlineTicket::where('flight_from_city_iso', $data['query_from'])
                ->where('flight_to_city_iso', $data['query_to'])
                // ->whereDate('departure_date_at', '>', Carbon::parse($data['dep_date'])->format('Y-m-d\TH:m'))
                ->get();
            return $posts;
            $tickets = [];
            foreach ($posts as $post) {
                $dep = Carbon::parse($post['departure_date_at'])->format('Y-m-d');
                $arr = Carbon::parse($post['arrival_date_at'])->format('Y-m-d');
                $client_dep = Carbon::parse($data['dep_date'])->format('Y-m-d');
                $client_arr = Carbon::parse($data['arr_date'])->format('Y-m-d');
                if ($client_dep >= $dep) {

                    $tickets[] = [
                        'id' => $post['id'],
                        'flight_code' => $post['flight_code'],
                        'airlines' => $post['airlines'],
                        'aircraft' => $post['aircraft'],
                        'company_img' => $post['company_img'],
                        'departure_date_at' => $post['departure_date_at'],
                        'flying_time' => $post['flying_time'],
                        'arrival_date_at' => $post['arrival_date_at'],
                        'flight_from_city_iso' => $post['flight_from_city_iso'],
                        'flight_to_city_iso' => $post['flight_to_city_iso'],
                        'number_seats' => $post['number_seats'],
                        'ticket_token' => $post['ticket_token'],
                        'ticket_qr_token' => $post['ticket_qr_token'],
                        'ticket_url' => $post['ticket_url'],
                        'ticket_qr_url' => $post['ticket_qr_url'],
                        'passenger_id' => $post['passenger_id'],
                        'ticket_status' => $post['ticket_status'],
                        'payment_id' => $post['payment_id'],
                        'default_price' => $post['default_price']
                    ];
                }
            }
            return $tickets;
        }


        // return response()->json($posts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $airlines = Airlines::all();

        return view('flights.create', compact('airlines'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'aircraft' => 'required',
            'airlines' => 'required',
            'flight_code' => 'required',
            'flight_from_country' => 'required',
            'flight_from_city' => 'required',
            'flight_from_city_iso' => 'required',
            'flight_to_country' => 'required',
            'flight_to_city' => 'required',
            'flight_to_city_iso' => 'required',
            'flying_time' => 'required',
            'departure_date_at' => 'required',
            'arrival_date_at' => 'required',
            'f_class' => 'required',
            'b_class' => 'required',
            'e_class' => 'required',
        ]);
        $dep_at = Carbon::parse($request->departure_date_at)->format('d-m-Y H:m');
        $arr_at = Carbon::parse($request->arrival_date_at)->format('d-m-Y H:m');
        // dd($request);
        Flights::create([
            'aircraft' => $request->aircraft,
            'airlines' => $request->airlines,
            'flight_code' => $request->flight_code,
            'flight_from_country' => $request->flight_from_country,
            'flight_from_city' => $request->flight_from_city,
            'flight_from_city_iso' => $request->flight_from_city_iso,
            'flight_to_country' => $request->flight_to_country,
            'flight_to_city' => $request->flight_to_city,
            'flight_to_city_iso' => $request->flight_to_city_iso,
            'flying_time' => $request->flying_time,
            'departure_date_at' => $dep_at,
            'arrival_date_at' => $arr_at,
            'f_class' => $request->f_class,
            'b_class' => $request->b_class,
            'e_class' => $request->e_class,
        ]);

        return redirect()->route('flights.index')->with('success', 'Flights created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Flights  $flights
     * @return \Illuminate\Http\Response
     */
    public function show(Flights $flights, $id)
    {
        $flights = $flights::find($id);
        $airlines = Airlines::all();
        return view('flights.show', compact('flights'))->with('airlines', $airlines);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Flights  $flights
     * @return \Illuminate\Http\Response
     */
    public function edit(Flights $flights, $id)
    {
        $flights = $flights::find($id);
        $airlines = Airlines::all();
        $arrival_time = Carbon::parse($flights->arrival_date_at)->format('Y-m-d\TH:i');
        $departure_time = Carbon::parse($flights->departure_date_at)->format('Y-m-d\TH:i');
        return view('flights.edit', compact('flights'))
            ->with('airlines', $airlines)
            ->with('arrival', $arrival_time)
            ->with('departure', $departure_time);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Flights  $flights
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Flights $flights, $id)
    {
        $request->validate([
            'aircraft' => '',
            'airlines' => '',
            'flight_code' => '',
            'flight_from_country' => '',
            'flight_from_city' => '',
            'flight_from_city_iso' => '',
            'flight_to_country' => '',
            'flight_to_city' => '',
            'flight_to_city_iso' => '',
            'flying_time' => '',
            'departure_date_at' => '',
            'arrival_date_at' => '',
            'f_class' => '',
            'b_class' => '',
            'e_class' => '',
        ]);

        $flights = $flights::where('id', $id)->update($request->except(['_token', '_method']));

        return redirect()->route('flights.index')->with('success', 'Flights updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Flights  $flights
     * @return \Illuminate\Http\Response
     */
    public function destroy(Flights $flights, $id)
    {
        $flights = $flights::find($id);
        $flights->delete();
        return redirect()->route('flights.index')->with('success', 'post deleted successfully');
    }
}
