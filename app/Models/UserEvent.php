<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserEvent extends Model
{

    protected $fillable = [
        'user_id',
        'user_event_category_id',
        'type',
        'label',
        'sent_at',
    ];

    public function category()
    {

        return $this->belongsTo(UserEventCategory::class, 'user_event_category_id', 'id');
    }
}
