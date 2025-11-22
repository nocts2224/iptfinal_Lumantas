<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Account;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Account>
 */
class AccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Account::class;

    public function definition(): array
    {   
        $types = ['asset', 'liability', 'equity', 'revenue', 'expense'];
        return [
            'code' => $this->faker->unique()->numerify('1###'),
            'name' => $this->faker->unique()->word() . ' Account',
            'type' => $this->faker->randomElement($types),
            'description' => $this->faker->sentence(),
        ];
    }
}
