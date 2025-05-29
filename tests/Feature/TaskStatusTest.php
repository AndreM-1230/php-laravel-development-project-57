<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskStatusTest extends TestCase
{
    use RefreshDatabase;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testIndex()
    {
        $response = $this->get(route('task_statuses.index'));
        $response->assertOk();
    }

    public function testCreateForGuest()
    {
        $response = $this->get(route('task_statuses.create'));
        $response->assertRedirect('/login');
    }

    public function testStoreForGuest()
    {
        $data = ['name' => 'test'];
        $response = $this->post(route('task_statuses.store'), $data);
        $response->assertRedirect('/login');
        $this->assertDatabaseMissing('task_statuses', $data);
    }

    public function testStoreForUser()
    {
        $data = ['name' => 'test'];
        $response = $this->actingAs($this->user)
            ->post(route('task_statuses.store'), $data);

        $response->assertRedirect(route('task_statuses.index'));
        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDestroyWithTasks()
    {
        $status = TaskStatus::factory()->hasTasks(1)->create();

        $response = $this->actingAs($this->user)
            ->delete(route('task_statuses.destroy', $status));

        $response->assertRedirect();
        $this->assertDatabaseHas('task_statuses', ['id' => $status->id]);
    }
}
