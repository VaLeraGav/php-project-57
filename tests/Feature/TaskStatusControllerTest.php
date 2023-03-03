<?php

namespace Tests\Feature;

use App\Models\Task;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testAccessToTheTaskStatusPage()
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function testStoreTaskStatus()
    {
        $data = TaskStatus::factory()->make()->only(['name']);

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('task_statuses.store'), $data);

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testCreateTaskStatus()
    {
        $response = $this->actingAs($this->user)
            ->get(route('task_statuses.create'));

        $response->assertOk();
    }

    public function testNotCreateTaskStatusWithoutAuthorized()
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertStatus(403);
    }

    public function testEditPageTaskStatus()
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('task_statuses.edit', $taskStatus));

        $response->assertOk();
    }

    public function testNotEditPageTasksWithoutAuthorized()
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->get(route('task_statuses.edit', $taskStatus));

        $response->assertStatus(403);
    }

    public function testUpdateTaskStatus()
    {
        $taskStatus = TaskStatus::factory()->create();
        $data = TaskStatus::factory()->make()->only(['name']);

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('task_statuses.update', $taskStatus), $data);

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseHas('task_statuses', $data);
    }

    public function testDeleteTaskStatus()
    {
        $taskStatus = TaskStatus::factory()->create();

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('task_statuses.destroy', $taskStatus));

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseMissing('task_statuses', $taskStatus->only(['name']));
    }
}
