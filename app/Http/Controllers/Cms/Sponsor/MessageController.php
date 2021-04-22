<?php

namespace App\Http\Controllers\Cms\Sponsor;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\UserMessage;
use App\Traits\SpreadsheetTrait;

class MessageController extends Controller
{
    use SpreadsheetTrait;

    public function index()
    {

        $messages = request()->user()->booth->messages()->with('user')->get();

        return view("cms.sponsor.message.index", compact('messages'));
    }

    public function exportToSpreadsheet()
    {

        $this->newSpreadsheet(auth()->user()->name . " - Messages", 'Messages', [
            'First Name', 'Last Name', 'Mobile Number', 'Email Address', 'Affiliation', 'Classification', 'Subject', 'Interest', 'Message',
        ]);
        $i = 2;
        foreach (UserMessage::with('user')->get() as $message) {
            $this->setRows(
                [
                    $message->user->first_name,
                    $message->user->last_name,
                    $message->user->mobile_number,
                    $message->user->email_address,
                    $message->user->affiliation,
                    $message->user->classification,
                    $message->subject,
                    $message->interest,
                    $message->message,
                ],
                $i++
            );
        }
        return response()->download($this->saveSpreadsheet());
    }
}
