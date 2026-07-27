<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',

        'label',
        'recipient_name',
        'phone',

        'street',
        'number',
        'complement',
        'neighborhood',

        'city',
        'state',
        'cep',

        'is_default',
    ];

    /**
     * Conversão dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'is_default' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    /**
     * Usuário proprietário do endereço.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos auxiliares
    |--------------------------------------------------------------------------
    */

    /**
     * Verifica se é o endereço padrão.
     */
    public function isDefault(): bool
    {
        return $this->is_default;
    }

    /**
     * Retorna o endereço completo.
     */
    public function getFullAddressAttribute(): string
    {
        return collect([
            "{$this->street}, {$this->number}",
            $this->complement,
            $this->neighborhood,
            "{$this->city}/{$this->state}",
            $this->cep,
        ])
            ->filter()
            ->implode(', ');
    }
}
