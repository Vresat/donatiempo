<?php

namespace App\Notifications;

use App\Models\Ad;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewAdNotification extends Notification
{
    use Queueable;
    protected Ad $ad;
    /**
     * Create a new notification instance.
     */
    public function __construct(int $ad)
    {
        $this->ad=Ad::find($ad);
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
        $url=config('app.url');
        $url=$url.'/table/';
        $url=$url.$this->ad->id;
        return (new MailMessage)
                    ->line('EL nuevo anuncion es '.$this->ad->name)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url($url))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        dd($this->ad);
        return [
            'name'=>User::select('avatar','name')->find($this->ad->user_id),
            'created_at'=>$this->ad->created_at->format('j F Y'),
            'ad_id'=>$this->ad->ad_id,
            'ad_name'=>Ad::select('name')->find($this->ad->ad_id),
        
        ];
    }
}
