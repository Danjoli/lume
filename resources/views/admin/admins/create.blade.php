<x-admin.app-layout title="Novo Administrador">

    <div class="space-y-8">

        <x-admin.headers.page-header title="Novo Administrador"
            description="Cadastre um novo administrador para o painel.">

            <x-buttons.secondary-button :href="route('admin.admins.index')">
                Voltar
            </x-buttons.secondary-button>

        </x-admin.headers.page-header>

        <x-alerts.flash />

        <x-forms.form :action="route('admin.admins.store')">

            <x-forms.section title="Informações do administrador"
                description="Informe os dados de acesso do administrador.">

                <div class="grid gap-6 md:grid-cols-2">

                    <div>

                        <x-forms.label for="name" required>
                            Nome
                        </x-forms.label>

                        <x-forms.input id="name" name="name" type="text" :value="old('name')" required
                            autofocus />

                        <x-forms.error field="name" />

                    </div>

                    <div>

                        <x-forms.label for="email" required>
                            E-mail
                        </x-forms.label>

                        <x-forms.input id="email" name="email" type="email" :value="old('email')" required />

                        <x-forms.error field="email" />

                    </div>

                    <div>

                        <x-forms.label for="password" required>
                            Senha
                        </x-forms.label>

                        <x-forms.input id="password" name="password" type="password" required />

                        <x-forms.error field="password" />

                    </div>

                    <div>

                        <x-forms.label for="password_confirmation" required>
                            Confirmar senha
                        </x-forms.label>

                        <x-forms.input id="password_confirmation" name="password_confirmation" type="password"
                            required />

                        <x-forms.error field="password_confirmation" />

                    </div>

                </div>

            </x-forms.section>

            <x-forms.actions>

                <x-buttons.secondary-button :href="route('admin.admins.index')">
                    Cancelar
                </x-buttons.secondary-button>

                <x-buttons.primary-button type="submit">
                    Salvar
                </x-buttons.primary-button>

            </x-forms.actions>

        </x-forms.form>

    </div>

</x-admin.app-layout>
