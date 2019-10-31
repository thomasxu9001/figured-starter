<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tests\TestCase;


class TestPost extends TestCase
{

    // It will be better if we can have a separated test database
    use RefreshDatabase;

    private $user;

    public function setUp(): void
    {
        parent::setUp();
        // Empty data in MongoDB, should setup a test MongoDB
        Post::truncate();
        $this->user = User::create(
            [
                'name' => 'tester',
                'email' => 'tester@dev.com',
                'password' => Hash::make('12345678'),
                'api_token' => Str::random(60)
            ]
        );
    }

    /**
     * @return void
     */
    public function testRedirect()
    {
        $response = $this->get('/');

        $response->assertStatus(302);
    }

    public function testConnection()
    {
        $connection = DB::connection('mongodb');
        $this->assertInstanceOf(\Jenssegers\Mongodb\Connection::class, $connection);
    }

    /**
     * @return void
     */
    public function testPostListAPI()
    {
        Post::create([
            'title' => 'First Title',
            'content' => 'First Content'
        ]);

        $response = $this->json('GET', '/api/posts')
            ->assertStatus(200);
        $data = json_decode($response->getContent());

        $this->assertEquals('First Title', $data->data[0]->title);
        $this->assertEquals('First Content', $data->data[0]->content);
    }

    /**
     * @return void
     */
    public function testCRUD()
    {
        $token = $this->user->api_token;
        $headers = [
            'Accept' => 'application/json',
            'Authorization' => "Bearer " . $token
        ];

        // Test create
        $payload = [
            'title' => 'CRUD test',
            'content' => 'CRUD test',
        ];
        // Should fail in validation, the content is short than 10
        $response = $this->actingAs($this->user, 'api')
            ->json('POST', '/api/posts/', $payload, $headers)
            ->assertStatus(422);

        $payload = [
            'title' => 'CRUD test',
            'content' => 'CRUD test long content',
        ];
        // Now should success
        $response = $this->actingAs($this->user, 'api')
            ->json('POST', '/api/posts/', $payload, $headers)
            ->assertStatus(200);
        $data = json_decode($response->getContent());
        $id = $data->_id;

        // Test read
        $response = $this->json('GET', '/api/posts/' . $id, $payload, $headers)
            ->assertStatus(200);
        $data = json_decode($response->getContent());
        $this->assertEquals('CRUD test', $data->title);
        $this->assertEquals('CRUD test long content', $data->content);

        // Test update
        $payload = [
            'title' => 'CRUD test',
            'content' => 'CRUD test long content updated',
        ];
        // Now should success
        $response = $this->actingAs($this->user, 'api')
            ->json('PUT', '/api/posts/' . $id, $payload, $headers)
            ->assertStatus(200);
        $data = json_decode($response->getContent());
        $this->assertEquals('CRUD test long content updated', $data->content);

        // Test delete
        $response = $this->actingAs($this->user, 'api')
            ->json('DELETE', '/api/posts/' . $id, $payload, $headers)
            ->assertStatus(200);
    }
}
