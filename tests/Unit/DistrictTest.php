<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DistrictTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_district_has_cities()
    {
        $district = factory('App\District')->create();

        $this->assertInstanceOf(Collection::class, $district->cities);
    }
}
