<?php

namespace App\Notifications;

use App\Models\Ad;
use App\Models\ChatAd;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdResponse extends Notification
{
    use Queueable;
    public $chat; 
    /**
     * Create a new notification instance.
     */
    public function __construct(ChatAd $chat)
    {
        $this->chat=$chat;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('El usuario '.User::select('name')->find($this->chat->sender_id)->name)
                    ->line('Ha repondido a su anuncio '.Ad::select('name')->find($this->chat->ad_id)->name)
                    ->line('Gracias por usar nuestra aplicación!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
    
        return [
            'name'=>User::select('name')->find($this->chat->sender_id),
            'sender_id'=>$this->chat->sender_id,
            'created_at'=>$this->chat->created_at->format('j F Y'),
            'ad_id'=>$this->chat->ad_id,
            'ad_name'=>Ad::select('name')->find($this->chat->ad_id),
            'sender_avatar'=>User::find($this->chat->sender_id)->avatar ?? null,
        ];
    }
}
