<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{

    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'type',
        'category',
        'url',
    ];

    public function hotspots()
    {

        return $this->belongsToMany(BoothHotspot::class, 'asset_hotspot');
    }
}
