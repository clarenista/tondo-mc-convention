<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoothHotspot extends Model
{
    use HasFactory;

    public function assets()
    {

        return $this->belongsToMany(Asset::class, 'asset_hotspot');
    }
}
