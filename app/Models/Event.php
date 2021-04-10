<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
        'organizer',
        'organizer_email_address',
        'title',
        'subtitle',
        'description',
        'image_url',
        'image_thumbnail_url',
        'video_url',
        'video_thumbnail_url',
        'audio_url',
        'audio_thumbnail_url',
    ];
}
