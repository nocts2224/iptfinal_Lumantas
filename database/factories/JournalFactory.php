<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Journal;

class JournalFactory extends Factory
{
    protected $model = Journal::class;

    public function definition()
    {
        return [
            'reference_no' => strtoupper($this->faker->bothify('JRN-####')),
            'journal_date' => $this->faker->dateTimeBetween('-1 years', 'now')->format('Y-m-d'),
            'description' => $this->faker->sentence(),
        ];
    }
}
