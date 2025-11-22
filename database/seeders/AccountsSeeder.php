<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Account;

class AccountsSeeder extends Seeder
{
    public function run(): void
    {
        $accounts = [
            ['code'=>'1001','name'=>'Cash','type'=>'asset','description'=>'Cash on hand'],
            ['code'=>'2001','name'=>'Accounts Payable','type'=>'liability','description'=>'Amounts owed to suppliers'],
            ['code'=>'3001','name'=>'Owner Capital','type'=>'equity','description'=>'Owner investment'],
            ['code'=>'4001','name'=>'Sales Revenue','type'=>'revenue','description'=>'Income from sales'],
            ['code'=>'5001','name'=>'Salaries Expense','type'=>'expense','description'=>'Employee salaries'],
        ];

        foreach ($accounts as $a) {
            Account::create($a);
        }

        // Add 5 more random accounts
        Account::factory(5)->create();
    }
}
