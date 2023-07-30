<?php

namespace App\Http\Controllers;

use App\Models\Airlines;
use Illuminate\Http\Request;

class AirlinesController extends Controller
{
    public function index()
    {
        // abort_if(Gate::denies('airlines_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $airlines = Airlines::all();

        return view('airlines.index', compact('airlines'));
    }

    public function create()
    {
        // abort_if(Gate::denies('airlines_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('airlines.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'country_name' => 'required',
            'country_iso' => 'required',
            'default_price' => 'required'
        ]);
        Airlines::create($request->all());

        return redirect()->route('airlines.index')->with('success','Airlines created successfully.');
    }

    public function show(Airlines $airlines, $id)
    {
        // abort_if(Gate::denies('airlines_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $airlines = $airlines::find($id);
        return view('airlines.show', compact('airlines'));
    }

    public function edit(Airlines $airlines,$id)
    {
        // abort_if(Gate::denies('airlines_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $airlines = $airlines::find($id);
        return view('airlines.edit', compact('airlines'));
    }

    public function update(Request $request, Airlines $airlines, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'country_name' => 'required',
            'country_iso' => 'required',
            'default_price' => 'required'
        ]);
        $airlines = $airlines::where('id', $id)->update($request->except(['_token','_method']));

        return redirect()->route('airlines.index')->with('success','Airlines updated successfully.');
    }

    public function destroy(Airlines $airlines, $id)
    {
        // abort_if(Gate::denies('airlines_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $airlines = $airlines::find($id);
        $airlines->delete();
        return redirect()->route('airlines.index')->with('success','post deleted successfully');
    }
}
