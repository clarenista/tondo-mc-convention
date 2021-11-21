<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use \Auth;
use Illuminate\Http\Request;
use App\Models\ChatRoom;
use App\Models\ChatMessage;
use App\Events\NewChatMessage;


class ChatController extends Controller
{
    public function rooms(){
        return ChatRoom::all();
    }

    public function messages($roomId){
        return ChatMessage::where('chat_room_id', $roomId)
            ->with('user')
            ->orderBy('created_at', 'ASC')
            ->get();
    }

    public function newMessage($roomId){
        \request()->merge(['chat_room_id' => $roomId, 'message' => \request()->newMessage, 'user' => \request()->user()]);
        $newMessage = \request()->user()->chat_messages()->create(\request()->all());

        broadcast(new NewChatMessage($newMessage))->toOthers();
        return \request()->all();
    }

    public function getRoom(){
        // room_sponsor_id-user_id
        // rm_1-1
        $room_name = 'rm_'.\request()->sponsor_id."-".\request()->user()->id;
        $room = ChatRoom::where('name', $room_name)->first();
        if(isset($room->id)){
            return $room;
        }
        return ChatRoom::create(['name' => $room_name]);
    }
}
