<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MunicipalityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_municipality_has_barangays()
    {
        $municipality = factory('App\Municipality')->create();

        $this->assertInstanceOf(Collection::class, $municipality->barangays);
    }
}
