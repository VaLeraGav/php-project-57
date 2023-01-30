<?php

namespace Tests\Feature;

use App\Models\TaskStatus;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        TaskStatus::factory()->create();
    }

    public function testAccessToTheTasksPage()
    {
        $response = $this->get(route('tasks.index'));

        $response->assertOk();
    }

    public function testStoreTasks()
    {
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('tasks.store'), $data);

        $response->assertRedirect('tasks');

        $this->assertDatabaseHas('tasks', $data);
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
        $task = Task::factory()->create();

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('tasks.edit', $task));

        $response->assertOk();
    }

    public function testNotEditPageTasksWithoutAuthorized()
    {
        $task = Task::factory()->create();

        $response = $this->get(route('tasks.edit', $task));

        $response->assertStatus(403);
    }

    public function testUpdateTasks()
    {
        $task = Task::factory()->create();
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->patch(route('tasks.update', $task), $data);

        $response->assertRedirect('tasks');

        $this->assertDatabaseHas('tasks', $data);
    }

    public function testDeleteTasks()
    {
        $task = Task::factory()->create();

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('tasks.destroy', $task));

        $response->assertRedirect('tasks');

        $this->assertDatabaseMissing(
            'tasks',
            $task->only([
                'name',
                'description',
                'status_id',
                'assigned_to_id',
            ])
        );
    }

    public function testNotDeleteTaskWithoutCreater()
    {
        $task = Task::factory()->create();
        $data = Task::factory()->make()->only([
            'name',
            'description',
            'status_id',
            'assigned_to_id',
        ]);

        $responseUser1 = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('tasks.store', $data));

        $user2 = User::factory()->create();

        $responseUser2 = $this->actingAs($user2)
            ->withSession(['banned' => false])
            ->delete(route('tasks.destroy', $task));

        $responseUser2->assertRedirect();

        $this->assertDatabaseHas('tasks', $data);
    }
}
