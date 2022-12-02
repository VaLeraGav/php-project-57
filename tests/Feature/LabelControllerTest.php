<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Label;
use App\Models\User;

class LabelControllerTest extends TestCase
{
    private User $user;
    private Label $label;
    private array $data;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
        $this->label = Label::factory()->create();
        $this->data = Label::factory()->make()->only(['name', 'description']);
    }

    public function test_access_to_the_labels_page()
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function test_store_labels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('labels.store'), $this->data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('labels');

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function test_not_create_store_labels_without_authorized()
    {
        $response = $this->post(route('labels.store'), $this->data);

        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function test_create_labels()
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.create'));

        $response->assertOk();
    }

    public function test_not_create_labels_without_authorized()
    {
        $response = $this->get(route('labels.create'));

        $response->assertStatus(403);
    }

    public function test_edit_page_labels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('labels.edit', $this->label));

        $response->assertOk();
    }

    public function test_not_edit_page_tasks_without_authorized()
    {
        $response = $this->get(route('labels.edit', $this->label));

        $response->assertStatus(403);
    }

    public function test_update_labels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect('labels');

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function test_not_update_labels_without_authorized()
    {
        $response = $this->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function test_delete_labels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('labels.destroy', $this->label));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $this->label->only(['name']));
    }
}
