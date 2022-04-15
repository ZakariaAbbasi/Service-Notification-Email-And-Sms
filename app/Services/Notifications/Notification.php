<?php

namespace App\Services\Notifications;

use App\Models\User;
use Illuminate\Mail\Mailable;

class Notification
{
    public function sendEmail(User $user, Mailable $mailable)
    {
        # code...
    }

    public function sendSms(User $user, string $text)
    {
        # code...
    }
}