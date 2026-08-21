<x-admin.app-layout title="Atendimentos">

    <div class="space-y-8">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">

            <div>

                <p class="text-xs font-bold uppercase tracking-[0.18em] text-[#C96F82]">
                    Atendimento
                </p>

                <h1
                    class="
                        mt-2 font-['Cormorant_Garamond']
                        text-4xl font-semibold
                        text-[#2A211F]
                    "
                >
                    Mensagens de contato
                </h1>

                <p class="mt-2 text-sm text-[#746B68]">
                    Acompanhe dúvidas, solicitações e mensagens enviadas pelos clientes.
                </p>

            </div>

        </div>

        <x-alerts.flash />

        @if($messages->count())

            <div
                class="
                    overflow-hidden rounded-2xl
                    border border-[#E7E1DF]
                    bg-white shadow-sm
                "
            >

                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-[#EEE9E7]">

                        <thead class="bg-[#FAF7F6]">

                            <tr>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Cliente
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Assunto
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Status
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-left
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Data
                                </th>

                                <th
                                    class="
                                        px-6 py-4 text-right
                                        text-xs font-bold uppercase
                                        tracking-[0.12em]
                                        text-[#8A7D79]
                                    "
                                >
                                    Ação
                                </th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-[#F0ECEA]">

                            @foreach($messages as $message)

                                <tr class="transition hover:bg-[#FCFAF9]">

                                    <td class="px-6 py-5">

                                        <div>

                                            <p class="font-semibold text-[#2A211F]">
                                                {{ $message->name }}
                                            </p>

                                            <p class="mt-1 text-xs text-[#857875]">
                                                {{ $message->email }}
                                            </p>

                                            @if($message->user)

                                                <p class="mt-1 text-[11px] text-[#A29591]">
                                                    Cliente cadastrado
                                                </p>

                                            @endif

                                        </div>

                                    </td>

                                    <td class="px-6 py-5">

                                        <span class="text-sm text-[#5D514E]">
                                            {{ ucfirst($message->subject) }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-5">

                                        @php
                                            $status = match($message->status) {
                                                'pending' => [
                                                    'label' => 'Pendente',
                                                    'class' => 'bg-amber-50 text-amber-700',
                                                ],

                                                'in_progress' => [
                                                    'label' => 'Em atendimento',
                                                    'class' => 'bg-blue-50 text-blue-700',
                                                ],

                                                'answered' => [
                                                    'label' => 'Respondido',
                                                    'class' => 'bg-emerald-50 text-emerald-700',
                                                ],

                                                'closed' => [
                                                    'label' => 'Encerrado',
                                                    'class' => 'bg-slate-100 text-slate-600',
                                                ],

                                                default => [
                                                    'label' => ucfirst($message->status),
                                                    'class' => 'bg-slate-100 text-slate-600',
                                                ],
                                            };
                                        @endphp

                                        <span
                                            class="
                                                inline-flex rounded-full
                                                px-3 py-1
                                                text-xs font-semibold
                                                {{ $status['class'] }}
                                            "
                                        >
                                            {{ $status['label'] }}
                                        </span>

                                    </td>

                                    <td class="px-6 py-5">

                                        <p class="text-sm text-[#5D514E]">
                                            {{ $message->created_at->format('d/m/Y') }}
                                        </p>

                                        <p class="mt-1 text-xs text-[#A29591]">
                                            {{ $message->created_at->format('H:i') }}
                                        </p>

                                    </td>

                                    <td class="px-6 py-5 text-right">

                                        <a
                                            href="{{ route(
                                                'admin.contact-messages.show',
                                                $message
                                            ) }}"
                                            class="
                                                inline-flex h-9
                                                items-center justify-center
                                                rounded-lg border
                                                border-[#E1D8D5]
                                                px-4 text-sm
                                                font-semibold text-[#6C5C58]
                                                transition
                                                hover:border-[#C96F82]
                                                hover:text-[#B85D70]
                                            "
                                        >
                                            Ver mensagem
                                        </a>

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            </div>

            <div>
                {{ $messages->links() }}
            </div>

        @else

            <div
                class="
                    flex min-h-[360px]
                    flex-col items-center
                    justify-center
                    rounded-2xl border
                    border-[#E7E1DF]
                    bg-white p-8 text-center
                "
            >

                <div
                    class="
                        flex h-14 w-14
                        items-center justify-center
                        rounded-full bg-[#F8EFEF]
                        text-[#B85D70]
                    "
                >
                    <x-heroicon-o-chat-bubble-left-right
                        class="h-7 w-7"
                    />
                </div>

                <h2 class="mt-5 text-lg font-semibold text-[#2A211F]">
                    Nenhuma mensagem recebida
                </h2>

                <p class="mt-2 max-w-md text-sm leading-6 text-[#857875]">
                    As mensagens enviadas pelo formulário de contato aparecerão aqui.
                </p>

            </div>

        @endif

    </div>

</x-admin.app-layout>
