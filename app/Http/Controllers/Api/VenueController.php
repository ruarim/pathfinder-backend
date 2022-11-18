<?php

namespace App\Http\Controllers\Api;

use App\Models\Venue;
use App\Models\Address;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VenueRequest;
use App\Http\Resources\VenueResource;
use Exception;
use Illuminate\Database\Eloquent\Builder;

class VenueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VenueResource::collection(Venue::all());
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

            $attributes_data = $data['attributes'];
            $venue->setAttributes($attributes_data);

            $beverages_data = $data['beverages'];
            $venue->setBeverages($beverages_data);

            return new VenueResource($venue);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $venue = Venue::find($id);
            if (!$venue) {
                return response(['message' => 'we cannot find a record of this venue, please check the id'], 400);
            };
            return new VenueResource($venue);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function attributes_search(Request $request)
    {
        $attributes = $request->input('attributes');
        $venues = Venue::whereHas('attributes', function (Builder $query) use ($attributes) {
            $query->whereIn('name', $attributes);
        }, '>=', count($attributes))->get();
        return VenueResource::collection($venues);
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
