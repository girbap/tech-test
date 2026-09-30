<?php

namespace App\Services;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class WebhookApiService
{
    public function post(array $data): Response
    {
        $url = config('services.webhook.url');
        $token = config('services.webhook.token');

        return Http::withToken($token)
            ->acceptJson()
            ->timeout(5)
            ->post($url, $data);
    }
}
