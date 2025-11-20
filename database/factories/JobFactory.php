<?php
namespace Database\Factories;

use App\Models\Job;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class JobFactory extends Factory
{
    protected $model = Job::class;

    public function definition(): array
    {
        $types = ['Full-time', 'Part-time', 'Contract'];

        return [
            'user_id' => User::factory(), // Each job belongs to a user
            'title' => $this->faker->jobTitle(),
            'company' => $this->faker->company(),
            'location' => $this->faker->city() . ', ' . $this->faker->stateAbbr(),
            'description' => $this->faker->paragraphs(rand(3, 7), true),
            'salary' => $this->faker->randomFloat(2, 40000, 150000),
            'job_type' => $this->faker->randomElement($types),
            'posted_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}