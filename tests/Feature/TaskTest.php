<?php

namespace Tests\Feature;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private TaskStatus $status;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->status = TaskStatus::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('tasks.index'));
        $response->assertOk();
    }

    public function testCreateForGuest()
    {
        $response = $this->get(route('tasks.create'));
        $response->assertRedirect('/login');
    }

    public function testStoreForGuest()
    {
        $data = [
            'name' => 'Test task',
            'status_id' => $this->status->id
        ];
        $response = $this->post(route('tasks.store'), $data);
        $response->assertRedirect('/login');
    }

    public function testStoreForUser()
    {
        $data = [
            'name' => 'Test task',
            'status_id' => $this->status->id
        ];
        $response = $this->actingAs($this->user)
            ->post(route('tasks.store'), $data);

        $response->assertRedirect(route('tasks.index'));
        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDestroyByNonCreator()
    {
        $task = Task::factory()->create();
        $response = $this->actingAs($this->user)
            ->delete(route('tasks.destroy', $task));

        $response->assertForbidden();
    }
}
