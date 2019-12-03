<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_city_has_barangays()
    {
        $city = factory('App\City')->create();

        $this->assertInstanceOf(Collection::class, $city->barangays);
    }

    /** @test */
    public function a_city_has_subMunicipalities()
    {
        $city = factory('App\City')->create();

        $this->assertInstanceOf(Collection::class, $city->subMunicipalities);
    }
}
