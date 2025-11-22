@extends('layouts.pages')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>Accounts</h2>
    <a href="{{ route('accounts.create') }}" class="btn btn-primary">Add Account</a>
</div>

<table class="table table-bordered table-striped">
    <thead class="table-light">
        <tr>
            <th>Code</th>
            <th>Name</th>
            <th>Type</th>
            <th>Description</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($accounts as $account)
        <tr>
            <td>{{ $account->code }}</td>
            <td>{{ $account->name }}</td>
            <td>{{ ucfirst($account->type) }}</td>
            <td>{{ $account->description }}</td>
            <td>
                <a href="{{ route('accounts.edit', $account) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('accounts.destroy', $account) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this account?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{ $accounts->links() }}
@endsection
