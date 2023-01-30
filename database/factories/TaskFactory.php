<?php

namespace Database\Factories;

use App\Models\Task;
use App\Models\TaskStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Task::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $randomIdStatus = random_int(1, count(TaskStatus::get()));

        $maxIdUser = count(User::all());

        $randomIdAssigned = User::find(random_int(1, $maxIdUser));

        $randomIdCreater = User::find(random_int(1, $maxIdUser));

        return [
            'status_id' => $randomIdStatus,
            'name' => $this->faker->unique()->name(),
            'description' => $this->faker->unique()->text(100),
            'created_by_id' => $randomIdCreater,
            'assigned_to_id' => $randomIdAssigned,
        ];
    }
}
