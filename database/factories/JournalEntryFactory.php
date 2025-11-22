<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\JournalEntry;
use App\Models\Journal;
use App\Models\Account;

class JournalEntryFactory extends Factory
{
    protected $model = JournalEntry::class;

    public function definition()
    {
        $accountIds = Account::pluck('id')->toArray();
        $debitAccount = $this->faker->randomElement($accountIds);
        $creditAccount = $this->faker->randomElement($accountIds);
        $amount = $this->faker->randomFloat(2, 100, 5000);

        return [
            'journal_id' => Journal::factory(),
            'account_id' => $debitAccount,
            'debit_amount' => $amount,
            'credit_amount' => 0,
            'memo' => $this->faker->optional()->sentence(),
        ];
    }
}
