<?php

namespace App\Services\Admin\Admins;

use App\Data\Admins\AdminData;
use App\Exceptions\Domain\CannotDeleteAdminException;
use App\Models\Admin;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;

class AdminService
{
    /**
     * Lista paginada dos administradores.
     */
    public function paginate(Request $request): LengthAwarePaginator
    {
        return Admin::query()

            ->when($request->filled('search'), function ($query) use ($request) {

                $query->where(function ($query) use ($request) {

                    $query

                        ->where('name', 'like', "%{$request->search}%")

                        ->orWhere('email', 'like', "%{$request->search}%");

                });

            })

            ->latest()

            ->paginate(10)

            ->withQueryString();
    }

    /**
     * Cadastra um administrador.
     */
    public function store(AdminData $data): Admin
    {
        return Admin::create(
            $data->toArray()
        );
    }

    /**
     * Atualiza um administrador.
     */
    public function update(
        Admin $admin,
        AdminData $data
    ): void {

        $admin->update(
            $data->toArray()
        );

    }

    /**
     * Remove um administrador.
     */
    public function destroy(Admin $admin): void
    {
        if ($admin->is(auth('admin')->user())) {

            throw new CannotDeleteAdminException;
        }

        $admin->delete();
    }
}
