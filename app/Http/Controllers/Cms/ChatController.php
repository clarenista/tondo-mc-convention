<?php

namespace App\Http\Controllers\Cms;

use App\Events\NewChatMessage;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{

    public function index()
    {

        $event_id = auth()->user()->booth->eventCategory->id;
        $guests = User::whereHas('events', function ($q) use ($event_id) {
            $min2ago = date("Y-m-d H:i:s", time() - 120);
            $q->whereType('event')->whereUserEventCategoryId($event_id)->where('sent_at', '>', $min2ago);
        })->get();

        return view("cms.sponsor.chat.index", compact('guests'));
    }

    public function guest(User $guest)
    {

        $guest->load(['chats' => function ($q) use ($guest) {
            $booth_id = auth()->user()->booth->id;
            $q->whereChatRoomId("{$booth_id}-{$guest->id}");
        }]);

        return view("cms.sponsor.chat.guest", compact('guest'));
    }


    public function guestMessage(User $guest)
    {

        $user = auth()->user();
        $room_id = "{$user->id}-{$guest->id}";

        $message = ChatMessage::create([
            'chat_room_id' => $room_id,
            'message' => \request()->message,
            'user_id' => $guest->id,
            'sender_id' => $user->booth->id
        ]);

        broadcast(new NewChatMessage($room_id, $message));

        return redirect()->back();
    }
}
