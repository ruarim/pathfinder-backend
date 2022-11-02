<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueResource;
use App\Models\Venue;

class VenueController extends Controller
{
    public function index()
    {
        $venues = VenueResource::collection(Venue::all());
        return view('venues', ['venues' => $venues]);
    }

    public function show(VenueRequest $request)
    {
    }
}
