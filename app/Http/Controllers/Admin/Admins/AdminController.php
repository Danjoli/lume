<?php

namespace App\Http\Controllers\Admin\Admins;

use App\Data\Admins\AdminData;
use App\Exceptions\Domain\CannotDeleteAdminException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admins\StoreAdminRequest;
use App\Http\Requests\Admin\Admins\UpdateAdminRequest;
use App\Models\Admin;
use App\Services\Admin\Admins\AdminService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(
        private readonly AdminService $adminService
    ) {
    }

    /**
     * Exibe a listagem dos administradores.
     */
    public function index(Request $request): View
    {
        return view('admin.admins.index', [

            'admins' => $this->adminService->paginate($request),

        ]);
    }

    /**
     * Exibe o formulário de criação.
     */
    public function create(): View
    {
        return view('admin.admins.create');
    }

    /**
     * Armazena um novo administrador.
     */
    public function store(
        StoreAdminRequest $request
    ): RedirectResponse {

        $this->adminService->store(

            AdminData::fromRequest($request)

        );

        return redirect()

            ->route('admin.admins.index')

            ->with(
                'success',
                'Administrador cadastrado com sucesso.'
            );

    }

    /**
     * Exibe os detalhes do administrador.
     */
    public function show(
        Admin $admin
    ): View {

        return view('admin.admins.show', [

            'admin' => $admin,

        ]);

    }

    /**
     * Exibe o formulário de edição.
     */
    public function edit(
        Admin $admin
    ): View {

        return view('admin.admins.edit', [

            'admin' => $admin,

        ]);

    }

    /**
     * Atualiza um administrador.
     */
    public function update(
        UpdateAdminRequest $request,
        Admin $admin
    ): RedirectResponse {

        $this->adminService->update(

            $admin,

            AdminData::fromRequest($request)

        );

        return redirect()

            ->route('admin.admins.index')

            ->with(
                'success',
                'Administrador atualizado com sucesso.'
            );

    }

    /**
     * Remove um administrador.
     */
    public function destroy(
        Admin $admin
    ): RedirectResponse {

        try {

            $this->adminService->destroy($admin);

            return redirect()

                ->route('admin.admins.index')

                ->with(
                    'success',
                    'Administrador removido com sucesso.'
                );

        } catch (CannotDeleteAdminException $exception) {

            return redirect()

                ->route('admin.admins.index')

                ->with(
                    'error',
                    $exception->getMessage()
                );

        }

    }
}
