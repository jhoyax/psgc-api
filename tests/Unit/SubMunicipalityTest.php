<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SubMunicipalityTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_subMunicipality_has_barangays()
    {
        $subMunicipality = factory('App\SubMunicipality')->create();

        $this->assertInstanceOf(Collection::class, $subMunicipality->barangays);
    }
}
