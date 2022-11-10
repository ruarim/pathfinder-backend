<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueResource;
use App\Models\Address;
use App\Models\Venue;
use Illuminate\Http\Request;

class VenueController extends Controller
{
    public function index()
    {
        $venues = VenueResource::collection(Venue::all());
        return view('venues.main', ['venues' => $venues]);
    }

    public function show(VenueRequest $request)
    {
    }

    public function create()
    {
        return view('venues.form');
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $venue = Venue::create([
            'name' => $data['name'],
            'capacity' => $data['capacity'],
            'venue_type' => $data['venue_type'],
            'opening_time' => $data['opening_time'],
            'closing_time' => $data['closing_time'],
        ]);

        $venue->save();

        $address = Address::create([
            'address_1' => $data['address_1'],
            'address_2' => $data['address_2'],
            'town_city' => $data['town_city'],
            'postcode' => $data['postcode'],
            'country' => $data['country']
        ]);

        $venue->address()->save($address);
        return redirect(200, '/');
    }

    public function find($id)
    {
        return view('venues.form');
    }
}
