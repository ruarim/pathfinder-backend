<?php

namespace Tests\Unit;

use App\Helpers\Calculations;
use PHPUnit\Framework\TestCase;

class HelperTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_for_single_value_in_helper()
    {
        $collection = collect([['rating' => 3]]);

        $avg_rating = Calculations::calculate_average_rating($collection);

        $this->assertEquals(3, $avg_rating);
        $this->assertNotEquals(1, $avg_rating);
    }

    public function test_for_multiple_values_in_helper()
    {
        $collection = collect([['rating' => 1], ['rating' => 2], ['rating' => 3], ['rating' => 4], ['rating' => 5]]);

        $avg_rating = Calculations::calculate_average_rating($collection);

        $this->assertEquals(3.00, $avg_rating);
    }
}
