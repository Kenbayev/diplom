<?php

namespace App\Http\Controllers;

use App\Models\Flights;
use App\Models\Airlines;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Arr;
use DB;

class FlightsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(DB $db)
    {
        $flights = Flights::all();
        

        return view('flights.index', compact('flights'));
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
       
        $dep_at = Carbon::parse($request->departure_date_at);
        $arr_at = Carbon::parse($request->arrival_date_at);
        
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

        $flights = $flights::where('id', $id)->update($request->except(['_token','_method']));

        return redirect()->route('flights.index')->with('success','Flights updated successfully.');
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
        return redirect()->route('flights.index')->with('success','post deleted successfully');
    }
}
