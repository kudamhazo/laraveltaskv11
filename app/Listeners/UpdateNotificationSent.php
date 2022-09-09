<?php

namespace App\Listeners;

use App\Models\Notification;
use Illuminate\Mail\Events\MessageSent;

class UpdateNotificationSent
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \Illuminate\Mail\Events\MessageSent $event
     * @return void
     */
    public function handle(MessageSent $event)
    {
        $notification = Notification::query()->find($event->data['notificationId']);
        $notification->sent_at = now();
        $notification->save();
    }
}
