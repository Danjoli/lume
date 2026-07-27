<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'parent_id',
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
        return $this->belongsToMany(Book::class);
    }

    public function parent()
    {
        return $this->belongsTo(
            Category::class,
            'parent_id'
        );
    }

    public function children()
    {
        return $this->hasMany(
            Category::class,
            'parent_id'
        );
    }
}
