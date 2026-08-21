<x-admin.app-layout title="Editar campanha">

    <div class="mx-auto max-w-4xl">

        <a
            href="{{ route(
                'admin.newsletter.show',
                $campaign
            ) }}"
            class="
                inline-flex items-center gap-2
                text-sm font-semibold
                text-[#B85D70]
                transition
                hover:text-[#9F4C5E]
            "
        >
            <x-heroicon-o-arrow-left class="h-4 w-4" />

            Voltar para campanha
        </a>

        <div class="mt-7">

            <p
                class="
                    text-xs font-bold uppercase
                    tracking-[0.18em]
                    text-[#C96F82]
                "
            >
                Newsletter
            </p>

            <h1
                class="
                    mt-2
                    font-['Cormorant_Garamond']
                    text-4xl font-semibold
                    text-[#2A211F]
                "
            >
                Editar campanha
            </h1>

            <p class="mt-2 text-sm text-[#746B68]">
                Atualize o conteúdo enquanto a campanha estiver em rascunho.
            </p>

        </div>

        <x-alerts.flash />

        <form
            action="{{ route(
                'admin.newsletter.update',
                $campaign
            ) }}"
            method="POST"
            class="mt-8 space-y-6"
        >
            @csrf
            @method('PUT')

            <section
                class="
                    rounded-2xl border
                    border-[#E7E1DF]
                    bg-white p-6
                "
            >

                <div class="space-y-5">

                    <div>

                        <label
                            for="subject"
                            class="
                                mb-2 block text-sm
                                font-semibold text-[#2A211F]
                            "
                        >
                            Assunto do e-mail
                        </label>

                        <input
                            id="subject"
                            type="text"
                            name="subject"
                            value="{{ old(
                                'subject',
                                $campaign->subject
                            ) }}"
                            class="
                                h-11 w-full rounded-lg
                                border border-[#E1D8D5]
                                bg-white px-4 text-sm
                                text-[#2A211F]
                                outline-none
                                focus:border-[#B85D70]
                            "
                        >

                        @error('subject')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="title"
                            class="
                                mb-2 block text-sm
                                font-semibold text-[#2A211F]
                            "
                        >
                            Título
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old(
                                'title',
                                $campaign->title
                            ) }}"
                            class="
                                h-11 w-full rounded-lg
                                border border-[#E1D8D5]
                                bg-white px-4 text-sm
                                text-[#2A211F]
                                outline-none
                                focus:border-[#B85D70]
                            "
                        >

                        @error('title')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    <div>

                        <label
                            for="content"
                            class="
                                mb-2 block text-sm
                                font-semibold text-[#2A211F]
                            "
                        >
                            Conteúdo
                        </label>

                        <textarea
                            id="content"
                            name="content"
                            rows="10"
                            class="
                                w-full resize-y rounded-lg
                                border border-[#E1D8D5]
                                bg-white px-4 py-3
                                text-sm leading-6
                                text-[#2A211F]
                                outline-none
                                focus:border-[#B85D70]
                            "
                        >{{ old(
                            'content',
                            $campaign->content
                        ) }}</textarea>

                        @error('content')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                </div>

            </section>

            <div
                class="
                    flex flex-col-reverse gap-3
                    sm:flex-row sm:justify-end
                "
            >

                <a
                    href="{{ route(
                        'admin.newsletter.show',
                        $campaign
                    ) }}"
                    class="
                        inline-flex h-11
                        items-center justify-center
                        rounded-lg border
                        border-[#E1D8D5]
                        px-5 text-sm
                        font-semibold text-[#6C5C58]
                    "
                >
                    Cancelar
                </a>

                <button
                    type="submit"
                    class="
                        inline-flex h-11
                        items-center justify-center
                        gap-2 rounded-lg
                        bg-[#B85D70]
                        px-5 text-sm
                        font-semibold text-white
                        transition
                        hover:bg-[#9F4C5E]
                    "
                >
                    <x-heroicon-o-check class="h-4 w-4" />

                    Salvar alterações
                </button>

            </div>

        </form>

    </div>

</x-admin.app-layout>
