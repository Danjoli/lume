<?php

namespace App\Policies;

use App\Models\Admin;

class AdminPolicy
{
    /**
     * Determina se o administrador pode visualizar a lista.
     */
    public function viewAny(Admin $admin): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se o administrador pode visualizar um registro.
     */
    public function view(Admin $admin, Admin $model): bool
    {
        return $admin->isSupport()
            || $admin->isAdmin()
            || $admin->isSuperAdmin();
    }

    /**
     * Determina se o administrador pode criar novos administradores.
     */
    public function create(Admin $admin): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se o administrador pode atualizar um registro.
     */
    public function update(Admin $admin, Admin $model): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se o administrador pode excluir um registro.
     */
    public function delete(Admin $admin, Admin $model): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se o administrador pode restaurar um registro.
     */
    public function restore(Admin $admin, Admin $model): bool
    {
        return $admin->isSuperAdmin();
    }

    /**
     * Determina se o administrador pode remover definitivamente um registro.
     */
    public function forceDelete(Admin $admin, Admin $model): bool
    {
        return $admin->isSuperAdmin();
    }
}
