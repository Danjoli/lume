<?php

namespace App\Http\Controllers\Admin\Newsletter;

use App\Http\Controllers\Controller;
use App\Services\Admin\Newsletter\NewsletterCampaignService;
use App\Services\Admin\Newsletter\NewsletterSubscriberService;
use Illuminate\View\View;

class NewsletterSubscriberController extends Controller
{
    public function __construct(
        private readonly NewsletterSubscriberService $newsletterSubscriberService,
        private readonly NewsletterCampaignService $newsletterCampaignService
    ) {}

    public function index(): View
    {
        return view('admin.newsletter.index', [
            'subscribers' => $this->newsletterSubscriberService->paginate(),

            'stats' => $this->newsletterSubscriberService->getStats(),

            'campaigns' => $this->newsletterCampaignService->recent(),
        ]);
    }
}
