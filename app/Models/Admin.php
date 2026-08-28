<?php

namespace App\Models;

use App\Enums\AdminRole;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * Os atributos que podem ser preenchidos em massa.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'is_active',
        'last_login_at',
    ];

    /**
     * Os atributos que devem ficar ocultos em serializações.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Conversão de atributos.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'role' => AdminRole::class,
            'password' => 'hashed',
            'is_active' => 'boolean',
            'last_login_at' => 'datetime',
        ];
    }

    /*
    |--------------------------------------------------------------------------
    | Métodos auxiliares
    |--------------------------------------------------------------------------
    */

    public function isSuperAdmin(): bool
    {
        return $this->role === AdminRole::SUPERADMIN;
    }

    public function isAdmin(): bool
    {
        return $this->role === AdminRole::ADMIN;
    }

    public function isSupport(): bool
    {
        return $this->role === AdminRole::SUPPORT;
    }

    public function hasRole(AdminRole|string $role): bool
    {
        $role = is_string($role) ? AdminRole::tryFrom($role) : $role;

        return $this->role === $role;
    }

    public function getRoleLabelAttribute(): string
    {
        return $this->role?->label() ?? '';
    }
}
