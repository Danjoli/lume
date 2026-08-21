<?php

$asaasEnvironment = env('ASAAS_ENVIRONMENT', 'sandbox');
$melhorEnvioEnvironment = env('MELHOR_ENVIO_ENVIRONMENT', 'sandbox');

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'asaas' => [
        'environment' => $asaasEnvironment,
        'base_url' => $asaasEnvironment === 'production'
            ? env('ASAAS_PRODUCTION_BASE_URL', 'https://api.asaas.com/v3')
            : env('ASAAS_SANDBOX_BASE_URL', 'https://api-sandbox.asaas.com/v3'),
        'api_key' => $asaasEnvironment === 'production'
            ? env('ASAAS_PRODUCTION_API_KEY')
            : env('ASAAS_SANDBOX_API_KEY'),
        'webhook_token' => $asaasEnvironment === 'production'
            ? env('ASAAS_PRODUCTION_WEBHOOK_TOKEN')
            : env('ASAAS_SANDBOX_WEBHOOK_TOKEN'),
        'due_days' => (int) env('ASAAS_DUE_DAYS', 3),
    ],

    'melhor_envio' => [
        'environment' => $melhorEnvioEnvironment,
        'base_url' => $melhorEnvioEnvironment === 'production'
            ? env('MELHOR_ENVIO_PRODUCTION_BASE_URL', 'https://melhorenvio.com.br/api/v2')
            : env('MELHOR_ENVIO_SANDBOX_BASE_URL', 'https://sandbox.melhorenvio.com.br/api/v2'),
        'oauth_url' => $melhorEnvioEnvironment === 'production'
            ? env('MELHOR_ENVIO_PRODUCTION_OAUTH_URL', 'https://melhorenvio.com.br')
            : env('MELHOR_ENVIO_SANDBOX_OAUTH_URL', 'https://sandbox.melhorenvio.com.br'),
        'client_id' => $melhorEnvioEnvironment === 'production'
            ? env('MELHOR_ENVIO_PRODUCTION_CLIENT_ID')
            : env('MELHOR_ENVIO_SANDBOX_CLIENT_ID'),
        'client_secret' => $melhorEnvioEnvironment === 'production'
            ? env('MELHOR_ENVIO_PRODUCTION_CLIENT_SECRET')
            : env('MELHOR_ENVIO_SANDBOX_CLIENT_SECRET'),
        'from_postal_code' => $melhorEnvioEnvironment === 'production'
            ? env('MELHOR_ENVIO_PRODUCTION_FROM_POSTAL_CODE')
            : env('MELHOR_ENVIO_SANDBOX_FROM_POSTAL_CODE'),
        'user_agent' => env('MELHOR_ENVIO_USER_AGENT', env('APP_NAME', 'Lume').' contato@example.com'),
        'scopes' => env('MELHOR_ENVIO_SCOPES', 'cart-read cart-write shipping-calculate shipping-checkout shipping-generate shipping-print shipping-tracking shipping-cancel'),
    ],

];
