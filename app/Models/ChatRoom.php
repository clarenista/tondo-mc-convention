<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatRoom extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function messages()
    {

        return $this->hasOne('App\Models\ChatMessage', 'chat_room__id', 'id');
    }
}
