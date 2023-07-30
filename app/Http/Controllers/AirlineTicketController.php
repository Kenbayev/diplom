<?php

namespace App\Http\Controllers;

use App\Models\AirlineTicket;
use App\Models\Flights;
use App\Models\Airlines;
use Illuminate\Http\Request;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Carbon;

class AirlineTicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $request->validate([
            'flight_code' => 'required'
        ]);
        $tickets = AirlineTicket::where('flight_code', $request->flight_code)->get();
        
        
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'id' => 'required'
        ]);
        $flight = Flights::where('id', $request->id)->get();

        $range_f = range(1, $flight[0]['f_class']);
        $res_f = [];
        foreach ($range_f as $key => $value) {
            $bytes = random_bytes(16);
            $token = bin2hex($bytes);
            $image = \QrCode::format('png')
                ->merge('https://airfly.kz/storage/logo.png', 0.5, true)
                ->style('round')
                ->size(512)->errorCorrection('H')
                ->generate($token);
            $filename = 'img-' . $token . '.png';
            $output_file = '/public/ticket_qr/' . $filename;
            $result = Storage::disk('local')->put($output_file, $image);
            $token_qr_url = 'https://airfly.kz/storage/ticket_qr/'.$filename;
            
            $default_price = Airlines::where('name', 'like', '%'.$flight[0]['airlines'].'%')->get();
            $f_default_price = $default_price[0]['default_price'] * 5;

            $dep_date = Carbon::parse($flight[0]['departure_date_at']);
            $arr_date = Carbon::parse($flight[0]['arrival_date_at']);
            $res_f[] = AirlineTicket::create([
                'flight_code' => $flight[0]['flight_code'],
                'airlines' => $flight[0]['airlines'],
                'aircraft' => $flight[0]['aircraft'],
                'departure_date_at' => $dep_date,
                'flying_time' => $flight[0]['flying_time'],
                'arrival_date_at' => $arr_date,
                'flight_from_city_iso' => $flight[0]['flight_from_city_iso'],
                'flight_to_city_iso' => $flight[0]['flight_to_city_iso'],
                'number_seats' => 'F' . $value,
                'ticket_token' => $token,
                'ticket_qr_token' => $token_qr_url,
                'ticket_url' => '',
                'ticket_qr_url' => '',
                'passenger_id' => '',
                'ticket_status' => '',
                'payment_id' => '',
                'baggage' => '',
                'price' => '',
                'default_price' => $f_default_price,
                'company_img' => $default_price[0]['company_img']
            ]);
        }
        
        $range_b = range(1, $flight[0]['b_class']);
        $res_b = [];
        foreach ($range_b as $key => $value) {
            $bytes = random_bytes(16);
            $token = bin2hex($bytes);
            $image = \QrCode::format('png')
                ->merge('https://airfly.kz/storage/logo.png', 0.5, true)
                ->style('round')
                ->size(512)->errorCorrection('H')
                ->generate($token);
            $filename = 'img-' . $token . '.png';
            $output_file = '/public/ticket_qr/' . $filename;
            $result = Storage::disk('local')->put($output_file, $image);
            $token_qr_url = 'https://airfly.kz/storage/ticket_qr/'.$filename;
            $default_price = Airlines::where('name', 'like', '%'.$flight[0]['airlines'].'%')->get();
            $b_default_price = $default_price[0]['default_price'] * 3;

            $dep_date = Carbon::parse($flight[0]['departure_date_at']);
            $arr_date = Carbon::parse($flight[0]['arrival_date_at']);

            $res_b[] = AirlineTicket::create([
                'flight_code' => $flight[0]['flight_code'],
                'airlines' => $flight[0]['airlines'],
                'aircraft' => $flight[0]['aircraft'],
                'departure_date_at' => $dep_date,
                'flying_time' => $flight[0]['flying_time'],
                'arrival_date_at' => $arr_date,
                'flight_from_city_iso' => $flight[0]['flight_from_city_iso'],
                'flight_to_city_iso' => $flight[0]['flight_to_city_iso'],
                'number_seats' => 'B' . $value,
                'ticket_token' => $token,
                'ticket_qr_token' => $token_qr_url,
                'ticket_url' => '',
                'ticket_qr_url' => '',
                'passenger_id' => '',
                'ticket_status' => '',
                'payment_id' => '',
                'baggage' => '',
                'price' => '',
                'default_price' => $b_default_price,
                'company_img' => $default_price[0]['company_img']
            ]);
        }

        $range_e = range(1, $flight[0]['e_class']);
        $res_e = [];
        foreach ($range_e as $key => $value) {
            $bytes = random_bytes(16);
            $token = bin2hex($bytes);
            $image = \QrCode::format('png')
                ->merge('https://airfly.kz/storage/logo.png', 0.5, true)
                ->style('round')
                ->size(512)->errorCorrection('H')
                ->generate($token);
            $filename = 'img-' . $token . '.png';
            $output_file = '/public/ticket_qr/' . $filename;
            $result = Storage::disk('local')->put($output_file, $image);
            $token_qr_url = 'https://airfly.kz/storage/ticket_qr/'.$filename;
            $default_price = Airlines::where('name', 'like', '%'.$flight[0]['airlines'].'%')->get();

            $dep_date = Carbon::parse($flight[0]['departure_date_at']);
            $arr_date = Carbon::parse($flight[0]['arrival_date_at']);

            $res_e[] = AirlineTicket::create([
                'flight_code' => $flight[0]['flight_code'],
                'airlines' => $flight[0]['airlines'],
                'aircraft' => $flight[0]['aircraft'],
                'departure_date_at' => $dep_date,
                'flying_time' => $flight[0]['flying_time'],
                'arrival_date_at' => $arr_date,
                'flight_from_city_iso' => $flight[0]['flight_from_city_iso'],
                'flight_to_city_iso' => $flight[0]['flight_to_city_iso'],
                'number_seats' => 'E' . $value,
                'ticket_token' => $token,
                'ticket_qr_token' => $token_qr_url,
                'ticket_url' => '',
                'ticket_qr_url' => '',
                'passenger_id' => '',
                'ticket_status' => '',
                'payment_id' => '',
                'baggage' => '',
                'price' => '',
                'default_price' => $default_price[0]['default_price'],
                'company_img' => $default_price[0]['company_img']
            ]);
        }
        
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AirlineTicket  $airlineTicket
     * @return \Illuminate\Http\Response
     */
    public function show(AirlineTicket $airlineTicket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AirlineTicket  $airlineTicket
     * @return \Illuminate\Http\Response
     */
    public function edit(AirlineTicket $airlineTicket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AirlineTicket  $airlineTicket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AirlineTicket $airlineTicket)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AirlineTicket  $airlineTicket
     * @return \Illuminate\Http\Response
     */
    public function destroy(AirlineTicket $airlineTicket)
    {
        //
    }
}
