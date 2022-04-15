<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Jobs\SendEmail;
use Illuminate\Http\Request;
use App\Http\Requests\SmsRequest;
use App\Http\Requests\EmailRequest;
use App\Services\Notifications\Notification;
use App\Services\Notifications\Constants\EmailTypes;
use App\Services\Notifications\Exceptions\UserDoesNotHavePhoneNumber;

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
            $mailable = EmailTypes::toMail($request->email_type);
            SendEmail::dispatch(User::find($request->user), new $mailable);
            return redirect()->back()->with('success', __('notifications.email_send_successfully'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', __('notifications.email_has_problem'));
        }
    }

    public function sms()
    {
        $users = User::all();
        return view('notification.send-sms', compact('users'));
    }

    public function sendSms(SmsRequest $request)
    {
        try {
            $notification = new Notification();
            $notification->sendSms(User::find($request->user), $request->text);
            return redirect()->back()->with('success', __('notifications.sms_send_successfully'));
        } catch (UserDoesNotHavePhoneNumber $e) {
            return redirect()->back()->with('failed', __('notifications.does_not_have_phone'));
        } catch (\Throwable $th) {
            return redirect()->back()->with('failed', __('notifications.sms_has_problem'));
        }
    }
}
