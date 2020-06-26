<?php

namespace Tests\Feature;

use App\Indicator;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\CreatesApplication;
use Tests\TestCase;

/**
 * Class IndicatorTest
 */
class IndicatorTest extends TestCase
{
    use CreatesApplication;
    use RefreshDatabase;

    protected $headers;

    public function setUp(): void
    {
        parent::setUp();
        $this->headers = ['Accept' => 'application/json'];
    }

    public function testIndicatorsListedSuccessfully()
    {
        factory(Indicator::class)->create([
            'value' => 'Quo eius',
            'type' => 'string',
            'length' => 8
        ]);

        factory(Indicator::class)->create([
            'value' => 'Rerum tempora',
            'type' => 'string',
            'length' => 11
        ]);

        $this->json('GET', 'api/indicators/', [], $this->headers)
            ->assertStatus(200)
            ->assertJson([
                ['value' => 'Quo eius', 'type' => 'string', 'length' => '8'],
                ['value' => 'Rerum tempora', 'type' => 'string', 'length' => '11']
            ])
            ->assertJsonStructure([
                '*' => ['id', 'value', 'type', 'length', 'created_at', 'updated_at'],
            ]);
    }

    public function testIndicatorGetByIdCorrectly()
    {
        $indicator = factory(Indicator::class)->create([
            'value' => 'Maiores iusto sapiente',
            'type' => 'string',
            'length' => 8
        ]);

        $this->json('GET', 'api/indicators/' . $indicator->id, [], $this->headers)
            ->assertStatus(200)
            ->assertJson([
                'value' => 'Maiores iusto sapiente'
            ]);
    }

    public function testIndicatorsPostStoreCorrectly()
    {
        $payload = [
            'type' => 'string',
            'length' => 15,
        ];

        $this->json('POST', '/api/indicators/', $payload, $this->headers)
            ->assertStatus(201)
            ->assertJson(['success' => 'true', 'message' => 'Indicator was saved']);
    }

    public function testNoValidTypeForIndicatorsPostStore()
    {
        $payload = [
            'type' => 'string47',
            'length' => 11,
        ];

        $this->json('POST', '/api/indicators/', $payload, $this->headers)
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'type' =>
                        ['The selected type is invalid.']
                ],
                'success' => false,
            ]);
    }

    public function testNoValidLengthForIndicatorsPostStore()
    {
        $payload = [
            'type' => 'alphanumeric',
            'length' => 11857,
        ];

        $this->json('POST', '/api/indicators/', $payload, $this->headers)
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'length' =>
                        ['The length must be between 1 and 4 digits.']
                ],
                'success' => false,
            ]);
    }

    public function testNoValidLengthAndTypeForIndicatorsPostStore()
    {
        $payload = [
            'type' => 'int',
            'length' => 698741,
        ];

        $this->json('POST', '/api/indicators/', $payload, $this->headers)
            ->assertStatus(400)
            ->assertJson([
                'errors' => [
                    'length' =>
                        ['The length must be between 1 and 4 digits.'],
                    'type' =>
                        ['The selected type is invalid.'],
                ],
                'success' => false,
            ]);
    }
}
