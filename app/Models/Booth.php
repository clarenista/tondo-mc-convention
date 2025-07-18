<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booth extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'caption',
        'url',
        'pitch',
        'yaw',
        'panorama_location',
        'type',
        'background',
        'booth',
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

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function messages(){

        return $this->hasMany(UserMessage::class);
    }

    public function questionnaire()
    {

        return $this->morphOne(Questionnaire::class, 'questionnaireable');
    }

    public function eventCategory()
    {

        return $this->morphOne(UserEventCategory::class, 'categorizable');
    }

    public function wheel(){

        return $this->hasOne(BoothWheel::class);
    }
}
