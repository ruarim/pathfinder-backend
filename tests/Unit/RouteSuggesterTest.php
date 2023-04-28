<?php

namespace Tests\Unit;

use App\Services\RouteSuggester;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class RouteSuggesterTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_for_shortest_path()
    {
        $start_vetex = [
            51.469141,
            -2.604057
        ];

        $end_vertex = [
            51.475200500000000,
            -2.590841512430562
        ];

        $suggester = new RouteSuggester([''], [], []);

        // $class = new ReflectionClass('RouteSuggester');
        // $method = $class->getMethod('calculateDistance');
        // $method->setAccessible(true);

        //$suggester->calculateDistance();

        $this->assertTrue(true);
    }
}
