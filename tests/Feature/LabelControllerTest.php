<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Label;
use App\Models\User;

class LabelControllerTest extends TestCase
{
    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = User::factory()->create();
    }

    public function testAccessToTheLabelsPage()
    {
        $response = $this->get(route('labels.index'));

        $response->assertOk();
    }

    public function testStoreLabels()
    {
        $data = Label::factory()
            ->make()
            ->only(['name', 'description']);

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->post(route('labels.store'), $data);

        $response->assertRedirect('labels');

        $this->assertDatabaseHas('labels', $data);
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
        $label = Label::factory()->create();

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->get(route('labels.edit', $label));

        $response->assertOk();
    }

    public function testNotEditPageTasksWithoutAuthorized()
    {
        $label = Label::factory()->create();

        $response = $this->get(route('labels.edit', $label));

        $response->assertStatus(403);
    }

    public function testUpdateLabels()
    {
        $label = Label::factory()->create();

        $data = Label::factory()->make()
            ->only(['name', 'description']);

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->put(route('labels.update', $label), $data);

        $response->assertRedirect('labels');

        $this->assertDatabaseHas('labels', $data);
    }

    public function testNotUpdateLabelsWithoutAuthorized()
    {
        $label = Label::factory()->create();

        $data = Label::factory()->make()
            ->only(['name', 'description']);

        $response = $this->put(route('labels.update', $label), $data);

        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $data);
    }

    public function testDeleteLabels()
    {
        $label = Label::factory()->create();

        $response = $this->actingAs($this->user)
            ->withSession(['banned' => false])
            ->delete(route('labels.destroy', $label));

        $response->assertRedirect('labels');

        $this->assertDatabaseMissing('labels', $label->only(['name']));
    }

    public function testNotDeleteLabels()
    {
        $label = Label::factory()->create();

        $response = $this->delete(route('labels.destroy', $label));

        $response->assertStatus(403);

    }
}
