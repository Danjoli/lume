<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Newsletter\StoreNewsletterCampaignRequest;
use App\Http\Requests\Admin\Newsletter\UpdateNewsletterCampaignRequest;
use App\Models\NewsletterCampaign;
use App\Services\Admin\Newsletter\NewsletterCampaignService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class NewsletterCampaignController extends Controller
{
    public function __construct(
        private readonly NewsletterCampaignService $newsletterCampaignService
    ) {}

    public function create(): View
    {
        return view('admin.newsletter.create');
    }

    public function store(
        StoreNewsletterCampaignRequest $request
    ): RedirectResponse {
        $campaign = $this->newsletterCampaignService->create(
            $request->validated()
        );

        return redirect()
            ->route(
                'admin.newsletter.show',
                $campaign
            )
            ->with(
                'success',
                'Campanha criada com sucesso.'
            );
    }

    public function show(
        NewsletterCampaign $campaign
    ): View {
        return view('admin.newsletter.show', [
            'campaign' => $this->newsletterCampaignService->find(
                $campaign
            ),
        ]);
    }

    public function edit(
        NewsletterCampaign $campaign
    ): View {
        abort_if(
            $campaign->status !== 'draft',
            403
        );

        return view('admin.newsletter.edit', [
            'campaign' => $this->newsletterCampaignService->find(
                $campaign
            ),
        ]);
    }

    public function update(
        UpdateNewsletterCampaignRequest $request,
        NewsletterCampaign $campaign
    ): RedirectResponse {
        $campaign = $this->newsletterCampaignService->update(
            $campaign,
            $request->validated()
        );

        return redirect()
            ->route(
                'admin.newsletter.show',
                $campaign
            )
            ->with(
                'success',
                'Campanha atualizada com sucesso.'
            );
    }

    public function send(
        NewsletterCampaign $campaign
    ): RedirectResponse {
        $this->newsletterCampaignService->send(
            $campaign
        );

        return back()->with(
            'success',
            'Campanha adicionada à fila de envio.'
        );
    }
}
