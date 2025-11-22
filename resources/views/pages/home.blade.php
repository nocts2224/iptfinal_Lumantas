@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/home.css') }}">
@endsection

@section('content')
<div class="container py-5 position-relative">
    <!-- Floating background shapes -->
    <div class="floating-shape shape1"></div>
    <div class="floating-shape shape2"></div>
    <div class="floating-shape shape3"></div>

    <div class="home-card mx-auto" style="max-width: 700px; position: relative; z-index: 1;">
        <h1 class="home-title">Mini Accounting Journal</h1>
        <p class="home-description">
            Welcome to the Mini Accounting Journal System. Manage your accounts, record journal entries, and review your transactions easily.
        </p>
        <div class="d-flex justify-content-center flex-wrap home-buttons gap-3">
            <a href="{{ route('accounts.index') }}" class="btn btn-primary">
                <i class="bi bi-wallet2"></i> Manage Accounts
            </a>
            <a href="{{ route('journal.index') }}" class="btn btn-success">
                <i class="bi bi-journal-text"></i> View Journals
            </a>
            <a href="{{ route('journal.create') }}" class="btn btn-warning">
                <i class="bi bi-plus-circle"></i> New Journal Entry
            </a>
        </div>
    </div>
</div>
@endsection
