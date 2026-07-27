<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BookImage extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'book_id',
        'image',
        'sort_order',
        'is_primary',
    ];

    /**
     * Conversão dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'sort_order' => 'integer',
            'is_primary' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    /**
     * Livro ao qual a imagem pertence.
     */
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos auxiliares
    |--------------------------------------------------------------------------
    */

    /**
     * Verifica se esta é a imagem principal.
     */
    public function isPrimary(): bool
    {
        return $this->is_primary;
    }
}
