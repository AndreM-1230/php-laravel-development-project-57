<?php

namespace Tests\Feature;

use App\Models\Label;
use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LabelTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $response = $this->get(route('labels.index'));
        $response->assertOk();
    }

    public function testCreateForGuest()
    {
        $response = $this->get(route('labels.create'));
        $response->assertRedirect('/login');
    }

    public function testStoreForGuest()
    {
        $data = ['name' => 'Test Label'];
        $response = $this->post(route('labels.store'), $data);
        $response->assertRedirect('/login');
    }

    public function testDestroyWithTasks()
    {
        $label = Label::factory()->hasTasks(1)->create();
        $user = \App\Models\User::factory()->create();

        $response = $this->actingAs($user)
            ->delete(route('labels.destroy', $label));

        $response->assertRedirect();
        $this->assertDatabaseHas('labels', ['id' => $label->id]);
    }
}
