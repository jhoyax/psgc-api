<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['code', 'name', 'population'];

    /**
     * Get all provinces of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function provinces()
    {
        return $this->hasMany(Province::class)->orderBy('name');
    }

    /**
     * Get all districts of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function districts()
    {
        return $this->hasMany(District::class)->orderBy('name');
    }
}
