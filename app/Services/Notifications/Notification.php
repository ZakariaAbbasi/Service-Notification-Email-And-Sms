<?php

namespace App\Services\Notifications;

use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;


class Notification
{
    public function sendEmail(User $user, Mailable $mailable)
    {
        return Mail::to($user)->send($mailable);
    }

}