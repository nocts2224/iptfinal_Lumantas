@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('assets/about.css') }}">
@endsection

@section('content')
<div class="container py-5">
    <div class="about-card mx-auto" style="max-width: 800px;">
        <h1 class="about-title">About Mini Accounting Journal</h1>
        <p class="about-description">
            The Mini Accounting Journal System is designed to help small businesses and individuals manage their financial transactions easily. 
            Keep track of accounts, record journal entries, and review your financial data with a clean and user-friendly interface.
        </p>
        <a href="{{ route('journal.index') }}" class="btn btn-light text-dark mt-3">
            <i class="bi bi-journal-text"></i> View Journals
        </a>
    </div>

    <div class="mt-5 text-center">
        <h2 class="mb-4">Me</h2>
        <div class="row justify-content-center">
            <div class="col-md-3 team-member">
                <img src="https://via.placeholder.com/120" alt="Team Member">
                <h5>LJPT</h5>
                <p>Full Stack Developer & Designer/Vibe Coder</p>
            </div>
        </div>
    </div>
</div>
@endsection
