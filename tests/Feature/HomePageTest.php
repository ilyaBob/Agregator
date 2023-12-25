<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use WithoutMiddleware;

    public int $id = 40;

    public function test_author_index(): void
    {
        $response = $this->get('/api/author');

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                '*' => [
                    'id',
                    'name',
                    'isActive',
                    'slug',
                    'createdAt',
                    'books',
                ]
            ]
        ]);
    }

    public function test_author_show(): void
    {
        $response = $this->get('/api/author/2');

        $response->assertOk();

        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'isActive',
                'slug',
                'createdAt',
                'books',
            ]
        ]);

    }

    public function test_author_create(): void
    {
        $response = $this->post('/api/author/create', [
            'name' => 'wwwwww',
            'is_active' => 1
        ]);
        $this->id = json_decode($response->getContent())->data->id;

        $response->assertStatus(201);

        $this->assertDatabaseHas('authors', [
            'id' => $this->id
        ]);
    }

   /* public function test_author_update(): void
    {
        $response = $this->patch('/api/author/51', [
            'name' => 'wwwwwwssssss',
            'is_active' => 0
        ]);

        $response->assertOk();


        $this->assertDatabaseHas('authors', [
            'id' => 51,
            'name' => 'wwwwwwssssss',
        ]);

    }*/

    public function test_author_delete(): void
    {
        $response = $this->delete('/api/author/'. $this->id);
        $response->assertOk();
    }

    public function test_author_delete_sss(): void
    {
        $response = $this->deleteJson(route('author.delete', ['id' => 50]));
        $response->assertStatus(302);
    }
}
