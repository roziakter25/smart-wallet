<?php

namespace App\Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService
{
    private $mailer;

    public function __construct()
    {
        $this->mailer = new PHPMailer(true);
        $this->setup();
    }

    private function setup()
    {
        try {
            $this->mailer->isSMTP();
            $this->mailer->Host = config('mail.mailers.smtp.host');
            $this->mailer->SMTPAuth = true;
            $this->mailer->Username = config('mail.mailers.smtp.username');
            $this->mailer->Password = config('mail.mailers.smtp.password');
            $this->mailer->SMTPSecure = config('mail.mailers.smtp.encryption');
            $this->mailer->Port = config('mail.mailers.smtp.port');
            $this->mailer->setFrom(config('mail.from.address'), config('mail.from.name'));
            $this->mailer->isHTML(true);
        } catch (Exception $e) {
            throw new Exception("Mail setup failed: " . $e->getMessage());
        }
    }

    public function sendPasswordResetLink($user, $token)
    {
        try {
            $resetUrl = url(route('password.reset', [
                'token' => $token,
                'email' => $user->email,
            ], false));

            $this->mailer->addAddress($user->email, $user->name);
            $this->mailer->Subject = 'Reset Password Notification';
            
            // HTML email body
            $this->mailer->Body = view('emails.password-reset', [
                'user' => $user,
                'resetUrl' => $resetUrl
            ])->render();

            // Plain text email body
            $this->mailer->AltBody = "Hello {$user->name},\n\n" .
                "You are receiving this email because we received a password reset request for your account.\n\n" .
                "Click the link below to reset your password:\n" .
                $resetUrl . "\n\n" .
                "If you did not request a password reset, no further action is required.\n\n" .
                "Regards,\n" .
                config('app.name');

            return $this->mailer->send();
        } catch (Exception $e) {
            throw new Exception("Failed to send password reset email: " . $e->getMessage());
        } finally {
            $this->mailer->clearAddresses();
        }
    }

    public function sendVerificationEmail($user, $verificationUrl)
    {
        try {
            $this->mailer->addAddress($user->email, $user->name);
            $this->mailer->Subject = 'Verify Email Address';
            
            // HTML email body
            $this->mailer->Body = view('emails.verify-email', [
                'user' => $user,
                'verificationUrl' => $verificationUrl
            ])->render();

            // Plain text email body
            $this->mailer->AltBody = "Hello {$user->name},\n\n" .
                "Please click the button below to verify your email address.\n\n" .
                "Verification Link: " . $verificationUrl . "\n\n" .
                "If you did not create an account, no further action is required.\n\n" .
                "Regards,\n" .
                config('app.name');

            return $this->mailer->send();
        } catch (Exception $e) {
            throw new Exception("Failed to send verification email: " . $e->getMessage());
        } finally {
            $this->mailer->clearAddresses();
        }
    }
} 