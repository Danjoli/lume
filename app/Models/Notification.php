<?php

namespace App\Models;

use Illuminate\Notifications\DatabaseNotification;

class Notification extends DatabaseNotification
{
    /*
    |--------------------------------------------------------------------------
    | Métodos auxiliares
    |--------------------------------------------------------------------------
    */

    /**
     * Verifica se a notificação foi lida.
     */
    public function isRead(): bool
    {
        return $this->read_at !== null;
    }

    /**
     * Verifica se a notificação ainda não foi lida.
     */
    public function isUnread(): bool
    {
        return $this->read_at === null;
    }

    /**
     * Retorna o título da notificação.
     */
    public function title(): string
    {
        return $this->data['title'] ?? '';
    }

    /**
     * Retorna a mensagem da notificação.
     */
    public function message(): string
    {
        return $this->data['message'] ?? '';
    }

    /**
     * Retorna o link da notificação.
     */
    public function url(): ?string
    {
        return $this->data['url'] ?? null;
    }

    /**
     * Retorna o ícone da notificação.
     */
    public function icon(): string
    {
        return $this->data['icon'] ?? 'bell';
    }
}
