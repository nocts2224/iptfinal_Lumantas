@extends('layouts.pages')

@section('content')
<h2>Create Journal Entry</h2>

<!-- Toast notification -->
<div class="position-fixed top-0 end-0 p-3" style="z-index: 1055;">
    <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body">
                Journal entry successfully added!
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
    <div id="errorToast" class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="d-flex">
            <div class="toast-body" id="errorMessage">
                An error occurred. Please try again.
            </div>
            <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
    </div>
</div>

<form id="journalForm">
    @csrf
    <div class="mb-3">
        <label class="form-label">Reference No</label>
        <input type="text" name="reference_no" class="form-control" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" name="journal_date" class="form-control" value="{{ date('Y-m-d') }}" required>
    </div>
    <div class="mb-3">
        <label class="form-label">Description</label>
        <input type="text" name="description" class="form-control" required>
    </div>

    <h5>Journal Lines</h5>
    <table class="table table-bordered" id="journal-lines-table">
        <thead>
            <tr>
                <th>Account</th>
                <th>Type</th>
                <th>Amount</th>
                <th>Memo</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <select name="lines[0][account_id]" class="form-select" required>
                        @foreach($accounts as $account)
                        <option value="{{ $account->id }}">{{ $account->code }} - {{ $account->name }}</option>
                        @endforeach
                    </select>
                </td>
                <td>
                    <select name="lines[0][type]" class="form-select" required>
                        <option value="debit">Debit</option>
                        <option value="credit">Credit</option>
                    </select>
                </td>
                <td><input type="number" name="lines[0][amount]" class="form-control amount-input" step="0.01" required></td>
                <td><input type="text" name="lines[0][memo]" class="form-control"></td>
                <td><button type="button" class="btn btn-sm btn-danger remove-line">Remove</button></td>
            </tr>
        </tbody>
    </table>

    <button type="button" id="add-line" class="btn btn-secondary mb-3">Add Line</button>
    <br>
    <button type="submit" class="btn btn-success">Save Journal Entry</button>
</form>
@endsection

@section('scripts')
<script>
let lineIndex = 1;

// Add new journal line
document.getElementById('add-line').addEventListener('click', function() {
    let table = document.getElementById('journal-lines-table').getElementsByTagName('tbody')[0];
    let newRow = table.rows[0].cloneNode(true);
    newRow.querySelectorAll('input, select').forEach(input => {
        let name = input.getAttribute('name');
        if(name) input.setAttribute('name', name.replace(/\d+/, lineIndex));
        if(input.tagName === 'INPUT') input.value = '';
    });
    table.appendChild(newRow);
    lineIndex++;
});

// Remove a journal line
document.getElementById('journal-lines-table').addEventListener('click', function(e){
    if(e.target.classList.contains('remove-line')){
        let row = e.target.closest('tr');
        if(document.querySelectorAll('#journal-lines-table tbody tr').length > 1){
            row.remove();
        }
    }
});

// AJAX form submission
document.getElementById('journalForm').addEventListener('submit', function(e){
    e.preventDefault();
    console.log('Form submitted'); // Debug log
    
    let form = e.target;
    let formData = new FormData(form);
    
    // Debug: Log form data
    for (let pair of formData.entries()) {
        console.log(pair[0] + ': ' + pair[1]);
    }

    fetch("{{ route('journal.store') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
            'Accept': 'application/json'
        },
        body: formData
    })
    .then(response => {
        console.log('Response status:', response.status); // Debug log
        if (!response.ok) {
            return response.json().then(err => Promise.reject(err));
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data); // Debug log
        if(data.success){
            // Show success toast
            let toastEl = document.getElementById('successToast');
            let toast = new bootstrap.Toast(toastEl);
            toast.show();

            // Reset form
            form.reset();
            document.querySelector('input[name="journal_date"]').value = "{{ date('Y-m-d') }}";

            // Reset journal lines table to 1 row
            let tbody = document.querySelector('#journal-lines-table tbody');
            let firstRow = tbody.rows[0].cloneNode(true);
            firstRow.querySelectorAll('input').forEach(input => input.value = '');
            firstRow.querySelector('select[name*="account_id"]').selectedIndex = 0;
            firstRow.querySelector('select[name*="type"]').selectedIndex = 0;
            tbody.innerHTML = '';
            tbody.appendChild(firstRow);
            lineIndex = 1;

            // Optionally, redirect to index after 1.5s
            setTimeout(() => {
                window.location.href = "{{ route('journal.index') }}";
            }, 1500);
        }
    })
    .catch(err => {
        console.error('Error:', err); // Debug log
        // Show error toast
        let errorMsg = err.message || 'An error occurred. Please try again.';
        if (err.errors) {
            errorMsg = Object.values(err.errors).flat().join(', ');
        }
        document.getElementById('errorMessage').textContent = errorMsg;
        let toastEl = document.getElementById('errorToast');
        let toast = new bootstrap.Toast(toastEl);
        toast.show();
    });
});
</script>
@endsection