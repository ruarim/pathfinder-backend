<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Calculations;
use App\Http\Controllers\Controller;
use App\Http\Resources\PathResource;
use App\Http\Resources\RatingResource;
use App\Models\Path;
use App\Models\Rating;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
        return PathResource::collection(Path::all());
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
    public function show(int $id, Authenticatable $user)
    {
        try {
            $path = Path::find($id);
            if (!$path) throw new Exception('we cannot find a record of this path, please check the id');

            //if public show
            if ($path->is_public) return new PathResource($path);

            //if private check if user in path
            $path_user = $path->users()->find($user->id, ['user_id']);
            if (!$path_user) throw new Exception('user not in path');
            if ($path_user) {
                return new PathResource($path);
            }
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
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

    public function completed(int $id)
    {
        try {
            $user = Auth::user();
            $path = Path::find($id);

            if (!$path) throw new Exception('path_id doesnt exist');

            $path->setCompleted($user->id);
            return response(['message' => 'success - path completed'], 200);
        } catch (Exception $e) {
            return response(['message' => $e->getMessage()], 400);
        }
    }

    public function update_participants(int $path_id, Request $request, Authenticatable $auth_user)
    {
        try {
            $email = $request['email'];
            $remove = $request['remove'];
            $user = User::where('email', $email)->first();
            $path = Path::find($path_id);

            if (!$user) throw new Exception('user_id does not exist');
            if (!$path) throw new Exception('path_id does not exisit');

            $auth_user_pivot = $path->users()->find($auth_user->id, ['user_id']);
            if (!$auth_user_pivot) throw new Exception('user not in path');
            if (!$auth_user_pivot->pivot->is_creator == 1) throw new Exception('authenticated user is not creator');

            $path->setParticipant($user->id, $remove);
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
            ->where('rateable_type', '=', Path::class)
            ->first();

        return new RatingResource($rating);
    }

    public function get_users_paths(Authenticatable $user)
    {
        $paths = Path::whereHas('users', function ($query) use ($user) {
            $query
                ->where('user_id', $user->id)
                ->where('is_creator', 1);
        })->get();
        return PathResource::collection($paths);
    }
}
