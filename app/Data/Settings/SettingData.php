<?php

namespace App\Data\Settings;

use App\Http\Requests\Admin\Settings\UpdateSettingRequest;

readonly class SettingData
{
    public function __construct(

        /*
        |--------------------------------------------------------------------------
        | Loja
        |--------------------------------------------------------------------------
        */

        public string $storeName,

        public ?string $companyName,

        public ?string $cnpj,

        public ?string $description,

        /*
        |--------------------------------------------------------------------------
        | Contato
        |--------------------------------------------------------------------------
        */

        public string $email,

        public ?string $phone,

        public ?string $whatsapp,

        /*
        |--------------------------------------------------------------------------
        | Endereço
        |--------------------------------------------------------------------------
        */

        public ?string $cep,

        public ?string $street,

        public ?string $number,

        public ?string $complement,

        public ?string $neighborhood,

        public ?string $city,

        public ?string $state,

        /*
        |--------------------------------------------------------------------------
        | Redes Sociais
        |--------------------------------------------------------------------------
        */

        public ?string $facebook,

        public ?string $instagram,

        public ?string $linkedin,

        public ?string $youtube,

        public ?string $tiktok,

        public ?string $twitter,

        /*
        |--------------------------------------------------------------------------
        | Aparência
        |--------------------------------------------------------------------------
        */

        public ?string $logo,

        public ?string $favicon,

        /*
        |--------------------------------------------------------------------------
        | SEO
        |--------------------------------------------------------------------------
        */

        public ?string $metaTitle,

        public ?string $metaDescription,

        public ?string $keywords,

        /*
        |--------------------------------------------------------------------------
        | Pagamento
        |--------------------------------------------------------------------------
        */

        public ?string $paymentGateway,

        public ?string $pixKey,

        public string $currency,

        /*
        |--------------------------------------------------------------------------
        | Frete
        |--------------------------------------------------------------------------
        */

        public ?string $defaultCarrier,

        public ?string $originZipcode,

        /*
        |--------------------------------------------------------------------------
        | Email
        |--------------------------------------------------------------------------
        */

        public ?string $senderName,

        public ?string $senderEmail,

    ) {
    }

    /**
     * Cria um DTO a partir do Form Request.
     */
    public static function fromRequest(
        UpdateSettingRequest $request
    ): self {

        return new self(

            storeName: $request->string('store_name')->toString(),

            companyName: $request->input('company_name'),

            cnpj: $request->input('cnpj'),

            description: $request->input('description'),

            email: $request->string('email')->toString(),

            phone: $request->input('phone'),

            whatsapp: $request->input('whatsapp'),

            cep: $request->input('cep'),

            street: $request->input('street'),

            number: $request->input('number'),

            complement: $request->input('complement'),

            neighborhood: $request->input('neighborhood'),

            city: $request->input('city'),

            state: $request->input('state'),

            facebook: $request->input('facebook'),

            instagram: $request->input('instagram'),

            linkedin: $request->input('linkedin'),

            youtube: $request->input('youtube'),

            tiktok: $request->input('tiktok'),

            twitter: $request->input('twitter'),

            logo: $request->input('logo'),

            favicon: $request->input('favicon'),

            metaTitle: $request->input('meta_title'),

            metaDescription: $request->input('meta_description'),

            keywords: $request->input('keywords'),

            paymentGateway: $request->input('payment_gateway'),

            pixKey: $request->input('pix_key'),

            currency: $request->string('currency')->toString(),

            defaultCarrier: $request->input('default_carrier'),

            originZipcode: $request->input('origin_zipcode'),

            senderName: $request->input('sender_name'),

            senderEmail: $request->input('sender_email'),

        );

    }

    /**
     * Converte o DTO para array.
     */
    public function toArray(): array
    {
        return [

            /*
            |--------------------------------------------------------------------------
            | Loja
            |--------------------------------------------------------------------------
            */

            'store_name' => $this->storeName,

            'company_name' => $this->companyName,

            'cnpj' => $this->cnpj,

            'description' => $this->description,

            /*
            |--------------------------------------------------------------------------
            | Contato
            |--------------------------------------------------------------------------
            */

            'email' => $this->email,

            'phone' => $this->phone,

            'whatsapp' => $this->whatsapp,

            /*
            |--------------------------------------------------------------------------
            | Endereço
            |--------------------------------------------------------------------------
            */

            'cep' => $this->cep,

            'street' => $this->street,

            'number' => $this->number,

            'complement' => $this->complement,

            'neighborhood' => $this->neighborhood,

            'city' => $this->city,

            'state' => $this->state,

            /*
            |--------------------------------------------------------------------------
            | Redes Sociais
            |--------------------------------------------------------------------------
            */

            'facebook' => $this->facebook,

            'instagram' => $this->instagram,

            'linkedin' => $this->linkedin,

            'youtube' => $this->youtube,

            'tiktok' => $this->tiktok,

            'twitter' => $this->twitter,

            /*
            |--------------------------------------------------------------------------
            | Aparência
            |--------------------------------------------------------------------------
            */

            'logo' => $this->logo,

            'favicon' => $this->favicon,

            /*
            |--------------------------------------------------------------------------
            | SEO
            |--------------------------------------------------------------------------
            */

            'meta_title' => $this->metaTitle,

            'meta_description' => $this->metaDescription,

            'keywords' => $this->keywords,

            /*
            |--------------------------------------------------------------------------
            | Pagamento
            |--------------------------------------------------------------------------
            */

            'payment_gateway' => $this->paymentGateway,

            'pix_key' => $this->pixKey,

            'currency' => $this->currency,

            /*
            |--------------------------------------------------------------------------
            | Frete
            |--------------------------------------------------------------------------
            */

            'default_carrier' => $this->defaultCarrier,

            'origin_zipcode' => $this->originZipcode,

            /*
            |--------------------------------------------------------------------------
            | Email
            |--------------------------------------------------------------------------
            */

            'sender_name' => $this->senderName,

            'sender_email' => $this->senderEmail,

        ];
    }
}
