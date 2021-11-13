<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoothWheelSubmit extends Model
{
    use HasFactory;

    protected $fillable = [
        'booth_wheel_id',
        'user_id',
        'value',
    ];
}
