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
        /** @var Task $task */
        $this->task = Task::factory()->create();
        $this->data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);
    }

    public function testAccessToTheTasksPage()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function testStoreTasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('tasks.store'), $this->data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('tasks');

        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testCreateTasks()
    {
        $response = $this->actingAs($this->user)
            ->get(route('tasks.create'));

        $response->assertOk();
    }

    public function testNotCreateTasksWithoutAuthorized()
    {
        $response = $this->get(route('tasks.create'));

        $response->assertStatus(403);
    }

    public function testEditPageTasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('tasks.edit', $this->task));

        $response->assertOk();
    }

    public function testNotEditPageTasksWithoutAuthorized()
    {
        $response = $this->get(route('tasks.edit', $this->task));

        $response->assertStatus(403);
    }

    public function testUpdateTasks()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->patch(route('tasks.update', $this->task), $this->data);

        $response->assertRedirect('tasks');

        $this->assertDatabaseHas('tasks', $this->data);
    }

    public function testDeleteTasks()
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

    public function testNotDeleteTaskWithoutCreater()
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
