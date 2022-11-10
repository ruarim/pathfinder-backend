<?php

namespace App\Http\Controllers;

use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueResource;
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
        dd($request->all());
        return redirect(200, '/');
    }

    public function find($id)
    {
        return view('venues.form');
    }
}
