<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusControllerTest extends TestCase
{
    private User $user;
    private TaskStatus $taskStatus;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        /** @var TaskStatusControllerTest $this::$taskStatus */
        $this->taskStatus = TaskStatus::factory()->create();
        $this->data = TaskStatus::factory()->make()->only(['name']);
    }

    public function testAccessToTheTaskStatusPage()
    {
        $response = $this->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function testStoreTaskStatus()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('task_statuses.store'), $this->data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('task_statuses');

        $this->assertDatabaseHas('task_statuses', $this->data);
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
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertOk();
    }

    public function testNotEditPageTasksWithoutAuthorized()
    {
        $response = $this->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertStatus(403);
    }

    public function testUpdateTaskStatus()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('task_statuses.update', $this->taskStatus), $this->data);

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function testDeleteTaskStatus()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('task_statuses.destroy', $this->taskStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('task_statuses');

        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->only(['name']));
    }
}
