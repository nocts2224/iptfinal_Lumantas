<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    use HasFactory;

    protected $fillable = [
        'reference_no',
        'journal_date',
        'description',
    ];

    protected $dates = ['journal_date'];

    /**
     * A journal has many journal entry lines
     */
    public function entries()
    {
        return $this->hasMany(JournalEntry::class);
    }

    /**
     * Total debit for this journal
     */
    public function totalDebit()
    {
        return $this->entries()->sum('debit_amount');
    }

    /**
     * Total credit for this journal
     */
    public function totalCredit()
    {
        return $this->entries()->sum('credit_amount');
    }
}
