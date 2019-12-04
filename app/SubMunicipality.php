<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubMunicipality extends Model
{
    protected $fillable = ['code', 'name', 'population'];

    /**
     * Get all barangays of the subMunicipality
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function barangays()
    {
        return $this->morphMany(Barangay::class, 'barangay');
    }
}
