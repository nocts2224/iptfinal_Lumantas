<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Journal;
use App\Models\JournalEntry;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class JournalsSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = Account::pluck('id')->toArray();

        for ($i = 0; $i < 10; $i++) {
            $journal = Journal::factory()->create();

            // Pick two different accounts
            $debitAccount = $accounts[array_rand($accounts)];
            do {
                $creditAccount = $accounts[array_rand($accounts)];
            } while ($creditAccount === $debitAccount);

            $amount = rand(100, 5000);

            DB::transaction(function() use ($journal, $debitAccount, $creditAccount, $amount) {
                JournalEntry::create([
                    'journal_id' => $journal->id,
                    'account_id' => $debitAccount,
                    'debit_amount' => $amount,
                    'credit_amount' => 0,
                    'memo' => 'Debit entry',
                ]);

                JournalEntry::create([
                    'journal_id' => $journal->id,
                    'account_id' => $creditAccount,
                    'debit_amount' => 0,
                    'credit_amount' => $amount,
                    'memo' => 'Credit entry',
                ]);
            });
        }
    }
}
