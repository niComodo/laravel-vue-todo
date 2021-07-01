<?php

namespace Tests\Feature;

use App\Models\Todo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TodosTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_todos_list()
    {
        $todos = Todo::factory()->count(5)->create();

        $this->get(route('todo'))
            ->assertStatus(200)
            ->assertViewHas('todos', $todos->toArray());
    }

    public function test_create_todo()
    {
        $this->post(route('todo.store'), [
            'content' => 'ciao bello',
            'is_done' => false
        ])
            ->assertStatus(201)
            ->assertJsonFragment([
                'id' => 1,
                'content' => 'ciao bello',
                'is_done' => false
            ]);
    }
}
