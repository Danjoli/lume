<?php

namespace App\Services\Admin;

use App\Models\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\Notifications\Notification;

class NotificationService
{
    /**
     * Quantidade de notificações por página.
     */
    private const PER_PAGE = 15;

    /**
     * Lista paginada das notificações do admin autenticado.
     */
    public function paginate(): LengthAwarePaginator
    {
        return $this->admin()
            ->notifications()
            ->latest()
            ->paginate(self::PER_PAGE);
    }

    /**
     * Retorna as notificações não lidas do admin autenticado.
     *
     * @return Collection<int, DatabaseNotification>
     */
    public function unread(): Collection
    {
        return $this->admin()
            ->unreadNotifications;
    }

    /**
     * Retorna as últimas notificações não lidas.
     *
     * Útil para o dropdown do sino no header.
     *
     * @return Collection<int, DatabaseNotification>
     */
    public function latestUnread(
        int $limit = 5
    ): Collection {
        return $this->admin()
            ->unreadNotifications()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * Retorna a quantidade de notificações não lidas.
     */
    public function unreadCount(): int
    {
        return $this->admin()
            ->unreadNotifications()
            ->count();
    }

    /**
     * Retorna uma notificação pertencente
     * ao admin autenticado.
     */
    public function find(
        DatabaseNotification $notification
    ): DatabaseNotification {
        $this->ensureOwnership($notification);

        return $notification;
    }

    /**
     * Marca uma notificação como lida.
     */
    public function markAsRead(
        DatabaseNotification $notification
    ): DatabaseNotification {
        $this->ensureOwnership($notification);

        if ($notification->read_at === null) {
            $notification->markAsRead();
        }

        return $notification->refresh();
    }

    /**
     * Marca todas as notificações como lidas.
     */
    public function markAllAsRead(): void
    {
        $this->admin()
            ->unreadNotifications()
            ->update([
                'read_at' => now(),
            ]);
    }

    /**
     * Remove uma notificação.
     */
    public function destroy(
        DatabaseNotification $notification
    ): void {
        $this->ensureOwnership($notification);

        $notification->delete();
    }

    /**
     * Envia uma notificação para todos
     * os administradores ativos.
     */
    public function notifyAdmins(
        Notification $notification
    ): void {
        Admin::query()
            ->where('is_active', true)
            ->each(
                fn (Admin $admin) => $admin->notify($notification)
            );
    }

    /**
     * Verifica se a notificação pertence
     * ao administrador autenticado.
     */
    private function ensureOwnership(
        DatabaseNotification $notification
    ): void {
        $admin = $this->admin();

        abort_unless(
            $notification->notifiable_type === Admin::class
            && (int) $notification->notifiable_id === $admin->id,
            403
        );
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
