<div class="sidebar bg-white shadow-sm position-fixed vh-100 d-flex flex-column p-3">
    <a class="d-flex align-items-center mb-4 text-decoration-none">
        <i class="bi bi-journal-bookmark fs-3 me-2"></i>
        <span class="fs-5 fw-bold">Mini Accounting Journal</span>
    </a>

    <ul class="nav nav-pills flex-column mb-auto">
        <li class="nav-item mb-2">
            <a href="{{ route('home') }}" class="nav-link text-dark">
                <i class="bi bi-house-door me-2"></i> Home
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('accounts.index') }}" class="nav-link text-dark">
                <i class="bi bi-wallet2 me-2"></i> Accounts
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="{{ route('journal.index') }}" class="nav-link text-dark">
                <i class="bi bi-journal-text me-2"></i> Journals
            </a>
        </li>
        <li class="nav-item mt-3">
            <a href="{{ route('journal.create') }}" class="btn btn-warning text-dark w-100 d-flex align-items-center justify-content-center">
                <i class="bi bi-plus-circle me-2"></i> New Entry
            </a>
        </li>
    </ul>

    <hr class="my-3">
    <small class="text-muted">&copy; {{ date('Y') }} Mini Accounting Journal</small>
</div>

<style>
    /* Sidebar width */
.sidebar {
    width: 250px;
    top: 0;
    left: 0;
    z-index: 1000;
}

/* Add padding to main content so it doesn't overlap sidebar */
.main-content {
    margin-left: 250px;
    padding: 2rem;
}

/* Active nav link style */
.nav-link.active {
    background-color: #ff6a00;
    color: #fff !important;
    border-radius: 8px;
}

/* Hover effect */
.nav-link:hover {
    background-color: #ff8c42;
    color: #fff !important;
    border-radius: 8px;
}

</style>