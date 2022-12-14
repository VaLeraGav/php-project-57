<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
//    /**
//     * The name of the factory's corresponding model.
//     *
//     * @var string
//     */
//    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        // переделать на рандомные числа
        return [
            'status_id' => 1,
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->unique()->text(100),
            'created_by_id' => 1,
            'assigned_to_id' => 1,
        ];
    }
}
