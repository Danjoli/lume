<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Book extends Model
{
    use HasFactory;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        // Informações básicas
        'title',
        'slug',
        'isbn',

        // Conteúdo
        'description',
        'synopsis',

        // Preços
        'price',
        'sale_price',

        // Estoque
        'stock',

        // Informações do livro
        'pages',
        'language',
        'edition',
        'format',
        'publication_date',

        // Frete
        'weight',
        'height',
        'width',
        'length',

        // Editora
        'publisher_id',

        // Status
        'is_featured',
        'is_active',
    ];

    /**
     * Conversão dos atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            // Valores monetários
            'price' => 'decimal:2',
            'sale_price' => 'decimal:2',

            // Data
            'publication_date' => 'date',

            // Medidas
            'weight' => 'decimal:3',
            'height' => 'decimal:2',
            'width' => 'decimal:2',
            'length' => 'decimal:2',

            // Status
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    /**
     * Editora do livro.
     */
    public function publisher(): BelongsTo
    {
        return $this->belongsTo(Publisher::class);
    }

    /**
     * Autores do livro.
     */
    public function authors(): BelongsToMany
    {
        return $this->belongsToMany(
            Author::class,
            'book_author'
        );
    }

    /**
     * Categorias do livro.
     */
    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(
            Category::class,
            'book_category'
        );
    }

    /**
     * Imagens do livro.
     */
    public function images(): HasMany
    {
        return $this->hasMany(BookImage::class);
    }

    /**
     * Avaliações do livro.
     */
    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Itens de carrinho relacionados ao livro.
     */
    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Itens de pedidos relacionados ao livro.
     */
    public function orderItems(): HasMany
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Usuários que favoritaram o livro.
     */
    public function wishlistUsers(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'wishlists');
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos auxiliares
    |--------------------------------------------------------------------------
    */

    /**
     * Retorna o preço promocional quando disponível.
     */
    public function getCurrentPriceAttribute(): ?string
    {
        return $this->sale_price ?? $this->price;
    }

    /**
     * Verifica se o livro está em promoção.
     */
    public function isOnSale(): bool
    {
        return $this->sale_price !== null
            && $this->price !== null
            && $this->sale_price < $this->price;
    }

    /**
     * Verifica se existe estoque disponível.
     */
    public function isInStock(): bool
    {
        return $this->stock > 0;
    }

    /**
     * Verifica se o livro está ativo.
     */
    public function isAvailable(): bool
    {
        return $this->is_active && $this->isInStock();
    }
}
