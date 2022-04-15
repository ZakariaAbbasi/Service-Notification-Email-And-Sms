<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\EmailRequest;
use App\Services\Notifications\Notification;
use App\Services\Notifications\Constants\EmailTypes;

class NotificationsController extends Controller
{
    public function email()
    {
        $users = User::all();
        $emailTypes = EmailTypes::toString();
        return view('notification.send-email', compact('users', 'emailTypes'));
    }

    public function sendEmail(EmailRequest $request)
    {
        try {
            $notification = new Notification();
            $mailable = EmailTypes::toMail($request->email_type);
            $notification->sendEmail(User::find($request->user), new $mailable);
            return redirect()->back()->with('success', __('notifications.email_send_successfully'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', __('notifications.email_has_problem'));

        }
    }
}
