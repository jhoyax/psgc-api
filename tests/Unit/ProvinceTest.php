<?php

namespace Tests\Unit;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProvinceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_province_has_cities()
    {
        $province = factory('App\Province')->create();

        $this->assertInstanceOf(Collection::class, $province->cities);
    }
}
