<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;


class ChatController extends Controller
{
    public function rooms(){
        return ChatRoom::all();
    }

    public function messages($roomId){
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'DESC')
            ->get();
    }

    public function newMessage($roomId){
        \request()->merge(['chat_room_id' => $roomId, 'message' => \request()->newMessage, 'user' => \request()->user()]);
        $newMessage = \request()->user()->chat_messages()->create(\request()->all());
        return \request()->all();
    }
}
