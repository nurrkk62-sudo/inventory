<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Item;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemApiTest extends TestCase
{
    use RefreshDatabase;

    protected $user;
    protected $admin;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->category = Category::create([
            'name' => 'Electronics',
            'description' => 'Electronic products'
        ]);

        $this->user = User::factory()->create([
            'role' => 'user'
        ]);

        $this->admin = User::factory()->create([
            'role' => 'admin'
        ]);
    }

    public function test_guest_cannot_access_items()
    {
        $this->getJson('/api/v1/items')
            ->assertStatus(500)
            ->assertJson([
                'status' => 'error',
                'data' => null,
                'message' => 'Unauthenticated.',
            ]);
    }

    public function test_user_can_list_items()
    {
        $token = $this->user
            ->createToken('api-token')
            ->plainTextToken;

        $this->withHeader(
            'Authorization',
            "Bearer {$token}"
        )
        ->getJson('/api/v1/items')
        ->assertStatus(200)
        ->assertJsonStructure([
            'status',
            'data',
            'message'
        ]);
    }

    public function test_user_cannot_delete_item()
    {
        $token = $this->user
            ->createToken('api-token')
            ->plainTextToken;

        $this->deleteJson(
            '/api/v1/items/1',
            [],
            ['Authorization' => "Bearer {$token}"]
        )->assertStatus(403);
    }

    public function test_admin_can_delete_item()
    {
        $item = Item::create([
            'category_id' => $this->category->id,
            'name' => 'Laptop',
            'stock' => 10,
            'price' => 1000000
        ]);

        $token = $this->admin
            ->createToken('api-token')
            ->plainTextToken;

        $this->deleteJson(
            "/api/v1/items/{$item->id}",
            [],
            ['Authorization' => "Bearer {$token}"]
        )->assertStatus(200);
    }
}