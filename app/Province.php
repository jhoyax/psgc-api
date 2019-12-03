<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = ['code', 'name', 'income_classification', 'population'];

    /**
     * Get all cities of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function cities()
    {
        return $this->hasMany(City::class)->orderBy('name');
    }

    /**
     * Get all municipalities of the region
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function municipalities()
    {
        return $this->hasMany(Municipality::class)->orderBy('name');
    }
}
