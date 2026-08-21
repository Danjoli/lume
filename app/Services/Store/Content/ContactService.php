<?php

namespace App\Services\Store\Content;

use App\Models\ContactMessage;
use App\Notifications\ContactMessageCreatedNotification;
use App\Services\Admin\NotificationService;
use Illuminate\Support\Facades\Auth;

class ContactService
{
    public function __construct(
        private readonly NotificationService $notificationService
    ) {}

    /**
     * @param  array<string, mixed>  $data
     */
    public function create(
        array $data
    ): ContactMessage {
        $message = ContactMessage::create([
            'user_id' => Auth::id(),

            'name' => $data['name'],
            'email' => $data['email'],
            'subject' => $data['subject'],
            'message' => $data['message'],

            'status' => 'pending',
        ]);

        $this->notificationService->notifyAdmins(
            new ContactMessageCreatedNotification($message)
        );

        return $message;
    }
}
