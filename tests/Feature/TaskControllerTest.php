<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskControllerTest extends TestCase
{
    private User $user;
    private Task $task;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        TaskStatus::factory()->create();
        $this->task = Task::factory()->create();
        $this->data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
    }

    public function test_access_to_the_tasks_page()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function test_store_tasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('tasks.store'), $this->data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('tasks');

        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function test_not_create_store_tasks_without_authorized()
    {
        $response = $this->post(route('tasks.store'), $this->data);

        $response->assertRedirect('tasks');

        $this->assertDatabaseMissing('tasks', $this->data);
    }

    public function test_create_tasks()
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertOk();
    }

    public function test_not_create_tasks_without_authorized()
    {
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(403);
    }

    public function test_edit_page_tasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('tasks.edit', $this->task));

        $response->assertOk();
    }

    public function test_not_edit_page_tasks_without_authorized()
    {
        $response = $this->get(route('tasks.edit', $this->task));

        $response->assertStatus(403);
    }

    public function test_update_tasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->patch(route('tasks.update', $this->task), $this->data);

        $response->assertRedirect('tasks');

        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function test_not_update_tasks_without_authorized()
    {
        $response = $this->put(route('tasks.update', $this->task), $this->data);

        $response->assertRedirect('tasks');

        $this->assertDatabaseMissing('tasks', $this->data);
    }

    public function test_delete_tasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('tasks.destroy', $this->task));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('tasks');

        $this->assertDatabaseMissing(
            'tasks',
            $this->task->only([
                'name',
                'description',
                'status_id',
                'assigned_to_id',
            ])
        );
    }

    public function test_not_delete_task_without_creater()
    {
        $responseUser1 = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('tasks.store', $this->data));

        $user2 = User::factory()->create();

        $responseUser2 = $this->actingAs($user2)
            ->withSession(['banned' => false])
            ->delete(route('tasks.destroy', $this->task));

        $responseUser2->assertRedirect();

        $this->assertDatabaseHas('tasks', $this->data);
    }

}
