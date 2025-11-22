@extends('layouts.pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Journal Entry: {{ $journal->reference_no }}</h2>
    <a href="{{ route('journal.index') }}" class="btn btn-secondary">Back to Journals</a>
</div>

<div class="mb-3">
    <strong>Date:</strong> {{ \Carbon\Carbon::parse($journal->journal_date)->format('Y-m-d') }} <br>
    <strong>Description:</strong> {{ $journal->description }}
</div>

<h4>Entries</h4>
<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Account Code</th>
            <th>Account Name</th>
            <th>Debit</th>
            <th>Credit</th>
            <th>Memo</th>
        </tr>
    </thead>
    <tbody>
        @foreach($journal->entries as $entry)
        <tr>
            <td>{{ $entry->account->code }}</td>
            <td>{{ $entry->account->name }}</td>
            <td>{{ number_format($entry->debit_amount,2) }}</td>
            <td>{{ number_format($entry->credit_amount,2) }}</td>
            <td>{{ $entry->memo }}</td>
        </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr class="table-light">
            <th colspan="2">Totals</th>
            <th>{{ number_format($journal->totalDebit(),2) }}</th>
            <th>{{ number_format($journal->totalCredit(),2) }}</th>
            <th></th>
        </tr>
    </tfoot>
</table>
@endsection
