@extends('layouts.pages')

@section('content')
<div class="card">
    <div class="card-header">
        {{ $account->id ? 'Edit Account' : 'Add Account' }}
    </div>
    <div class="card-body">
        <form action="{{ $account->id ? route('accounts.update', $account) : route('accounts.store') }}" method="POST">
            @csrf
            @if($account->id)
                @method('PUT')
            @endif

            <div class="mb-3">
                <label class="form-label">Account Code</label>
                <input type="text" name="code" class="form-control" value="{{ old('code', $account->code) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Name</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $account->name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Type</label>
                <select name="type" class="form-select" required>
                    @foreach(['asset','liability','equity','revenue','expense'] as $type)
                        <option value="{{ $type }}" {{ old('type', $account->type) === $type ? 'selected' : '' }}>{{ ucfirst($type) }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" class="form-control">{{ old('description', $account->description) }}</textarea>
            </div>
            <button type="submit" class="btn btn-success">{{ $account->id ? 'Update' : 'Create' }}</button>
            <a href="{{ route('accounts.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>
@endsection
