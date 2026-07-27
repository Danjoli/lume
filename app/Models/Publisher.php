<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Publisher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'website',
        'logo',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
