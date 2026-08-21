<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use App\Services\Admin\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {}

    /**
     * Lista todas as notificações do admin autenticado.
     */
    public function index(): View
    {
        return view('admin.notifications.index', [
            'notifications' => $this->notificationService->paginate(),
        ]);
    }

    /**
     * Abre uma notificação.
     */
    public function show(
        DatabaseNotification $notification
    ): RedirectResponse {
        $notification = $this->notificationService
            ->markAsRead($notification);

        $url = $notification->data['url'] ?? null;

        return $url
            ? redirect()->to($url)
            : redirect()->route('admin.notifications.index');
    }

    /**
     * Marca uma notificação como lida.
     */
    public function markAsRead(
        DatabaseNotification $notification
    ): RedirectResponse {
        $this->notificationService
            ->markAsRead($notification);

        return back();
    }

    /**
     * Marca todas as notificações como lidas.
     */
    public function markAllAsRead(): RedirectResponse
    {
        $this->notificationService
            ->markAllAsRead();

        return back()->with(
            'success',
            'Todas as notificações foram marcadas como lidas.'
        );
    }

    /**
     * Remove uma notificação.
     */
    public function destroy(
        DatabaseNotification $notification
    ): RedirectResponse {
        $this->notificationService
            ->destroy($notification);

        return back()->with(
            'success',
            'Notificação removida.'
        );
    }
}
