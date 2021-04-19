<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEventCategory extends Model
{

    protected $fillable = [
        'name',
        'description',
    ];

    public function categorizable()
    {

        return $this->morphTo();
    }

    public function events()
    {

        return $this->hasMany(UserEvent::class);
    }
}
