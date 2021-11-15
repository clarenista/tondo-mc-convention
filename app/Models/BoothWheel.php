<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoothWheel extends Model
{
    use HasFactory;

    protected $fillable = [
        'segments',
    ];

    protected $casts = [
        'segments' => 'array',
    ];

    public function submits(){

        return $this->hasMany(BoothWheelSubmit::class);
    }
}
