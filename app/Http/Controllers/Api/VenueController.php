<?php

namespace App\Http\Controllers\Api;

use App\helpers\Calculations;
use App\Models\Venue;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\VenueRequest;
use App\Http\Resources\RatingResource;
use App\Http\Resources\VenueResource;
use App\Models\Favourite;
use App\Models\Rating;
use Exception;
use Illuminate\Contracts\Auth\Authenticatable;
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
            $venue->setAddress($address_data);

            $attributes_data = $data['attributes'];
            $venue->setAttributes($attributes_data);

            $beverages_data = $data['beverages'];
            $venue->setBeverages($beverages_data);

            $images_urls = $data['images'];
            $venue->setImages($images_urls);

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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venue  $venue
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venue $venue)
    {
    }

    public function attributes_search(Request $request)
    {
        $attributes = $request->query('attributes');
        if ($attributes == null) {
            return response(['message' => 'no attributes provided'], 200);
        }
        $venues = Venue::whereHas('attributes', function (Builder $query) use ($attributes) {
            $query->whereIn('name', $attributes);
        }, '>=', count($attributes))->get();
        return VenueResource::collection($venues);
    }

    public function name_search(Request $request)
    {
        $search = $request->query('name');
        $venues = Venue::where('name', 'LIKE', "%{$search}%")->get();

        return VenueResource::collection($venues);
    }

    //Validate Request Object
    public function rate(Request $request, Venue $venue, Authenticatable $user) //@dev how does $venue object get created
    {
        //If rating already exists for the user update the current rating, otherwise create one for that venue and attatch the user id to it.
        Rating::updateOrCreate(
            [
                'rateable_id' => $venue->id,
                'rateable_type' => Venue::class,
                'user_id' => $user->id,
            ],
            [
                'rating' => $request->rating
            ]
        );

        //Turn ratings into collection so that we can reduce over for the average.
        $ratings = collect($venue->ratings);
        $avg_rating = Calculations::calculate_average_rating($ratings);
        $venue->rating = $avg_rating;

        $venue->save();
        return response(['message' => 'success'], 200);
    }

    public function favourite(Request $request, Venue $venue, Authenticatable $user)
    {
        $remove = $request['remove'];
        $user_id = $user->id;

        //get favourite
        $favourite = Favourite::where('user_id', '=', $user->id)
            ->where('favouriteable_id', '=', $venue->id)
            ->first();

        if ($remove && $favourite) {
            $favourite->delete();
            return response(['message' => 'favourite removed'], 200);
        }

        if (!$favourite) {
            Favourite::create([
                'favouriteable_id' => $venue->id,
                'favouriteable_type' => Venue::class,
                'user_id' => $user_id,
            ]);
            return response(['message' => 'success'], 200);
        } else return response(['message' => 'already favourited'], 200);
    }

    public function get_favourite(int $id, Authenticatable $user)
    {
        $venue = Venue::findOrFail($id);
        $favourite = Favourite::where('user_id', '=', $user->id)
            ->where('favouriteable_id', '=', $venue->id)
            ->first();
        if ($favourite) {
            return response(['favourited' => true], 200);
        } else return response(['favourited' => false], 200);
    }

    public function get_user_favourites(Authenticatable $user)
    {
        $venue_ids = Favourite::where('user_id', '=', $user->id)
            ->where('favouriteable_type', '=', Venue::class)
            ->pluck('favouriteable_id');

        $venues = Venue::whereIn('id', $venue_ids)
            ->get();

        return VenueResource::collection($venues);
    }

    public function get_rating(int $id, Authenticatable $user)
    {
        $venue = Venue::findOrFail($id);
        $rating = Rating::where('user_id', '=', $user->id)
            ->where('rateable_id', '=', $venue->id)
            ->first();

        return new RatingResource($rating);
    }
}
