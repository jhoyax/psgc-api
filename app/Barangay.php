<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barangay extends Model
{
    protected $fillable = ['code', 'name', 'area_type', 'population'];
}
