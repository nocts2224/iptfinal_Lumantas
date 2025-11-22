@extends('layouts.pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Journal Entries</h2>
    <a href="{{ route('journal.create') }}" class="btn btn-primary">Add Journal Entry</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Date</th>
            <th>Reference</th>
            <th>Description</th>
            <th>Total Debit</th>
            <th>Total Credit</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($journals as $journal)
        <tr>
           <td>{{ \Carbon\Carbon::parse($journal->journal_date)->format('Y-m-d') }}</td>
            <td>{{ $journal->reference_no }}</td>
            <td>{{ $journal->description }}</td>
            <td>{{ number_format($journal->totalDebit(),2) }}</td>
            <td>{{ number_format($journal->totalCredit(),2) }}</td>
            <td>
                <a href="{{ route('journal.show', $journal) }}" class="btn btn-sm btn-info">View</a>
                <form action="{{ route('journal.destroy', $journal) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this journal?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $journals->links() }}
@endsection
