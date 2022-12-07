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

    public function testAccessToTheLabelsPage()
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function testStoreLabels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('labels.store'), $this->data);

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('labels');

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testCreateLabels()
    {
        $response = $this->actingAs($this->user)
            ->get(route('labels.create'));

        $response->assertOk();
    }

    public function testNotCreateLabelsWithoutAuthorized()
    {
        $response = $this->get(route('labels.create'));

        $response->assertStatus(403);
    }

    public function testEditPageLabels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('labels.edit', $this->label));

        $response->assertOk();
    }

    public function testNotEditPageTasksWithoutAuthorized()
    {
        $response = $this->get(route('labels.edit', $this->label));

        $response->assertStatus(403);
    }

    public function testUpdateLabels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect('labels');

        $this->assertDatabaseHas('labels', $this->data);
    }

    public function testNotUpdateLabelsWithoutAuthorized()
    {
        $response = $this->put(route('labels.update', $this->label), $this->data);

        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $this->data);
    }

    public function testDeleteLabels()
    {
        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('labels.destroy', $this->label));

        $response->assertSessionHasNoErrors();
        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $this->label->only(['name']));
    }
}
