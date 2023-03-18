<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminderNotification extends Notification
{
    use Queueable;


    private $event;

    /**
     * Create a new notification instance.
     * @param $event
     * @return void
     */
    public function __construct($user, $msg, $event)
    {
        $this->user = $user;
        $this->msg = $msg;
        $this->event = $event;
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
            ->subject('Event Reminder.')
            ->line('An event scheduled for you in less than an hour!')
            ->line('Title'.$this->event->title)
            ->line('purpose'.$this->event->description)
            ->line('Start date'.$this->event->start_date)
            ->line('End date'.$this->event->end_date)
            ->line('Location'.$this->event->location);
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
            'Title' => $this->event->title,
            'Purpose' => $this->event->purpose,
            'Start Date' => $this->event->start_date,
            'End Date' => $this->event->end_date,
            'Location' => $this->event->location,
            'name' => $this->user->name,
            'email' => $this->user->email,
            'msg' => $this->msg
        ];
    }
}
