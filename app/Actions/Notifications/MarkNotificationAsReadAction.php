<?php

namespace App\Actions\Notifications;

use Illuminate\Notifications\DatabaseNotification;

class MarkNotificationAsReadAction
{
    /**
     * Marca uma notificação como lida.
     */
    public function execute(
        DatabaseNotification $notification
    ): DatabaseNotification {

        if ($notification->read_at === null) {

            $notification->markAsRead();

        }

        return $notification->refresh();

    }
}
