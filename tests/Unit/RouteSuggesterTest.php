<?php

namespace Tests\Unit;

use App\Services\RouteSuggester;
use Tests\TestCase;

class RouteSuggesterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_for_shortest_path()
    {
        $expected_venue_id = 35;

        $start = [
            51.477951,
            -2.595721,
        ];

        $end = [
            51.4531549,
            -2.598458,
        ];

        $attributes = [['Pool']];

        $suggester = new RouteSuggester($attributes, $start, $end);
        $venues = $suggester->suggest();

        $this->assertEquals(
            $expected_venue_id,
            $venues[0]->id
        );
    }
}
