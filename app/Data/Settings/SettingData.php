<?php

namespace App\Data\Settings;

use App\Http\Requests\Admin\Settings\UpdateSettingRequest;

final readonly class SettingData
{
    public function __construct(
        public string $storeName,
        public ?string $companyName,
        public ?string $cnpj,
        public ?string $description,

        public ?string $email,
        public ?string $phone,
        public ?string $whatsapp,

        public ?string $cep,
        public ?string $street,
        public ?string $number,
        public ?string $complement,
        public ?string $neighborhood,
        public ?string $city,
        public ?string $state,

        public ?string $instagram,
        public ?string $facebook,
        public ?string $youtube,
        public ?string $tiktok,
        public ?string $linkedin,

        public ?string $metaTitle,
        public ?string $metaDescription,

        public float $minimumOrderAmount,
        public bool $allowOutOfStockSales,
        public string $currency,

        public ?string $originCep,
        public ?float $freeShippingThreshold,

        public int $lowStockThreshold,

        public bool $reviewsRequirePurchase,
        public bool $reviewsAutoApprove,

        public ?string $senderName,
        public ?string $senderEmail,
    ) {}

    public static function fromRequest(
        UpdateSettingRequest $request
    ): self {
        return new self(
            storeName: $request->string('store_name')->toString(),
            companyName: $request->input('company_name'),
            cnpj: $request->input('cnpj'),
            description: $request->input('description'),

            email: $request->input('email'),
            phone: $request->input('phone'),
            whatsapp: $request->input('whatsapp'),

            cep: $request->input('cep'),
            street: $request->input('street'),
            number: $request->input('number'),
            complement: $request->input('complement'),
            neighborhood: $request->input('neighborhood'),
            city: $request->input('city'),
            state: $request->input('state'),

            instagram: $request->input('instagram'),
            facebook: $request->input('facebook'),
            youtube: $request->input('youtube'),
            tiktok: $request->input('tiktok'),
            linkedin: $request->input('linkedin'),

            metaTitle: $request->input('meta_title'),
            metaDescription: $request->input('meta_description'),

            minimumOrderAmount: $request->float('minimum_order_amount'),
            allowOutOfStockSales: $request->boolean('allow_out_of_stock_sales'),
            currency: $request->string('currency')->toString(),

            originCep: $request->input('origin_cep'),
            freeShippingThreshold: $request->filled('free_shipping_threshold')
                ? $request->float('free_shipping_threshold')
                : null,

            lowStockThreshold: $request->integer('low_stock_threshold'),

            reviewsRequirePurchase: $request->boolean('reviews_require_purchase'),
            reviewsAutoApprove: $request->boolean('reviews_auto_approve'),

            senderName: $request->input('sender_name'),
            senderEmail: $request->input('sender_email'),
        );
    }

    public function toArray(): array
    {
        return [
            'store_name' => $this->storeName,
            'company_name' => $this->companyName,
            'cnpj' => $this->cnpj,
            'description' => $this->description,

            'email' => $this->email,
            'phone' => $this->phone,
            'whatsapp' => $this->whatsapp,

            'cep' => $this->cep,
            'street' => $this->street,
            'number' => $this->number,
            'complement' => $this->complement,
            'neighborhood' => $this->neighborhood,
            'city' => $this->city,
            'state' => $this->state,

            'instagram' => $this->instagram,
            'facebook' => $this->facebook,
            'youtube' => $this->youtube,
            'tiktok' => $this->tiktok,
            'linkedin' => $this->linkedin,

            'meta_title' => $this->metaTitle,
            'meta_description' => $this->metaDescription,

            'minimum_order_amount' => $this->minimumOrderAmount,
            'allow_out_of_stock_sales' => $this->allowOutOfStockSales,
            'currency' => $this->currency,

            'origin_cep' => $this->originCep,
            'free_shipping_threshold' => $this->freeShippingThreshold,

            'low_stock_threshold' => $this->lowStockThreshold,

            'reviews_require_purchase' => $this->reviewsRequirePurchase,
            'reviews_auto_approve' => $this->reviewsAutoApprove,

            'sender_name' => $this->senderName,
            'sender_email' => $this->senderEmail,
        ];
    }
}
