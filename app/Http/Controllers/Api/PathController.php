<?php

namespace App\Http\Controllers\api;

use App\Helpers\Calculations;
use App\Http\Controllers\Controller;
use App\Http\Resources\PathResource;
use App\Models\Path;
use App\Models\Rating;
use App\Models\User;
use ErrorException;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Contracts\Auth\Authenticatable;

class PathController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) //@dev create PathRequest
    {
        // try {
        //     $user = Auth::user();
        //     return response()->json([
        //         'path' => 'path resource'
        //     ]);
        // } catch (Exception $e) {
        //     return response()->json([
        //         'message' => 'Please sign in',
        //         'exception' => $e->getMessage()
        //     ]);
        //}

        try {
            $user = Auth::user();

            $data = $request->all();
            $path = new Path($data);
            $path->save();

            $ids = $data['venues'];
            $path->setVenues($ids);

            $path->setCreator($user->id);

            return new PathResource($path);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        try {
            $venue = Path::find($id);
            if (!$venue) throw new Exception('we cannot find a record of this path, please check the id');
            return new PathResource($venue);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function completed(int $id)
    {
        try {
            $user = Auth::user();
            $path = Path::find($id);

            if (!$path) throw new Exception('path_id doesnt exist');

            $path->setCompleted($user->id);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function update_participants(int $path_id, Request $request)
    {
        try {
            //if participant exist remove else add participant
            $user_id = $request['user_id'];
            $is_delete = $request['is_delete'];
            $user = User::find($user_id);
            $path = Path::find($path_id);

            if (!$user) throw new Exception('user_id does not exist');
            if (!$path) throw new Exception('path_id does not exisit');

            $path->setParticipant($user->id, $is_delete);

            return new PathResource($path);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function rate(Request $request, Path $path, Authenticatable $user)
    {
        //If rating already exists for the user update the current rating, otherwise create one for that venue and attatch the user id to it.
        Rating::updateOrCreate(
            [
                'rateable_id' => $path->id,
                'rateable_type' => Path::class,
                'user_id' => $user->id,
            ],
            [
                'rating' => $request->rating
            ]
        );

        //Turn ratings into collection so that we can reduce over for the average.
        $ratings = collect($path->ratings);
        $avg_rating = Calculations::calculate_average_rating($ratings);
        $path->rating = $avg_rating;

        $path->save();
        return response(['message' => 'success'], 200);
    }

    public function get_rating(int $id, Authenticatable $user)
    {
        $path = Path::findOrFail($id);
        $rating = Rating::where('user_id', '=', $user->id)
            ->where('rateable_id', '=', $path->id)
            ->first();

        return new PathResource($rating);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function edit(Path $path)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Path $path)
    {
        //$participants = $request["participants"] //list of ids??
        //setParticipants($participants)
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Path  $path
     * @return \Illuminate\Http\Response
     */
    public function destroy(Path $path)
    {
        //
    }
}
