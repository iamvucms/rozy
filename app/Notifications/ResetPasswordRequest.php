<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordRequest extends Notification
{
    protected $token;
    /**
    * Create a new notification instance.
    *
    * @return void
    */
    public function __construct($code)
    {
        $this->code = $code;
    }
    /**
    * Get the notification's delivery channels.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
     /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
     public function toMail($notifiable)
     {
        return (new MailMessage)
            ->line('Đây là email khôi phục mật khẩu trên hệ thống rozy')
            ->line('Mã khôi phục: '. $this->code)
            ->line('Nếu bạn không gửi yêu cầu này, vui lòng không gửi mã này cho bất kì ai!');
    }
}