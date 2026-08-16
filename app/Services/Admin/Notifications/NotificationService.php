<?php

namespace App\Services\Admin\Notifications;

use App\Actions\Notifications\DeleteNotificationAction;
use App\Actions\Notifications\MarkAllNotificationsAsReadAction;
use App\Actions\Notifications\MarkNotificationAsReadAction;
use App\Models\Admin;
use App\Models\Notification;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class NotificationService
{
    /**
     * Quantidade de registros por página.
     */
    private const PER_PAGE = 15;

    public function __construct(
        private readonly MarkNotificationAsReadAction $markNotificationAsReadAction,
        private readonly MarkAllNotificationsAsReadAction $markAllNotificationsAsReadAction,
        private readonly DeleteNotificationAction $deleteNotificationAction,
    ) {
    }

    /**
     * Lista paginada das notificações.
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->admin()

            ->notifications()

            ->latest()

            ->paginate(self::PER_PAGE);
    }

    /**
     * Lista as notificações não lidas.
     *
     * @return Collection<int, Notification>
     */
    public function unread(): Collection
    {
        return $this->admin()

            ->unreadNotifications;
    }

    /**
     * Quantidade de notificações não lidas.
     */
    public function unreadCount(): int
    {
        return $this->admin()

            ->unreadNotifications()

            ->count();
    }

    /**
     * Retorna uma notificação.
     */
    public function find(
        Notification $notification
    ): Notification {

        return $notification;

    }

    /**
     * Marca uma notificação como lida.
     */
    public function markAsRead(
        Notification $notification
    ): Notification {

        return $this->markNotificationAsReadAction
            ->execute($notification);

    }

    /**
     * Marca todas como lidas.
     */
    public function markAllAsRead(): void
    {
        $this->markAllNotificationsAsReadAction
            ->execute();
    }

    /**
     * Remove uma notificação.
     */
    public function destroy(
        Notification $notification
    ): void {

        $this->deleteNotificationAction
            ->execute($notification);

    }

    /**
     * Retorna o administrador autenticado.
     */
    private function admin(): Admin
    {
        /** @var Admin $admin */
        $admin = auth('admin')->user();

        return $admin;
    }
}
