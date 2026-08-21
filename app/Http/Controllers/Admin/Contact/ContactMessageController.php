<?php

namespace App\Http\Controllers\Admin\Contact;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Contact\UpdateContactMessageRequest;
use App\Models\ContactMessage;
use App\Services\Admin\Contact\ContactMessageService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ContactMessageController extends Controller
{
    public function __construct(
        private readonly ContactMessageService $contactMessageService
    ) {}

    public function index(): View
    {
        return view('admin.contact-messages.index', [
            'messages' => $this->contactMessageService->paginate(),
        ]);
    }

    public function show(
        ContactMessage $contactMessage
    ): View {
        return view('admin.contact-messages.show', [
            'message' => $this->contactMessageService->find(
                $contactMessage
            ),
        ]);
    }

    public function updateStatus(
        UpdateContactMessageRequest $request,
        ContactMessage $contactMessage
    ): RedirectResponse {
        $this->contactMessageService->updateStatus(
            $contactMessage,
            $request->string('status')->toString()
        );

        return back()->with(
            'success',
            'Status do atendimento atualizado com sucesso.'
        );
    }
}
