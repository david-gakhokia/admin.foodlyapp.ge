<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\LengthAwarePaginator;

class NotificationLogController extends Controller
{
    public function index()
    {
    abort_unless(Auth::user() && Auth::user()->hasRole('admin'), 403);

    // If the notification_logs table doesn't exist yet (migration not run),
    // return an empty paginated result to avoid a QueryException on the admin page.
    if (! Schema::hasTable('notification_logs')) {
        $empty = collect([]);
        $logs = new LengthAwarePaginator($empty->forPage(1, 50), 0, 50, 1, [
            'path' => request()->url(),
            'query' => request()->query(),
        ]);
        return view('admin.notification_logs.index', compact('logs'));
    }

    $logs = NotificationLog::orderBy('created_at', 'desc')->paginate(50);
    return view('admin.notification_logs.index', compact('logs'));
    }

    public function show(NotificationLog $notificationLog)
    {
    abort_unless(Auth::user() && Auth::user()->hasRole('admin'), 403);
    return view('admin.notification_logs.show', ['log' => $notificationLog]);
    }

    public function sample()
    {
        abort_unless(Auth::user() && Auth::user()->hasRole('admin'), 403);

        // If the table isn't present, don't attempt to create a record.
        if (! Schema::hasTable('notification_logs')) {
            return back()->with('error', 'notification_logs table does not exist. Run migrations.');
        }

        NotificationLog::create([
            'to' => 'sample@example.com',
            'mailable' => 'App\\Mail\\Admin\\SampleEmail',
            'status' => 'failed',
            'message' => 'This is a sample failed notification generated from the UI.',
            'meta' => [],
        ]);

        return back()->with('success', 'Sample notification log created.');
    }
}
