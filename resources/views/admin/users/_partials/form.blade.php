<x-forms.form
    :action="isset($user)
        ? route('admin.users.update', $user)
        : route('admin.users.store')"
    :method="isset($user) ? 'PUT' : 'POST'"
>

    <x-forms.section
        title="Informações Gerais"
        description="Dados principais do usuário."
    >

        <div class="grid gap-6 md:grid-cols-2">

            <div>

                <x-forms.label
                    for="name"
                    required
                >

                    Nome

                </x-forms.label>

                <x-forms.input
                    id="name"
                    name="name"
                    :value="old('name', $user->name ?? '')"
                />

                <x-forms.error field="name"/>

            </div>

            <div>

                <x-forms.label
                    for="email"
                    required
                >

                    E-mail

                </x-forms.label>

                <x-forms.input
                    id="email"
                    type="email"
                    name="email"
                    :value="old('email', $user->email ?? '')"
                />

                <x-forms.error field="email"/>

            </div>

            <div>

                <x-forms.label
                    for="password"
                    :required="! isset($user)"
                >

                    Senha

                </x-forms.label>

                <x-forms.input
                    id="password"
                    type="password"
                    name="password"
                />

                <x-forms.error field="password"/>

            </div>

            <div>

                <x-forms.label
                    for="password_confirmation"
                    :required="! isset($user)"
                >

                    Confirmar Senha

                </x-forms.label>

                <x-forms.input
                    id="password_confirmation"
                    type="password"
                    name="password_confirmation"
                />

            </div>

            <div>

                <x-forms.label for="status">

                    Status

                </x-forms.label>

                <x-forms.select
                    id="status"
                    name="status"
                >

                    <option
                        value="active"
                        @selected(old('status', $user->status ?? 'active') == 'active')
                    >

                        Ativo

                    </option>

                    <option
                        value="inactive"
                        @selected(old('status', $user->status ?? '') == 'inactive')
                    >

                        Inativo

                    </option>

                </x-forms.select>

                <x-forms.error field="status"/>

            </div>

            <div>

                <x-forms.label for="email_verified_at">

                    E-mail Verificado

                </x-forms.label>

                <x-forms.select
                    id="email_verified_at"
                    name="email_verified_at"
                >

                    <option value="">

                        Não

                    </option>

                    <option
                        value="{{ now() }}"
                        @selected(! empty($user?->email_verified_at))
                    >

                        Sim

                    </option>

                </x-forms.select>

            </div>

        </div>

    </x-forms.section>

    <x-forms.actions>

        <x-buttons.secondary-button
            :href="route('admin.users.index')"
        >

            Cancelar

        </x-buttons.secondary-button>

        <x-buttons.primary-button
            type="submit"
        >

            {{ isset($user) ? 'Atualizar' : 'Salvar' }}

        </x-buttons.primary-button>

    </x-forms.actions>

</x-forms.form>
