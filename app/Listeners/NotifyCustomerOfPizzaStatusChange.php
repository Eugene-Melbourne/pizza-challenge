<?php

namespace App\Listeners;

use App\Events\PizzaStatusUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Encryption\Encrypter;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpKernel\Exception\HttpException;

use function config;
use function json_encode;

class NotifyCustomerOfPizzaStatusChange implements ShouldQueue
{
    use InteractsWithQueue;

    /**
     * @throws HttpException
     */
    public function handle(PizzaStatusUpdated $event): void
    {
        $pizza = $event->pizza;

        $payload = [
            'pizza_id' => $pizza->id,
            'customer_name' => $pizza->customer->name,
            'status_key' => $pizza->status->key,
            'status_set_at' => $pizza->status_set_at->toDateTimeString(),
        ];

        $encryptionConfig = config('services.public_website_api.encryption');
        $authConfig = config('services.public_website_api.basic_auth');
        $apiUrl = config('services.public_website_api.url');

        if ($encryptionConfig['is_active']) {
            $payload = (new Encrypter($encryptionConfig['key'], $encryptionConfig['cipher']))->encrypt($payload);
        } else {
            $payload = json_encode($payload, JSON_THROW_ON_ERROR);
        }

        $response = Http::when($authConfig['is_active'] ?? false, function ($http) use ($authConfig) {
            return $http->withBasicAuth(
                $authConfig['username'] ?? '',
                $authConfig['password'] ?? ''
            );
        })->post($apiUrl, ['payload' => $payload]);

        if (! $response->successful()) {
            $message = "Failed to push pizza status update to {$apiUrl} for pizza ID: {$pizza->id}. Response: {$response->status()} - {$response->body()}";
            throw new HttpException($response->status(), $message);
        }
    }
}
