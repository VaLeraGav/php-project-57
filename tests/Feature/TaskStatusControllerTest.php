<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\TaskStatus;
use App\Models\User;

class TaskStatusControllerTest extends TestCase
{
    private User $user;
    private TaskStatus $taskStatus;
    private array $data;

    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->data = TaskStatus::factory()->make()->only(['name']);
        $this->taskStatus = TaskStatus::factory()->create();
    }

    public function test_access_to_the_task_status_page()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('task_statuses.index'));

        $response->assertOk();
    }

    public function test_store_task_status()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('task_statuses.store'), $this->data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('task_statuses');

        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function test_not_create_store_task_status_without_authorized()
    {
        $response = $this->post(route('task_statuses.store'), $this->data);

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseMissing('task_statuses', $this->data);
    }

    public function test_not_create_task_status_without_authorized(): void
    {
        $response = $this->get(route('task_statuses.create'));

        $response->assertStatus(403);
    }

    public function test_edit_page()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('task_statuses.edit', $this->taskStatus));

        $response->assertOk();
    }

    public function test_update_task_status()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('task_statuses.update', $this->taskStatus), $this->data);

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseHas('task_statuses', $this->data);
    }

    public function test_not_update_task_status_without_authorized()
    {
        $response = $this->put(route('task_statuses.update', $this->taskStatus), $this->data);

        $response->assertRedirect('task_statuses');

        $this->assertDatabaseMissing('task_statuses', $this->data);
    }

    public function test_delete_task_status()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('task_statuses.destroy', $this->taskStatus));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('task_statuses');

        $this->assertDatabaseMissing('task_statuses', $this->taskStatus->only(['name']));
    }

}
