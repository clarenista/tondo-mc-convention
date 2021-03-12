<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'caption',
        'url',
        'x',
        'y',
        'active',
    ];

    public function assets()
    {

        return $this->belongsToMany(Asset::class, 'asset_booth');
    }

    public function hotspots()
    {

        return $this->hasMany(BoothHotspot::class);
    }
}
