<?php

namespace App\Actions\Notifications;

use Illuminate\Notifications\DatabaseNotification;

class DeleteNotificationAction
{
    /**
     * Remove uma notificação.
     */
    public function execute(
        DatabaseNotification $notification
    ): void {

        $notification->delete();

    }
}
