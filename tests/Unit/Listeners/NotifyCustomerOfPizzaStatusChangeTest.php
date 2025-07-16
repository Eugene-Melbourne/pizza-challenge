<?php

namespace Tests\Unit\Listeners;

use App\Events\PizzaStatusUpdated;
use App\Listeners\NotifyCustomerOfPizzaStatusChange;
use App\Models\Pizza;
use App\Models\PizzaStatus;
use Illuminate\Encryption\Encrypter;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;
use Mockery;
use Tests\TestCase;

class NotifyCustomerOfPizzaStatusChangeTest extends TestCase
{
    use DatabaseTransactions;

    private Pizza $pizza;

    private string $key;

    protected function setUp(): void
    {
        parent::setUp();

        // Arrange
        $this->key = random_bytes(32);

        Config::set('services.public_website_api.encryption', [
            'is_active' => true,
            'key' => $this->key,
            'cipher' => 'AES-256-CBC',
        ]);
        Config::set('services.public_website_api.url', 'https://example.com/api');

        Config::set('services.public_website_api.basic_auth', [
            'is_active' => true,
            'username' => 'testuser',
            'password' => 'testpass',
        ]);

        $this->pizza = Pizza::factory()->create([
            'status_set_at' => Carbon::parse('2024-01-01 12:00:00'),
            'status_id' => PizzaStatus::getByKey(PizzaStatus::KEY_STARTED)->id,
        ]);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_send_encrypted_payload_basic_auth_off()
    {
        Config::set('services.public_website_api.basic_auth', [
            'is_active' => false,
        ]);

        $pizza = $this->pizza;
        $key = $this->key;

        $event = new PizzaStatusUpdated($pizza);

        // Intercept the HTTP call and decode the payload
        Http::fake([
            'https://example.com/api' => function ($request) use ($key, $pizza) {
                $this->assertArrayHasKey('payload', $request->data());
                $encrypted = $request->data()['payload'];

                $encrypter = new Encrypter($key, 'AES-256-CBC');
                $decrypted = $encrypter->decrypt($encrypted);

                $this->assertEquals([
                    'pizza_id' => $pizza->id,
                    'customer_name' => $pizza->customer->name,
                    'status_key' => PizzaStatus::KEY_STARTED,
                    'status_set_at' => '2024-01-01 12:00:00',
                ], $decrypted);

                return Http::response([], 200);
            },
        ]);

        // Act
        $listener = new NotifyCustomerOfPizzaStatusChange;
        $listener->handle($event);
    }

    public function test_send_encrypted_payload_basic_auth_on()
    {
        Config::set('services.public_website_api.encryption', [
            'is_active' => false,
        ]);

        $pizza = $this->pizza;
        $key = $this->key;

        $event = new PizzaStatusUpdated($pizza);

        // Intercept the HTTP call and decode the payload
        Http::fake([
            'https://example.com/api' => function ($request) use ($pizza) {
                $this->assertArrayHasKey('payload', $request->data());
                $decrypted = $request->data()['payload'];

                $decrypted = json_decode($decrypted, true);

                $this->assertEquals([
                    'pizza_id' => $pizza->id,
                    'customer_name' => $pizza->customer->name,
                    'status_key' => PizzaStatus::KEY_STARTED,
                    'status_set_at' => '2024-01-01 12:00:00',
                ], $decrypted);

                // Check that basic auth header is present and correct
                $authHeader = $request->header('Authorization');
                $expected = 'Basic '.base64_encode('testuser:testpass');
                $this->assertEquals($expected, $authHeader[0] ?? null);

                return Http::response([], 200);
            },
        ]);

        // Act
        $listener = new NotifyCustomerOfPizzaStatusChange;
        $listener->handle($event);
    }
}
