<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journal;
use App\Models\JournalEntry;
use App\Models\Account;
use Illuminate\Support\Facades\DB;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::with('entries.account')->orderBy('journal_date','desc')->paginate(10);
        return view('journal.index', compact('journals'));
    }

    public function create()
    {
        $accounts = Account::orderBy('name')->get();
        return view('journal.create', compact('accounts'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'reference_no' => 'required|string|unique:journals,reference_no',
            'journal_date' => 'required|date',
            'description' => 'required|string',
            'lines' => 'required|array|min:1',
            'lines.*.account_id' => 'required|exists:accounts,id',
            'lines.*.type' => 'required|in:debit,credit',
            'lines.*.amount' => 'required|numeric|min:0.01',
            'lines.*.memo' => 'nullable|string',
        ]);

        // Validate totals
        $totalDebit = 0;
        $totalCredit = 0;
        foreach ($data['lines'] as $line) {
            if ($line['type'] === 'debit') $totalDebit += $line['amount'];
            else $totalCredit += $line['amount'];
        }

        if (round($totalDebit, 2) !== round($totalCredit, 2)) {
            // Check if request is AJAX
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total debits must equal total credits.',
                    'errors' => ['lines' => ['Total debits must equal total credits.']]
                ], 422);
            }
            return back()->withInput()->withErrors(['lines' => 'Total debits must equal total credits.']);
        }

        try {
            $journal = DB::transaction(function() use ($data) {
                $journal = Journal::create([
                    'reference_no' => $data['reference_no'],
                    'journal_date' => $data['journal_date'],
                    'description' => $data['description'],
                ]);

                foreach ($data['lines'] as $line) {
                    JournalEntry::create([
                        'journal_id' => $journal->id,
                        'account_id' => $line['account_id'],
                        'debit_amount' => $line['type'] === 'debit' ? $line['amount'] : 0,
                        'credit_amount' => $line['type'] === 'credit' ? $line['amount'] : 0,
                        'memo' => $line['memo'] ?? null,
                    ]);
                }

                return $journal;
            });

            // Check if request is AJAX
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Journal entry created successfully.',
                    'journal' => $journal
                ]);
            }

            return redirect()->route('journal.index')->with('success', 'Journal entry created.');
            
        } catch (\Exception $e) {
            // Check if request is AJAX
            if ($request->expectsJson() || $request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'An error occurred while creating the journal entry.',
                    'error' => $e->getMessage()
                ], 500);
            }

            return back()->withInput()->withErrors(['error' => 'An error occurred while creating the journal entry.']);
        }
    }

    public function show(Journal $journal)
    {
        $journal->load('entries.account');
        return view('journal.show', compact('journal'));
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();
        
        // Check if request is AJAX
        if (request()->expectsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Journal entry deleted successfully.'
            ]);
        }
        
        return redirect()->route('journal.index')->with('success', 'Journal entry deleted.');
    }
}