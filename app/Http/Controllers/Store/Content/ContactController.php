<?php

namespace App\Http\Controllers\Store\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Contact\StoreContactRequest;
use App\Services\Store\Content\ContactService;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        private readonly ContactService $contactService
    ) {}

    public function store(
        StoreContactRequest $request
    ): RedirectResponse {
        $this->contactService->create(
            $request->validated()
        );

        return back()->with(
            'newsletter_success',
            'E-mail cadastrado com sucesso!'
        );
    }
}
