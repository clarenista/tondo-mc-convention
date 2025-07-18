<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserActivity extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'location_id',
        'sent_at',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
