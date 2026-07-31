<div class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">

    <div class="overflow-x-auto">

        <table class="min-w-full">

            <thead class="bg-slate-100">

                <tr>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">

                        Nome

                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">

                        Livros

                    </th>

                    <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-600">

                        Criado em

                    </th>

                    <th class="px-6 py-4 text-right text-xs font-semibold uppercase tracking-wider text-slate-600">

                        Ações

                    </th>

                </tr>

            </thead>

            <tbody class="divide-y divide-slate-100">

                @forelse($authors as $author)

                    <tr class="transition hover:bg-slate-50">

                        <td class="px-6 py-4">

                            <div>

                                <p class="font-semibold text-slate-900">

                                    {{ $author->name }}

                                </p>

                                @if($author->biography)

                                    <p class="mt-1 line-clamp-1 text-sm text-slate-500">

                                        {{ $author->biography }}

                                    </p>

                                @endif

                            </div>

                        </td>

                        <td class="px-6 py-4">

                            <span class="rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">

                                {{ $author->books_count }}

                            </span>

                        </td>

                        <td class="px-6 py-4 text-sm text-slate-500">

                            {{ $author->created_at->format('d/m/Y') }}

                        </td>

                        <td class="px-6 py-4">

                            <div class="flex justify-end gap-2">

                                <a
                                    href="{{ route('admin.authors.show', $author) }}"
                                    class="rounded-lg border border-slate-300 px-3 py-2 text-sm font-medium text-slate-700 transition hover:bg-slate-100"
                                >
                                    Ver
                                </a>

                                <a
                                    href="{{ route('admin.authors.edit', $author) }}"
                                    class="rounded-lg bg-amber-500 px-3 py-2 text-sm font-medium text-white transition hover:bg-amber-600"
                                >
                                    Editar
                                </a>

                                <form
                                    action="{{ route('admin.authors.destroy', $author) }}"
                                    method="POST"
                                    onsubmit="return confirm('Deseja realmente excluir este autor?')"
                                >

                                    @csrf

                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-lg bg-red-600 px-3 py-2 text-sm font-medium text-white transition hover:bg-red-700"
                                    >
                                        Excluir
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="px-6 py-12 text-center text-slate-500"
                        >

                            Nenhum autor encontrado.

                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    @if($authors->hasPages())

        <div class="border-t border-slate-200 px-6 py-4">

            {{ $authors->links() }}

        </div>

    @endif

</div>
