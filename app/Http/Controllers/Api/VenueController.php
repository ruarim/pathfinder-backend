<?php

namespace App\Http\Controllers\Api;

use App\Models\Venue;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VenueRequest;
use Exception;
use Illuminate\Validation\ValidationException;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Venue::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(VenueRequest $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(VenueRequest $request)
    {
        try {
            $data = $request->all();
            $venue = new Venue($data);
            $venue->save();
            $address_data = $data['address'];
            $address = new Address($address_data);
            $venue->address()->save($address);
            return $venue;
        } catch (Exception $e) {
            throw ValidationException::withMessages([
                'error' => 'We were unable to save this venue at this time, please check to make sure you have filled in the form correctly. If this problem persists contact us.'
            ]);
        }

        //create a resource
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(Venue $venue)
    {
        return $venue;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function edit(Venue $venue)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venue $venue)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
        //
    }
}
