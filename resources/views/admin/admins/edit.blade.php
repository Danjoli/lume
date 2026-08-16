<x-admin.app-layout title="Editar Administrador">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Editar Administrador" description="Atualize os dados do administrador.">

            <x-buttons.secondary-button :href="route('admin.admins.index')">
                Voltar
            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-forms.form :action="route('admin.admins.update', $admin)" method="PUT">

            <x-forms.section title="Informações do administrador" description="Atualize os dados de acesso.">

                <div class="grid gap-6 md:grid-cols-2">

                    <div>

                        <x-forms.label for="name" required>
                            Nome
                        </x-forms.label>

                        <x-forms.input id="name" name="name" type="text" :value="old('name', $admin->name)" required
                            autofocus />

                        <x-forms.error field="name" />

                    </div>

                    <div>

                        <x-forms.label for="email" required>
                            E-mail
                        </x-forms.label>

                        <x-forms.input id="email" name="email" type="email" :value="old('email', $admin->email)" required />

                        <x-forms.error field="email" />

                    </div>

                    <div>

                        <x-forms.label for="password">
                            Nova senha
                        </x-forms.label>

                        <x-forms.input id="password" name="password" type="password" />

                        <p class="mt-1 text-xs text-slate-500">
                            Deixe em branco para manter a senha atual.
                        </p>

                        <x-forms.error field="password" />

                    </div>

                    <div>

                        <x-forms.label for="password_confirmation">
                            Confirmar nova senha
                        </x-forms.label>

                        <x-forms.input id="password_confirmation" name="password_confirmation" type="password" />

                        <x-forms.error field="password_confirmation" />

                    </div>

                </div>

            </x-forms.section>

            <x-forms.actions>

                <x-buttons.secondary-button :href="route('admin.admins.index')">
                    Cancelar
                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">
                    Salvar alterações
                </x-buttons.primary-button>

            </x-forms.actions>

        </x-forms.form>

    </div>

</x-admin.app-layout>
