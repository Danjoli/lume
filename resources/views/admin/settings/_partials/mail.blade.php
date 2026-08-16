<x-forms.section
    title="SMTP"
    description="Servidor de e-mail."
>

    <div class="grid gap-6 md:grid-cols-2">

        <x-forms.input
            name="mail_host"
            label="Host"
            :value="$settings->mail_host"
        />

        <x-forms.input
            name="mail_port"
            label="Porta"
            :value="$settings->mail_port"
        />

        <x-forms.input
            name="mail_username"
            label="Usuário"
            :value="$settings->mail_username"
        />

        <x-forms.input
            type="password"
            name="mail_password"
            label="Senha"
        />

    </div>

</x-forms.section>
