<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Services\MailService;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Config;

class VerifyEmailNotification extends Notification
{
    private $mailService;

    public function __construct()
    {
        $this->mailService = new MailService();
    }

    public function via($notifiable)
    {
        return ['custom'];
    }

    public function toMail($notifiable)
    {
        $verificationUrl = $this->verificationUrl($notifiable);

        try {
            $this->mailService->sendVerificationEmail($notifiable, $verificationUrl);
        } catch (\Exception $e) {
            \Log::error('Failed to send verification email: ' . $e->getMessage());
        }
    }

    protected function verificationUrl($notifiable)
    {
        return URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addMinutes(Config::get('auth.verification.expire', 60)),
            [
                'id' => $notifiable->getKey(),
                'hash' => sha1($notifiable->getEmailForVerification()),
            ]
        );
    }
} 