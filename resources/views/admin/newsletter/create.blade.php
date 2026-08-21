<x-admin.app-layout title="Nova campanha">

    <div class="mx-auto max-w-4xl">

        <a
            href="{{ route('admin.newsletter.index') }}"
            class="
                inline-flex items-center gap-2
                text-sm font-semibold
                text-[#B85D70]
                transition
                hover:text-[#9F4C5E]
            "
        >
            <x-heroicon-o-arrow-left class="h-4 w-4" />

            Voltar para newsletter
        </a>

        <div class="mt-7">

            <p
                class="
                    text-xs font-bold uppercase
                    tracking-[0.18em]
                    text-[#C96F82]
                "
            >
                Marketing
            </p>

            <h1
                class="
                    mt-2
                    font-['Cormorant_Garamond']
                    text-4xl font-semibold
                    text-[#2A211F]
                "
            >
                Nova campanha
            </h1>

            <p class="mt-2 text-sm text-[#746B68]">
                Crie uma campanha para enviar novidades, promoções e recomendações
                aos inscritos da newsletter.
            </p>

        </div>

        <x-alerts.flash />

        <form
            action="{{ route('admin.newsletter.store') }}"
            method="POST"
            class="mt-8 space-y-6"
        >
            @csrf

            <section
                class="
                    rounded-2xl border
                    border-[#E7E1DF]
                    bg-white p-6
                "
            >

                <h2 class="text-lg font-semibold text-[#2A211F]">
                    Informações da campanha
                </h2>

                <div class="mt-6 space-y-5">

                    {{-- Assunto --}}
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
                            value="{{ old('subject') }}"
                            placeholder="Ex.: Semana dos clássicos — até 30% OFF"
                            class="
                                h-11 w-full rounded-lg
                                border border-[#E1D8D5]
                                bg-white px-4 text-sm
                                text-[#2A211F]
                                outline-none transition
                                placeholder:text-[#A29591]
                                focus:border-[#B85D70]
                            "
                        >

                        @error('subject')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Título --}}
                    <div>

                        <label
                            for="title"
                            class="
                                mb-2 block text-sm
                                font-semibold text-[#2A211F]
                            "
                        >
                            Título da campanha
                        </label>

                        <input
                            id="title"
                            type="text"
                            name="title"
                            value="{{ old('title') }}"
                            placeholder="Ex.: Grandes histórias, preços especiais"
                            class="
                                h-11 w-full rounded-lg
                                border border-[#E1D8D5]
                                bg-white px-4 text-sm
                                text-[#2A211F]
                                outline-none transition
                                placeholder:text-[#A29591]
                                focus:border-[#B85D70]
                            "
                        >

                        @error('title')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>

                    {{-- Conteúdo --}}
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
                            placeholder="Escreva o conteúdo principal da campanha..."
                            class="
                                w-full resize-y rounded-lg
                                border border-[#E1D8D5]
                                bg-white px-4 py-3
                                text-sm leading-6
                                text-[#2A211F]
                                outline-none transition
                                placeholder:text-[#A29591]
                                focus:border-[#B85D70]
                            "
                        >{{ old('content') }}</textarea>

                        @error('content')
                            <p class="mt-2 text-xs text-red-600">
                                {{ $message }}
                            </p>
                        @enderror

                        <p class="mt-2 text-xs text-[#9B8D89]">
                            O conteúdo será enviado para todos os inscritos ativos
                            quando a campanha for publicada.
                        </p>

                    </div>

                </div>

            </section>

            {{-- Aviso --}}
            <div
                class="
                    flex items-start gap-3
                    rounded-xl bg-[#FAF7F6]
                    p-4
                "
            >

                <x-heroicon-o-information-circle
                    class="
                        mt-0.5 h-5 w-5
                        shrink-0 text-[#B85D70]
                    "
                />

                <p class="text-sm leading-6 text-[#746B68]">
                    Ao criar a campanha, ela será salva inicialmente como
                    <strong class="text-[#2A211F]">rascunho</strong>.
                    Você poderá revisar e enviar depois.
                </p>

            </div>

            {{-- Ações --}}
            <div
                class="
                    flex flex-col-reverse gap-3
                    sm:flex-row
                    sm:justify-end
                "
            >

                <a
                    href="{{ route('admin.newsletter.index') }}"
                    class="
                        inline-flex h-11
                        items-center justify-center
                        rounded-lg border
                        border-[#E1D8D5]
                        px-5 text-sm
                        font-semibold text-[#6C5C58]
                        transition
                        hover:bg-[#FAF7F6]
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
                    <x-heroicon-o-document-plus class="h-4 w-4" />

                    Salvar rascunho
                </button>

            </div>

        </form>

    </div>

</x-admin.app-layout>
