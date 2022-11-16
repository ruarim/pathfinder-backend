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
        $venue = new Venue($data);
        $venue->save();
        $address = new Address($data);
        $venue->address()->save($address);
        //@TODO redirect to individual pub
    }

    public function find($id)
    {
        return view('venues.form');
    }
}
