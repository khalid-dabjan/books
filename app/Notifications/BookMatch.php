<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class BookMatch extends Notification
{

    use Queueable;

    public $type;
    public $matchedUserId;
    public $bookId;
    public $haveLocationId;
    public $wantLocationId;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($type, $matchesUserId, $bookId, $haveLocationId, $wantLocationId)
    {
        $this->type = $type;
        $this->matchedUserId = $matchesUserId;
        $this->bookId = $bookId;
        $this->haveLocationId = $haveLocationId;
        $this->wantLocationId = $wantLocationId;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
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
                        ->line('The introduction to the notification.')
                        ->action('Notification Action', 'https://laravel.com')
                        ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'type' => $this->type,
            'matche_user_id' => $this->matchedUserId,
            'book_id' => $this->bookId,
            'have_location_id' => $this->haveLocationId,
            'want_location_id' => $this->wantLocationId,
        ];
    }

}