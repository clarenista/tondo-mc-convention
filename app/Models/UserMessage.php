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
        'moible_number',
        'email',
        'interest',
    ];
}
