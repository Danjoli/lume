<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    /**
     * @var list<string>
     */
    protected $fillable = [

        'user_id',

        'book_id',

        'rating',

        'comment',

        'is_approved',

    ];

    /**
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

            'rating' => 'integer',

            'is_approved' => 'boolean',

        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Relacionamentos
    |--------------------------------------------------------------------------
    */

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }

    /*
    |--------------------------------------------------------------------------
    | Helpers
    |--------------------------------------------------------------------------
    */

    public function isApproved(): bool
    {
        return $this->is_approved;
    }

    public function isPending(): bool
    {
        return ! $this->is_approved;
    }

    public function approve(): void
    {
        $this->update([

            'is_approved' => true,

        ]);
    }

    public function reject(): void
    {
        $this->update([

            'is_approved' => false,

        ]);
    }
}
