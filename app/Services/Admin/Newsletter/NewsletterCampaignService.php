<?php

namespace App\Services\Admin\Newsletter;

use App\Jobs\SendNewsletterCampaign;
use App\Models\NewsletterCampaign;
use Illuminate\Database\Eloquent\Collection;

class NewsletterCampaignService
{
    /**
     * @param  array<string, mixed>  $data
     */
    public function create(
        array $data
    ): NewsletterCampaign {
        return NewsletterCampaign::create([
            'subject' => $data['subject'],
            'title' => $data['title'],
            'content' => $data['content'],

            'status' => 'draft',
            'sent_at' => null,
        ]);
    }

    public function find(
        NewsletterCampaign $campaign
    ): NewsletterCampaign {
        return $campaign;
    }

    public function recent(
        int $limit = 5
    ): Collection {
        return NewsletterCampaign::query()
            ->latest()
            ->limit($limit)
            ->get();
    }

    /**
     * @param  array<string, mixed>  $data
     */
    public function update(
        NewsletterCampaign $campaign,
        array $data
    ): NewsletterCampaign {
        abort_if(
            $campaign->status !== 'draft',
            403
        );

        $campaign->update([
            'subject' => $data['subject'],
            'title' => $data['title'],
            'content' => $data['content'],
        ]);

        return $campaign->refresh();
    }

    public function send(
        NewsletterCampaign $campaign
    ): void {
        abort_if(
            $campaign->status !== 'draft',
            403
        );

        SendNewsletterCampaign::dispatch(
            $campaign
        );
    }
}
