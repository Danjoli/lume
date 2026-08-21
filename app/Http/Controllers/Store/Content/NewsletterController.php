<?php

namespace App\Http\Controllers\Store\Content;

use App\Http\Controllers\Controller;
use App\Http\Requests\Store\Newsletter\StoreNewsletterRequest;
use App\Models\NewsletterSubscriber;
use App\Services\Store\Content\NewsletterService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsletterController extends Controller
{
    public function __construct(
        private readonly NewsletterService $newsletterService
    ) {}

    public function store(
        StoreNewsletterRequest $request
    ): RedirectResponse {
        $this->newsletterService->subscribe(
            $request->string('email')->toString()
        );

        return back()->with(
            'newsletter_success',
            'E-mail cadastrado com sucesso!'
        );
    }

    public function unsubscribe(
        Request $request,
        NewsletterSubscriber $subscriber
    ): View {
        abort_unless(
            $request->hasValidSignature(),
            403
        );

        $this->newsletterService->unsubscribe(
            $subscriber
        );

        return view('store.newsletter.unsubscribed');
    }
}
