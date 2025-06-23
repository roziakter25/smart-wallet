<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Services\MailService;

class ResetPasswordNotification extends Notification
{
    private $token;
    private $mailService;

    public function __construct($token)
    {
        $this->token = $token;
        $this->mailService = new MailService();
    }

    public function via($notifiable)
    {
        return ['custom'];
    }

    public function toMail($notifiable)
    {
        try {
            $this->mailService->sendPasswordResetLink($notifiable, $this->token);
        } catch (\Exception $e) {
            \Log::error('Failed to send password reset email: ' . $e->getMessage());
        }
    }
} 