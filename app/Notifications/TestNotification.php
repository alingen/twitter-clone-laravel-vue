<?php

namespace App\Notifications;

use App\Models\Infomation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;

class TestNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(object $content)
    {
        $this->content = $content;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('通知')
            ->line((User::find($this->content->user_id_from)->name) . 'さんがあなたのツイートに' . $this->content->infomation_type . 'しました。')
            // ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'user_id_from' => $this->content->user_id_from,
            'tweet_id' => $this->content->tweet_id,
            'infomation_type' => $this->content->infomation_type,
            'infomation_id' => $this->content->infomation_id

            //  通知からリンクしたいURLがあれば設定しておくと便利
            // 'url' => route('infos.show', ['information' => $this->information])
        ];
    }
}
