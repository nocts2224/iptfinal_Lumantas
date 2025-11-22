<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'journal_id',
        'account_id',
        'debit_amount',
        'credit_amount',
        'memo',
    ];

    /**
     * The journal this line belongs to
     */
    public function journal()
    {
        return $this->belongsTo(Journal::class);
    }

    /**
     * The account affected by this line
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
