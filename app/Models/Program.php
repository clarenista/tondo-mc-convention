<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_at',
        'end_at',
        'group',
        'type',
        'category',
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
