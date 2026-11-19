{{-- Display feedback after a successful write. --}}
@if (session('status'))
    <p role="status" class="mb-6 rounded-lg border border-emerald-200 bg-emerald-50 p-3 text-emerald-900">{{ session('status') }}</p>
@endif
