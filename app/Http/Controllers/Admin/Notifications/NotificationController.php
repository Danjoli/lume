<?php

namespace App\Http\Controllers\Admin\Notifications;

use App\Http\Controllers\Controller;
use App\Services\Admin\Notifications\NotificationService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Notifications\DatabaseNotification;
use Illuminate\View\View;

class NotificationController extends Controller
{
    public function __construct(
        private readonly NotificationService $notificationService,
    ) {
    }

    /**
     * Exibe a listagem das notificações.
     */
    public function index(): View
    {
        return view('admin.notifications.index', [

            'notifications' => $this->notificationService
                ->paginate(),

        ]);
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

        return back();
    }

    /**
     * Remove uma notificação.
     */
    public function destroy(
        DatabaseNotification $notification
    ): RedirectResponse {

        $this->notificationService
            ->destroy($notification);

        return back();
    }
}
