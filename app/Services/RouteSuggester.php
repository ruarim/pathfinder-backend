<?php

namespace App\Services;

use App\Models\Venue;
use Fisharebest\Algorithm\Dijkstra;
use Illuminate\Database\Eloquent\Builder;

class RouteSuggester
{
    private float $searchRange = 0.2; //needs tweaking later

    public function __construct(private array $stopsAttributes, private array $start, private array $end)
    {
    }

    public function suggest()
    {
        //get all venues matching attributes for each stop

        $stopsVenues = [];
        //for each stop -> get venue ids where attributes
        foreach ($this->stopsAttributes as $attributes) {
            $matches = collect($this->getLocalVenuesByAttributes($attributes, $this->start, $this->end, $this->searchRange));
            array_push($stopsVenues, $matches);
        }




        //ignore zero distance adjencencies

        // $testGraph = [
        //     'A' => ['B' => 9, 'D' => 14, 'F' => 7],
        //     'B' => ['A' => 9, 'C' => 11, 'D' => 2, 'F' => 10],
        //     'C' => ['B' => 11, 'E' => 6, 'F' => 15],
        //     'D' => ['A' => 14, 'B' => 2, 'E' => 9],
        //     'E' => ['C' => 6, 'D' => 9],
        //     'F' => ['A' => 7, 'B' => 10, 'C' => 1],
        //     'G' => [],
        // ];
        // $dijkstra = new Dijkstra($testGraph);

        // $path = $dijkstra->shortestPaths('A', 'E');

        // dd($path);

        //start -> venues in first stop
        //veneus in first stop -> to venues in second stop
        //etc..
        //venues in last stop -> end
        //weight is the distance between the coords

        //dd($stopsVenues);

        //CREATE ADJACENCY LIST
        //start adj to first venues
        $venuesGraph = $this->createVenuesGraph($stopsVenues);
        dd($venuesGraph);


        $dijkstra = new Dijkstra($venuesGraph);

        $path = $dijkstra->shortestPaths('start', 'end');

        dd($path);
    }

    private function getLocalVenuesByAttributes(array $attributes, array $start, array $end, int $searchRange)
    {
        // loop here

        $lat = $this->sort($start[0], $end[0]);
        $long = $this->sort($start[1], $end[1]);

        //get local venues with stop attributes
        $matches =
            Venue::where(
                function (Builder $query) use ($lat, $long, $searchRange, $attributes) {
                    $query
                        ->whereHas('address', function (Builder $query) use ($lat, $long, $searchRange) {
                            $query
                                ->where('latitude', '>', $lat[0] - $searchRange)
                                ->where('latitude', '<', $lat[1] + $searchRange)
                                ->where('longitude', '>', $long[0])
                                ->where('longitude', '<', $long[1]);
                        })
                        ->whereHas('attributes', function (Builder $query) use ($attributes) {
                            $query
                                ->whereIn('name', $attributes);
                        }, '>=', count($attributes));
                }
            )
            ->join('addresses', 'venues.id', '=', 'addresses.venue_id')
            ->get();

        return $matches;
    }

    private function createVenuesGraph(array $stops)
    {
        $numberOfStops = count($stops);
        $graph = array();

        $start_vertices = array();
        foreach ($stops[0] as $venue) {
            $distance = $this->calculateDistance(
                $this->start,
                [$venue->latitude, $venue->longitude]
            );
            $id = $this->getStringId($venue->id);
            $start_vertices[$id] = $distance;
        }
        $graph['start'] = $start_vertices;

        //last venues adj to end
        foreach ($stops[$numberOfStops - 1] as $venue) {
            $distance = $this->calculateDistance(
                array($venue->latitude, $venue->longitude),
                $this->end
            );
            $id = $this->getStringId($venue->id);
            $graph[$id] = ['end' => $distance];
        }

        //else current stop vertices adj to next stop vertices
        foreach ($stops as $key => $stopVenues) {
            if ($key == $numberOfStops - 1) break;

            foreach ($stopVenues as $venue) {
                $id = $this->getStringId($venue->id);
                if (array_key_exists($id, $graph)) continue;

                $vertices = array();
                foreach ($stops[$key + 1] as $nextVenue) {
                    $distance = $this->calculateDistance(
                        array($venue->latitude, $venue->longitude),
                        array($nextVenue->latitude, $nextVenue->longitude)
                    );
                    if ($distance == 0) continue;
                    $id = $this->getStringId($nextVenue->id);
                    $vertices[$id] = $distance;
                }
                //if key doesnt exist
                $id = $this->getStringId($venue->id);
                $graph[$id] = $vertices;
            }
        }
        $graph['end'] = [];
        return $graph;
    }

    private function getStringId(int $id)
    {
        return strval($id) . "\0";
    }

    private function sort(float $start, float $end)
    {
        return ($start < $end) ? [$start, $end] : [$end, $start];
    }

    private function calculateDistance(array $current, array $next)
    {
        return sqrt(pow(abs($next[1] - $current[1]), 2) + pow(abs($next[0] - $current[0]), 2));
    }
}
