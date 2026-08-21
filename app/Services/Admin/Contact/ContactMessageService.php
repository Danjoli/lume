<?php

namespace App\Services\Admin\Contact;

use App\Models\ContactMessage;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ContactMessageService
{
    /**
     * Lista mensagens paginadas.
     */
    public function paginate(
        int $perPage = 15
    ): LengthAwarePaginator {
        return ContactMessage::query()
            ->with('user')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Retorna uma mensagem.
     */
    public function find(
        ContactMessage $contactMessage
    ): ContactMessage {
        return $contactMessage->loadMissing('user');
    }

    /**
     * Atualiza o status da mensagem.
     */
    public function updateStatus(
        ContactMessage $contactMessage,
        string $status
    ): ContactMessage {
        $data = [
            'status' => $status,
        ];

        if ($status === 'answered') {
            $data['answered_at'] =
                $contactMessage->answered_at ?? now();
        }

        if ($status !== 'answered') {
            $data['answered_at'] = null;
        }

        $contactMessage->update($data);

        return $contactMessage->refresh();
    }
}
