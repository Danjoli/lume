<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'company_name',
        'cnpj',
        'description',

        'email',
        'phone',
        'whatsapp',

        'cep',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',

        'instagram',
        'facebook',
        'youtube',
        'tiktok',
        'linkedin',

        'logo',
        'favicon',

        'meta_title',
        'meta_description',

        'minimum_order_amount',
        'allow_out_of_stock_sales',
        'currency',

        'origin_cep',
        'free_shipping_threshold',

        'low_stock_threshold',

        'reviews_require_purchase',
        'reviews_auto_approve',

        'sender_name',
        'sender_email',
    ];

    protected function casts(): array
    {
        return [
            'minimum_order_amount' => 'decimal:2',
            'free_shipping_threshold' => 'decimal:2',

            'allow_out_of_stock_sales' => 'boolean',

            'low_stock_threshold' => 'integer',

            'reviews_require_purchase' => 'boolean',
            'reviews_auto_approve' => 'boolean',
        ];
    }
}
