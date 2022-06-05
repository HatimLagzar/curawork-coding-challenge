<?php

namespace Database\Factories;

use App\Models\Relationship;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Relationship>
 */
class RelationshipFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Relationship::USER_ID_1_COLUMN => User::factory(),
            Relationship::USER_ID_2_COLUMN => User::factory(),
        ];
    }
}
