<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_region_has_provinces()
    {
        $region = factory('App\Region')->create();

        $this->assertInstanceOf(Collection::class, $region->provinces);
    }

    /** @test */
    public function a_district_has_provinces()
    {
        $region = factory('App\Region')->create();

        $this->assertInstanceOf(Collection::class, $region->districts);
    }
}
