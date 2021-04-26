<?php

namespace App\Http\Controllers\Cms;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Program;

class EventManagementController extends Controller
{

    public function index()
    {

        $event = Event::first();
        $program = Program::first();

        return view('cms.event-management.index', compact('event', 'program'));
    }

    public function downloadDb()
    {

        $host = config('database.connections.mysql.host');
        $username = config('database.connections.mysql.username');
        $password = config('database.connections.mysql.password');
        $database = config('database.connections.mysql.database');
        $ts = time();
        $file = date('Y-m-d-His', $ts) . '-dump-' . $database . '.sql';
        $file = \storage_path($file);
        $command = sprintf('mysqldump -h %s -u %s -p\'%s\' %s > %s', $host, $username, $password, $database, $file);
        exec($command);

        return response()->download(\storage_path($file));
    }
}
