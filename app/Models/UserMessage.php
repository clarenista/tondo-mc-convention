<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserMessage extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'booth_id',
        'subject',
        'name',
        'affiliation',
        'mobile_number',
        'email',
        'interest',
        'message',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }
}
