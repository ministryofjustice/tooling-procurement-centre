<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->words(3, true),
            'comms_url' => $this->faker->url(),
            'organisation_id' => Organisation::factory()->create()->id
        ];
    }
}
