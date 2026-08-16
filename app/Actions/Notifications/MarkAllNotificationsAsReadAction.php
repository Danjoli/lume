<?php

namespace App\Actions\Notifications;

class MarkAllNotificationsAsReadAction
{
    /**
     * Marca todas as notificações como lidas.
     */
    public function execute(): void
    {
        auth('admin')

            ->user()

            ->unreadNotifications

            ->markAsRead();
    }
}
