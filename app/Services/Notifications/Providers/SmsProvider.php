<?php

namespace App\Services\Notifications\Providers;

use App\Models\User;
use Ghasedak\GhasedakApi;
use Ghasedak\Exceptions\ApiException;
use Ghasedak\Exceptions\HttpException;
use App\Services\Notifications\Contracts\ProviderInterface;

class SmsProvider implements ProviderInterface
{

    public function __construct(
        private User $user,
        private string $text
    ) {
        # code...
    }
    
    public function send()
    {
        try {
            $this->prepareDateSms();
        } catch (\Ghasedak\Exceptions\ApiException $e) {
            return $e->errorMessage();
        } catch (\Ghasedak\Exceptions\HttpException $e) {
            return $e->errorMessage();
        }
    }

    private function prepareDateSms()
    {
        $message = $this->text;
        $lineNumber = config('services.sms.auth.sms_line_number');
        $receptor = $this->user->phone_number;
        $api = new \Ghasedak\GhasedakApi(config('services.sms.api_key'));
        return $api->SendSimple($receptor, $message, $lineNumber);
    }
}
